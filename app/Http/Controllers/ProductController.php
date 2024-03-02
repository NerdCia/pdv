<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function __construct(
        public Category $category
    ) {
    }

    public function index(Request $request, ?string $category = null)
    {
        $searchProducts = $request->input('searchProducts');

        $categorySelected = $category;
        $nameProductSearch = $searchProducts;

        $id_category = Category::where('name', $category)->value('id');

        if ($id_category && $searchProducts) {
            $products = DB::table('products')
                ->where('id_category', $id_category)
                ->where('name', 'like', '%' . $searchProducts . '%')
                ->orWhere('id', 'like', '%' . $searchProducts . '%')
                ->paginate(
                    $perPage = 5, $columns = ['*'], $pageName = 'products'
                )->withQueryString();
        } elseif ($id_category) {
            $products = DB::table('products')
                ->where('id_category', $id_category)
                ->paginate(
                    $perPage = 5, $columns = ['*'], $pageName = 'products'
                );
        } elseif ($searchProducts) {
            $products = DB::table('products')
                ->where('name', 'like', '%' . $searchProducts . '%')
                ->orWhere('id', 'like', '%' . $searchProducts . '%')
                ->paginate(
                    $perPage = 5, $columns = ['*'], $pageName = 'products'
                )
                ->withQueryString();
        } else {
            $products = DB::table('products')->paginate(
                $perPage = 5, $columns = ['*'], $pageName = 'products'
            );
        }

        $categories = Category::paginate(
            $perPage = 10, $columns = ['*'], $pageName = 'categories'
        );

        return view('components.products', compact('products', 'categories', 'categorySelected', 'nameProductSearch'));
    }

    public function search(Request $request)
    {

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductRequest $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        //
    }
}
