<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Sale;
use Illuminate\Http\Request;
use App\Http\Requests\StoreSaleRequest;
use App\Http\Requests\UpdateSaleRequest;

class SaleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        \Cart::clear();
        $sales = Sale::paginate(10);
        return view('components.sales', compact('sales'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSaleRequest $request)
    {

    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request)
    {
        $items = \Cart::getContent();

        $searchProducts = $request->input('searchProducts');

        if ($searchProducts) {
            $products = Product::where('name', 'like', '%' . $searchProducts . '%')
                ->orWhere('id', 'like', '%' . $searchProducts . '%')
                ->paginate(5);
        } else {
            $products = Product::cursorPaginate(5);
        }

        $sales = Sale::paginate(10);
        return view('components.create_sale', compact('sales', 'products', 'items'));
    }

    public function add(Request $request)
    {
        \Cart::add([
            'id' => $request->id,
            'name' => $request->name,
            'price' => $request->price,
            'quantity' => $request->quantity,
            'attributes' => array(
                'image' => $request->image
            )
        ]);
        return redirect()->route('components.create_sale')->with('success','Produto adicionado com sucesso.');
    }

    public function saleUpdateProduct(Request $request)
    {
        \Cart::update($request->id, [
            'quantity' => [
                'relative' => false,
                'value' => abs($request->quantity)
            ]
        ]);

        return redirect()->route('components.create_sale');
    }

    public function saleRemoveProduct(Request $request)
    {
        \Cart::remove($request->id);
        return redirect()->route('components.create_sale')->with('warning','Produto removido com sucesso.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Sale $sale)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Sale $sale)
    {
        //
    }
}
