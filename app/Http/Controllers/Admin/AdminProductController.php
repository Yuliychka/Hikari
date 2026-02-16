<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminProductController extends Controller
{
    public function index()
    {
        $products = Product::latest()->paginate(10);
        return view('admin.products.index', compact('products'));
    }

    public function create()
    {
        $categories = \App\Models\Category::with('parent')->get();
        return view('admin.products.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'category_id' => 'nullable|exists:categories,id',
            'subcategory_id' => 'nullable|exists:categories,id',
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric',
            'old_price' => 'nullable|numeric',
            'sku' => 'nullable|string|unique:products,sku',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:20480',
            'status' => 'required|boolean',
            'stock_quantity' => 'required|integer|min:0',
            'discount_active' => 'required|boolean',
            'gallery' => 'nullable|array|max:5',
            'gallery.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:20480',
        ]);

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('products', 'public');
        }

        $product = Product::create($data);

        // Handle Gallery Images
        if ($request->hasFile('gallery')) {
            foreach ($request->file('gallery') as $index => $imageFile) {
                $path = $imageFile->store('products/gallery', 'public');
                $product->images()->create([
                    'image_path' => $path,
                    'order' => $index
                ]);
            }
        }

        return redirect()->route('admin.products.index')->with('success', 'Product created successfully.');
    }

    public function edit(Product $product)
    {
        $categories = \App\Models\Category::with('parent')->get();
        return view('admin.products.edit', compact('product', 'categories'));
    }

    public function update(Request $request, Product $product)
    {
        $data = $request->validate([
            'category_id' => 'nullable|exists:categories,id',
            'subcategory_id' => 'nullable|exists:categories,id',
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric',
            'old_price' => 'nullable|numeric',
            'sku' => 'nullable|string|unique:products,sku,' . $product->id,
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:20480',
            'status' => 'required|boolean',
            'stock_quantity' => 'required|integer|min:0',
            'discount_active' => 'required|boolean',
            'gallery' => 'nullable|array|max:5',
            'gallery.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:20480',
            'remove_images' => 'nullable|array',
            'remove_images.*' => 'exists:product_images,id',
        ]);

        if ($request->hasFile('image')) {
            if ($product->image && Storage::disk('public')->exists($product->image)) {
                Storage::disk('public')->delete($product->image);
            }
            $data['image'] = $request->file('image')->store('products', 'public');
        }

        // Handle Image Removals
        if ($request->filled('remove_images')) {
            $imagesToRemove = \App\Models\ProductImage::whereIn('id', $request->remove_images)->get();
            foreach ($imagesToRemove as $img) {
                Storage::disk('public')->delete($img->image_path);
                $img->delete();
            }
        }

        // Handle New Gallery Images
        if ($request->hasFile('gallery')) {
            $currentCount = $product->images()->count();
            foreach ($request->file('gallery') as $index => $imageFile) {
                if ($currentCount + $index >= 5) break; // Limit to 5 total
                $path = $imageFile->store('products/gallery', 'public');
                $product->images()->create([
                    'image_path' => $path,
                    'order' => $currentCount + $index
                ]);
            }
        }

        $product->update($data);

        return redirect()->route('admin.products.index')->with('success', 'Product updated successfully.');
    }

    public function toggleStatus(Product $product)
    {
        $product->update(['status' => !$product->status]);

        return response()->json([
            'success' => true,
            'status' => $product->status,
            'label' => $product->status ? 'ACTIVE' : 'INACTIVE',
        ]);
    }

    public function destroy(Product $product)
    {
        if ($product->image) {
            Storage::disk('public')->delete($product->image);
        }
        $product->delete();

        return redirect()->route('admin.products.index')->with('success', 'Product deleted successfully.');
    }
}
