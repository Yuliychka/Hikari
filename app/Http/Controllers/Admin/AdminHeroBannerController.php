<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

use App\Models\Setting;

class AdminHeroBannerController extends Controller
{
    public function index()
    {
        $heroBanners = Banner::where('type', 'hero')->orderBy('order')->get();
        $carouselMode = Setting::where('key', 'hero_carousel')->value('value') ?? '0';
        $heroEffect = Setting::where('key', 'hero_effect')->value('value') ?? 'none';
        $heroEffect = Setting::where('key', 'hero_effect')->value('value') ?? 'none';
        return view('admin.hero-banners.index', compact('heroBanners', 'carouselMode', 'heroEffect'));
    }

    public function create()
    {
        return view('admin.hero-banners.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'nullable|string|max:255',
            'subtitle' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'btn_text' => 'nullable|string|max:50',
            'image_path' => 'nullable|string',
            'image_file' => 'nullable|image|max:5120',
            'link' => 'nullable|string',
            'is_active' => 'required|boolean',
            'order' => 'required|integer',
        ]);

        $data['type'] = 'hero';

        // 1. Handle Image Upload vs URL
        if ($request->hasFile('image_file')) {
            $path = $request->file('image_file')->store('banners/hero', 'public');
            $data['image_path'] = $path;
        } elseif ($request->filled('image_url')) {
             // If manual URL provided (renamed input to image_url in view to match logic if needed, or stick to image_path)
             // The view likely uses 'image_path' for the text input. Let's assume input name='image_path'
             // If validation pass, $data['image_path'] is already set.
        }
        
        // Ensure we have an image
        if (empty($data['image_path']) && empty($request->file('image_file'))) {
             return redirect()->back()->withErrors(['image_file' => 'Please provide an image URL or upload a file.'])->withInput();
        }

        // Logic: Push existing orders down if collision exists
        // We use lockForUpdate to prevent race conditions ideally, but simple increment is ok for now.



        // Logic: Push existing orders down if collision exists
        if (Banner::where('type', 'hero')->where('order', $data['order'])->exists()) {
            Banner::where('type', 'hero')
                  ->where('order', '>=', $data['order'])
                  ->increment('order');
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
            'subtitle' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'btn_text' => 'nullable|string|max:50',
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



        // Logic: Push existing orders down if changing order to a taken slot
        if ($request->has('order') && $heroBanner->order != $data['order']) {
             if (Banner::where('type', 'hero')->where('order', $data['order'])->exists()) {
                Banner::where('type', 'hero')
                      ->where('order', '>=', $data['order'])
                      ->where('id', '!=', $heroBanner->id) // Don't shift self
                      ->increment('order');
            }
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

    public function updateSettings(Request $request)
    {
        $data = $request->validate([
            'hero_carousel' => 'nullable|boolean',
            'hero_effect' => 'nullable|string|in:none,sakura,lightning'
        ]);

        if($request->has('hero_carousel')) {
             Setting::updateOrCreate(['key' => 'hero_carousel'], ['value' => $request->hero_carousel ? '1' : '0']);
        }
        
        if($request->has('hero_effect')) {
             Setting::updateOrCreate(['key' => 'hero_effect'], ['value' => $request->hero_effect]);
        }
        
        return redirect()->back()->with('success', 'Global settings updated successfully.');
    }

    public function toggleStatus(Banner $heroBanner)
    {
        $heroBanner->update(['is_active' => !$heroBanner->is_active]);
        
        $status = $heroBanner->is_active ? 'Activated' : 'Hidden';
        return redirect()->back()->with('success', "Banner {$status} successfully.");
    }
}
