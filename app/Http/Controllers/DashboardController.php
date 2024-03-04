<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Sale;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $products = Product::all();
        $sales = Sale::all();

        return view('components.dashboard', compact('products','sales'));
    }
}
