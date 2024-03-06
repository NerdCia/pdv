<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Sale;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class DashboardController extends Controller
{
    public function index()
    {
        $products = Product::all();

        $productsWithLessThan10InStock = DB::table('products')
            ->where('quantity', '<', '10')
            ->paginate(
                $perPage = 5,
                $columns = ['*'],
                $pageName = 'productsWithLessThan10InStock'
            );

        $lastSales = Sale::all()->take(5);

        $sales = Sale::all();

        return view('components.dashboard', compact('products', 'sales', 'lastSales', 'productsWithLessThan10InStock'));
    }
}
