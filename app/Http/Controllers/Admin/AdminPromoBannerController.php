<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminPromoBannerController extends Controller
{
    public function index()
    {
        $banners = Banner::where('type', 'promo')->orderBy('order')->get();
        return view('admin.promo-banners.index', compact('banners'));
    }

    public function create()
    {
        return view('admin.promo-banners.create');
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

        $data['type'] = 'promo';

        if ($request->hasFile('image_file')) {
            $path = $request->file('image_file')->store('banners/promo', 'public');
            $data['image_path'] = $path;
        }

        Banner::create($data);

        return redirect()->route('admin.promo-banners.index')->with('success', 'Promo banner created successfully.');
    }

    public function edit(Banner $promoBanner)
    {
        return view('admin.promo-banners.create', compact('promoBanner'));
    }

    public function update(Request $request, Banner $promoBanner)
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
            if ($promoBanner->image_path && !str_starts_with($promoBanner->image_path, 'http')) {
                Storage::disk('public')->delete($promoBanner->image_path);
            }
            $path = $request->file('image_file')->store('banners/promo', 'public');
            $data['image_path'] = $path;
        }

        $promoBanner->update($data);

        return redirect()->route('admin.promo-banners.index')->with('success', 'Promo banner updated successfully.');
    }

    public function destroy(Banner $promoBanner)
    {
        if ($promoBanner->image_path && !str_starts_with($promoBanner->image_path, 'http')) {
            Storage::disk('public')->delete($promoBanner->image_path);
        }

        $promoBanner->delete();

        return redirect()->route('admin.promo-banners.index')->with('success', 'Promo banner deleted successfully.');
    }
}
