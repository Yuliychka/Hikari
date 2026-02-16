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

        return view('products.index', ['products' => $products]);
    }

    function getProductById($id)
    {
        $item = Product::with(['category', 'subcategory', 'reviews.user', 'images'])->findOrFail($id);
        
        // Similar products in the same category
        $similarProducts = Product::where('category_id', $item->category_id)
            ->where('id', '!=', $item->id)
            ->where('status', 1)
            ->limit(4)
            ->get();

        // Check if current user has purchased this product and order is completed
        $hasPurchased = false;
        if (\Illuminate\Support\Facades\Auth::check()) {
            $hasPurchased = \App\Models\Order::where('user_id', \Illuminate\Support\Facades\Auth::id())
                ->where('status', 'completed')
                ->whereHas('items', function($query) use ($id) {
                    $query->where('product_id', $id);
                })->exists();
        }

        return view("product-details", compact("item", "similarProducts", "hasPurchased"));
    }
}
