<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Sale;

class CreateSaleController extends Controller
{
    public function index(Request $request)
    {
        $items = \Cart::getContent();

        $total = 0;
        foreach ($items as $item) {
            $subtotal = $item->price * $item->quantity;
            $total += $subtotal;
        }

        $searchProducts = $request->input('searchProducts');

        if ($searchProducts) {
            $products = Product::where('name', 'like', '%' . $searchProducts . '%')
                ->orWhere('id', 'like', '%' . $searchProducts . '%')
                ->paginate(
                    $perPage = 5,
                    $columns = ['*'],
                    $pageName = 'products'
                )
                ->withQueryString();
        } else {
            $products = Product::paginate(
                $perPage = 5,
                $columns = ['*'],
                $pageName = 'products'
            );
        }

        $sales = Sale::cursorPaginate(
            $perPage = 10,
            $columns = ['*'],
            $pageName = 'sales'
        );
        return view('components.create_sale', compact('sales', 'products', 'items', 'total'));
    }

    public function saleAddProduct(Request $request)
    {
        \Cart::add([
            'id' => $request->id,
            'name' => $request->name,
            'quantity' => abs($request->quantity),
            'expense' => $request->expense,
            'price' => $request->price,
            'attributes' => array(
                'image' => $request->image
            )
        ]);
        return redirect()->route('components.create_sale')->with('success', 'Produto adicionado com sucesso.');
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
        return redirect()->route('components.create_sale')->with('warning', 'Produto removido com sucesso.');
    }
}
