<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminBannerController extends Controller
{
    public function index()
    {
        $banners = Banner::orderBy('type')->orderBy('order')->get();
        return view('admin.banners.index', compact('banners'));
    }

    public function create()
    {
        return view('admin.banners.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'nullable|string|max:255',
            'image_path' => 'nullable|string',
            'image_file' => 'nullable|image|max:5120', // Max 5MB
            'type' => 'required|string|in:hero,promo,category,intro',
            'link' => 'nullable|string',
            'is_active' => 'required|boolean',
            'order' => 'required|integer',
        ]);

        if ($request->hasFile('image_file')) {
            $path = $request->file('image_file')->store('banners', 'public');
            $data['image_path'] = $path;
        }

        Banner::create($data);

        return redirect()->route('admin.banners.index')->with('success', 'Banner created successfully.');
    }

    public function edit(Banner $banner)
    {
        return view('admin.banners.create', compact('banner')); // Reuse create view
    }

    public function update(Request $request, Banner $banner)
    {
        $data = $request->validate([
            'title' => 'nullable|string|max:255',
            'image_path' => 'nullable|string',
            'image_file' => 'nullable|image|max:5120',
            'type' => 'required|string|in:hero,promo,category,intro',
            'link' => 'nullable|string',
            'is_active' => 'required|in:0,1',
            'order' => 'required|integer',
        ]);

        if ($request->hasFile('image_file')) {
            // Delete old file if exists
            if (!filter_var($banner->image_path, FILTER_VALIDATE_URL) && Storage::disk('public')->exists($banner->image_path)) {
                Storage::disk('public')->delete($banner->image_path);
            }
            $path = $request->file('image_file')->store('banners', 'public');
            $data['image_path'] = $path;
        }

        $banner->update($data);

        return redirect()->route('admin.banners.index')->with('success', 'Banner updated successfully.');
    }

    public function destroy(Banner $banner)
    {
        $banner->delete();
        return redirect()->route('admin.banners.index')->with('success', 'Banner deleted successfully.');
    }
}
