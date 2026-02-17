<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Color;
use App\Models\Size;
use App\Models\Product; // Import Model


class ProductController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::with(['category', 'subcategory'])->where("status", 1);

        // Search filter
        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%")
                  ->orWhere('sku', 'like', "%{$search}%");
            });
        }

        // Category filter (separate category and subcategory)
        if ($request->has('category_id') && $request->category_id != '') {
            $query->where('category_id', $request->category_id);
        }
        
        if ($request->has('subcategory_id') && $request->subcategory_id != '') {
            $query->where('subcategory_id', $request->subcategory_id);
        }

        // Price range filter
        if ($request->has('min_price') && $request->min_price != '') {
            $query->where('price', '>=', $request->min_price);
        }
        if ($request->has('max_price') && $request->max_price != '') {
            $query->where('price', '<=', $request->max_price);
        }

        // Stock filter
        if ($request->has('in_stock') && $request->in_stock) {
            $query->where('stock_quantity', '>', 0);
        }

        // Sorting
        $sort = $request->get('sort', 'newest');
        switch ($sort) {
            case 'price_low':
                $query->orderBy('price', 'asc');
                break;
            case 'price_high':
                $query->orderBy('price', 'desc');
                break;
            case 'name_asc':
                $query->orderBy('name', 'asc');
                break;
            case 'name_desc':
                $query->orderBy('name', 'desc');
                break;
            case 'most_sold':
                // Assuming you have a sales_count or similar column
                $query->orderBy('created_at', 'desc'); // Fallback to newest for now
                break;
            case 'newest':
            default:
                $query->orderBy('created_at', 'desc');
                break;
        }

        $products = $query->paginate(12)->appends($request->except('page'));

        // Get all categories with children for filter
        $categories = \App\Models\Category::with('children')->where('parent_id', null)->get();

        return view('products.index', compact('products', 'categories'));
    }

    public function categories()
    {
        $categories = Category::with(['children', 'cardFrame', 'cardAttribute', 'cardType', 'cardStar'])
            ->whereNull('parent_id')
            ->where('is_active', true)
            ->orderBy('order')
            ->get();
            
        $cardBack = \App\Models\Setting::get('card_back_image');
            
        return view('categories.index', compact('categories', 'cardBack'));
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
