<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Sale;
use App\Models\SaleProduct;
use App\Models\User;
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
        $sales = Sale::paginate(
            $perPage = 10,
            $columns = ['*'],
            $pageName = 'sales'
        );

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
    public function store(Request $request)
    {
        $items = \Cart::getContent();
        
        $sale = Sale::create([
            'payment_method' => $request->payment_method,
            'id_user' => $request->id_user
        ]);

        foreach ($items as $item) {
            $saleProduct = SaleProduct::create([
                'quantity' => $item['quantity'],
                'amount' => $item['price'] * $item['quantity'],
                'name_product' => $item['name'],
                'expense_product' => $item['attributes']['expense'],
                'price_product'=> $item['price'],
                'id_sale' => $sale->id,
                'id_product' => $item['id'],
            ]);
        }

        return redirect()->route('components.sales');
    }

    /**
     * Display the specified resource.
     */
    public function show(Sale $sale)
    {

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $sale = Sale::find($id);

        $user = User::find($sale->id_user);

        $saleProducts = SaleProduct::where('id_sale', '=', $id)->get();

        $totalPaid = 0;
        $totalAmount = 0;

        foreach ($saleProducts as $product) {
            $totalPaid += $product->amount;
            $totalAmount += $product->quantity;
        }

        $sales = Sale::paginate(
            $perPage = 10,
            $columns = ['*'],
            $pageName = 'sales'
        );

        return view('components.edit_sale', compact('sales', 'sale', 'user', 'saleProducts', 'totalPaid', 'totalAmount'));
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
