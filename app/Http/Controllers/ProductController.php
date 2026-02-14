<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;

use App\Models\Product; // Import Model

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::where("status", 1);

        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%");
            });
        }

        $products = $query->paginate(12);

        return view('products.product', ['products' => $products]);
    }

    function getProductById($id)
    {
        $item = Product::findOrFail($id);

        return view("product-details", compact("item"));
    }
}
