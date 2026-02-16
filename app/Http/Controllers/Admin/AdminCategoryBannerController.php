<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminCategoryBannerController extends Controller
{
    public function index()
    {
        $banners = Banner::where('type', 'category')->orderBy('order')->get();
        return view('admin.category-banners.index', compact('banners'));
    }

    public function create(Request $request)
    {
        $categories = Category::all();
        $selectedCategoryId = $request->query('category_id');
        return view('admin.category-banners.create', compact('categories', 'selectedCategoryId'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'category_id' => 'nullable|exists:categories,id',
            'title' => 'nullable|string|max:255',
            'image_path' => 'nullable|string',
            'image_file' => 'nullable|image|max:20480',
            'link' => 'nullable|string',
            'is_active' => 'required|boolean',
            'order' => 'required|integer',
        ]);

        $data['type'] = 'category';

        if ($request->hasFile('image_file')) {
            $path = $request->file('image_file')->store('banners/category', 'public');
            $data['image_path'] = $path;
        }

        Banner::create($data);

        return redirect()->route('admin.category-banners.index')->with('success', 'Category banner created successfully.');
    }

    public function edit(Banner $categoryBanner)
    {
        $categories = Category::all();
        return view('admin.category-banners.create', compact('categoryBanner', 'categories'));
    }

    public function update(Request $request, Banner $categoryBanner)
    {
        $data = $request->validate([
            'category_id' => 'nullable|exists:categories,id',
            'title' => 'nullable|string|max:255',
            'image_path' => 'nullable|string',
            'image_file' => 'nullable|image|max:20480',
            'link' => 'nullable|string',
            'is_active' => 'required|boolean',
            'order' => 'required|integer',
        ]);

        if ($request->hasFile('image_file')) {
            if ($categoryBanner->image_path && !str_starts_with($categoryBanner->image_path, 'http')) {
                Storage::disk('public')->delete($categoryBanner->image_path);
            }
            $path = $request->file('image_file')->store('banners/category', 'public');
            $data['image_path'] = $path;
        }

        $categoryBanner->update($data);

        return redirect()->route('admin.category-banners.index')->with('success', 'Category banner updated successfully.');
    }

    public function destroy(Banner $categoryBanner)
    {
        if ($categoryBanner->image_path && !str_starts_with($categoryBanner->image_path, 'http')) {
            Storage::disk('public')->delete($categoryBanner->image_path);
        }

        $categoryBanner->delete();

        return redirect()->route('admin.category-banners.index')->with('success', 'Category banner deleted successfully.');
    }
}
