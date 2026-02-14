<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminHeroBannerController extends Controller
{
    public function index()
    {
        $banners = Banner::where('type', 'hero')->orderBy('order')->get();
        return view('admin.hero-banners.index', compact('banners'));
    }

    public function create()
    {
        return view('admin.hero-banners.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'nullable|string|max:255',
            'image_path' => 'nullable|string',
            'image_file' => 'nullable|image|max:5120',
            'link' => 'nullable|string',
            'is_active' => 'required|boolean',
            'order' => 'required|integer',
        ]);

        $data['type'] = 'hero';

        if ($request->hasFile('image_file')) {
            $path = $request->file('image_file')->store('banners/hero', 'public');
            $data['image_path'] = $path;
        }

        Banner::create($data);

        return redirect()->route('admin.hero-banners.index')->with('success', 'Hero banner created successfully.');
    }

    public function edit(Banner $heroBanner)
    {
        return view('admin.hero-banners.create', compact('heroBanner'));
    }

    public function update(Request $request, Banner $heroBanner)
    {
        $data = $request->validate([
            'title' => 'nullable|string|max:255',
            'image_path' => 'nullable|string',
            'image_file' => 'nullable|image|max:5120',
            'link' => 'nullable|string',
            'is_active' => 'required|boolean',
            'order' => 'required|integer',
        ]);

        if ($request->hasFile('image_file')) {
            if ($heroBanner->image_path && !str_starts_with($heroBanner->image_path, 'http')) {
                Storage::disk('public')->delete($heroBanner->image_path);
            }
            $path = $request->file('image_file')->store('banners/hero', 'public');
            $data['image_path'] = $path;
        }

        $heroBanner->update($data);

        return redirect()->route('admin.hero-banners.index')->with('success', 'Hero banner updated successfully.');
    }

    public function destroy(Banner $heroBanner)
    {
        if ($heroBanner->image_path && !str_starts_with($heroBanner->image_path, 'http')) {
            Storage::disk('public')->delete($heroBanner->image_path);
        }

        $heroBanner->delete();

        return redirect()->route('admin.hero-banners.index')->with('success', 'Hero banner deleted successfully.');
    }
}
