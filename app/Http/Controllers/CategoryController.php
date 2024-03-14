<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categorySelected = '';
        $nameProductSearch = '';

        $categories = Category::paginate(
            $perPage = 5,
            $columns = ['*'],
            $pageName = 'categories'
        );

        $products = DB::table('products')->paginate(
            $perPage = 5,
            $columns = ['*'],
            $pageName = 'products'
        );

        return view('components.create_category', compact('categories', 'products', 'categorySelected', 'nameProductSearch'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $category = $request->all();

        $category = Category::create($category);

        return redirect()->route('components.create_category');
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $category = Category::find($id);
        $category->update(['name' => $request->input('name')]);
        return redirect()->route('components.create_category');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        Product::where('id_category', '=', $id)->update(['id_category' => 1]);
        $category = Category::find($id);
        $category->delete();
        return redirect()->route('components.create_category');
    }
}
