<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\SaleProduct;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Mockery\Undefined;
use Illuminate\Support\Facades\Storage;

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
                    $perPage = 5,
                    $columns = ['*'],
                    $pageName = 'products'
                )->withQueryString();
        } elseif ($id_category) {
            $products = DB::table('products')
                ->where('id_category', $id_category)
                ->paginate(
                    $perPage = 5,
                    $columns = ['*'],
                    $pageName = 'products'
                );
        } elseif ($searchProducts) {
            $products = DB::table('products')
                ->where('name', 'like', '%' . $searchProducts . '%')
                ->orWhere('id', 'like', '%' . $searchProducts . '%')
                ->paginate(
                    $perPage = 5,
                    $columns = ['*'],
                    $pageName = 'products'
                )
                ->withQueryString();
        } else {
            $products = DB::table('products')->paginate(
                $perPage = 5,
                $columns = ['*'],
                $pageName = 'products'
            );
        }

        $categories = Category::paginate(
            $perPage = 10,
            $columns = ['*'],
            $pageName = 'categories'
        );

        return view('components.products', compact('products', 'categories', 'categorySelected', 'nameProductSearch'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categorySelected = '';
        $nameProductSearch = '';

        $categories = Category::paginate(
            $perPage = 10,
            $columns = ['*'],
            $pageName = 'categories'
        );

        $products = DB::table('products')->paginate(
            $perPage = 5,
            $columns = ['*'],
            $pageName = 'products'
        );

        return view('components.create_product', compact('categories', 'products', 'categorySelected', 'nameProductSearch'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'quantity' => 'required|integer|min:1',
            'price' => 'required|numeric|between:0,999999.99',
            'expense' => 'required|numeric|between:0,999999.99',
            'id_category' => 'required|exists:categories,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $product = $request->all();

        if ($request->image) {
            $product['image'] = $request->image->store('products');
        }

        $product = Product::create($product);

        return redirect()->route('components.products');
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
    public function edit(Product $product, string $id)
    {
        $categorySelected = '';
        $nameProductSearch = '';

        $product = Product::find($id);

        $categories = Category::paginate(
            $perPage = 10,
            $columns = ['*'],
            $pageName = 'categories'
        );

        $products = DB::table('products')->paginate(
            $perPage = 5,
            $columns = ['*'],
            $pageName = 'products'
        );

        return view('components.edit_product', compact('product', 'categories', 'products', 'categorySelected', 'nameProductSearch'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'quantity' => 'required|integer|min:1',
            'price' => 'required|numeric|between:0,999999.99',
            'expense' => 'required|numeric|between:0,999999.99',
            'id_category' => 'required|exists:categories,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $product = Product::find($id);

        if ($request->image) {
            $product['image'] = $request->image->store('products');
        }

        $product->update([
            'name' => $request->name,
            'description' => $request->description,
            'quantity' => $request->quantity,
            'price' => $request->price,
            'expense' => $request->expense,
            'id_category' => $request->id_category
        ]);

        return redirect()->route('components.products');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $product = Product::find($id);
        SaleProduct::where('id_product', '=', $id)->update(['id_product' => null]);
        Storage::delete($product->image);
        $product->delete();
        return redirect()->route('components.products');
    }
}
