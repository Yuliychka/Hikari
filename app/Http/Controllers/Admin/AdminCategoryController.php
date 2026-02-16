<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

use Illuminate\Support\Facades\Storage;

class AdminCategoryController extends Controller
{
    public function index()
    {
        $categories = Category::with('children')->whereNull('parent_id')->orderBy('order')->get();
        return view('admin.categories.index', compact('categories'));
    }

    public function create(Request $request)
    {
        $parentCategories = Category::whereNull('parent_id')->orderBy('name')->get(); 
        $selectedParentId = $request->query('parent_id');
        return view('admin.categories.create', compact('parentCategories', 'selectedParentId'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'parent_id' => 'nullable|exists:categories,id',
            'description' => 'nullable|string',
            'image_file' => 'nullable|image|max:10240',
            'is_active' => 'required|boolean',
            'order' => 'required|integer',
        ]);

        $slug = Str::slug($data['name']);
        $originalSlug = $slug;
        $count = 1;
        while (Category::where('slug', $slug)->exists()) {
            $slug = $originalSlug . '-' . $count++;
        }
        $data['slug'] = $slug;
        
        if ($request->hasFile('image_file')) {
            $path = $request->file('image_file')->store('categories', 'public');
            $data['image_path'] = $path;
        }

        Category::create($data);

        return redirect()->route('admin.categories.index')->with('success', 'Category created successfully.');
    }

    public function edit(Category $category)
    {
        $parentCategories = Category::whereNull('parent_id')->where('id', '!=', $category->id)->orderBy('name')->get();
        return view('admin.categories.create', compact('category', 'parentCategories'));
    }

    public function update(Request $request, Category $category)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'parent_id' => 'nullable|exists:categories,id',
            'description' => 'nullable|string',
            'image_file' => 'nullable|image|max:10240',
            'is_active' => 'required|boolean',
            'order' => 'required|integer',
        ]);

        // Prevent circular reference
        if ($data['parent_id'] == $category->id) {
            $data['parent_id'] = null;
        }

        // Only update slug if name changed
        if ($category->name !== $data['name']) {
            $slug = Str::slug($data['name']);
            $originalSlug = $slug;
            $count = 1;
            while (Category::where('slug', $slug)->where('id', '!=', $category->id)->exists()) {
                $slug = $originalSlug . '-' . $count++;
            }
            $data['slug'] = $slug;
        }
        
        if ($request->hasFile('image_file')) {
            if ($category->image_path) {
                Storage::disk('public')->delete($category->image_path);
            }
            $path = $request->file('image_file')->store('categories', 'public');
            $data['image_path'] = $path;
        }

        $category->update($data);

        return redirect()->route('admin.categories.index')->with('success', 'Category updated successfully.');
    }

    public function destroy(Category $category)
    {
        if ($category->image_path) {
            Storage::disk('public')->delete($category->image_path);
        }
        $category->delete();
        return redirect()->route('admin.categories.index')->with('success', 'Category deleted successfully.');
    }
}
