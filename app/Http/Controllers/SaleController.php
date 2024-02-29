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
        $sales = Sale::paginate(10);
        return view('components.sales', compact('sales'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $searchProducts = $request->input('searchProducts');

        if ($searchProducts) {
            $products = Product::where('name', 'like', '%' . $searchProducts . '%')
                ->orWhere('id', 'like', '%' . $searchProducts . '%')
                ->paginate(5);
        } else {
            $products = Product::cursorPaginate(5);
        }

        $sales = Sale::paginate(10);
        return view('components.add_sale', compact('sales', 'products'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSaleRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Sale $sale)
    {
        //
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
    public function update(UpdateSaleRequest $request, Sale $sale)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Sale $sale)
    {
        //
    }
}
