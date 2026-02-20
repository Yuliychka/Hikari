<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\FlashSale;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class AdminFlashSaleController extends Controller
{
    public function index()
    {
        $flashSales = FlashSale::orderBy('created_at', 'desc')->get();
        return view('admin.flash-sales.index', compact('flashSales'));
    }

    public function create()
    {
        $products = Product::where('is_active', true)->get();
        return view('admin.flash-sales.create', compact('products'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'image_file' => 'nullable|image|max:20480',
            'end_time' => 'required|date',
            'products' => 'required|array',
            'products.*' => 'exists:products,id',
            'is_active' => 'boolean'
        ]);

        $data['slug'] = Str::slug($data['title']) . '-' . Str::random(6);
        
        if ($request->hasFile('image_file')) {
            $data['banner_image'] = $request->file('image_file')->store('flash-sales', 'public');
        }

        $flashSale = FlashSale::create($data);
        $flashSale->products()->sync($request->products);

        return redirect()->route('admin.flash-sales.index')->with('success', 'Flash Sale created successfully.');
    }

    public function edit(FlashSale $flashSale)
    {
        $products = Product::where('is_active', true)->get();
        return view('admin.flash-sales.create', compact('flashSale', 'products'));
    }

    public function update(Request $request, FlashSale $flashSale)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'image_file' => 'nullable|image|max:20480',
            'end_time' => 'required|date',
            'products' => 'required|array',
            'products.*' => 'exists:products,id',
            'is_active' => 'boolean'
        ]);

        if ($request->hasFile('image_file')) {
            if ($flashSale->banner_image) Storage::disk('public')->delete($flashSale->banner_image);
            $data['banner_image'] = $request->file('image_file')->store('flash-sales', 'public');
        }

        $flashSale->update($data);
        $flashSale->products()->sync($request->products);

        return redirect()->route('admin.flash-sales.index')->with('success', 'Flash Sale updated successfully.');
    }

    public function destroy(FlashSale $flashSale)
    {
        if ($flashSale->banner_image) Storage::disk('public')->delete($flashSale->banner_image);
        $flashSale->delete();
        return redirect()->route('admin.flash-sales.index')->with('success', 'Flash Sale deleted successfully.');
    }
}
