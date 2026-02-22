<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminStoreSloganController extends Controller
{
    public function index()
    {
        $settings = [
            'store_slogan_title' => Setting::get('store_slogan_title', 'Anime Collection'),
            'store_slogan_subtitle' => Setting::get('store_slogan_subtitle', 'Discover Your Next Obsession'),
            'store_slogan_image' => Setting::get('store_slogan_image', null),
        ];

        return view('admin.store-slogan.index', compact('settings'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'store_slogan_title' => 'required|string|max:255',
            'store_slogan_subtitle' => 'required|string|max:255',
            'store_slogan_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ]);

        Setting::set('store_slogan_title', $request->store_slogan_title);
        Setting::set('store_slogan_subtitle', $request->store_slogan_subtitle);

        if ($request->hasFile('store_slogan_image')) {
            $oldImage = Setting::get('store_slogan_image');
            if ($oldImage) {
                Storage::disk('public')->delete($oldImage);
            }
            $path = $request->file('store_slogan_image')->store('slogans', 'public');
            Setting::set('store_slogan_image', $path);
        }

        return redirect()->route('admin.store-slogan.index')->with('success', 'Store Slogan updated successfully.');
    }
}
