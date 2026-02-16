<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

use App\Models\Setting;

class AdminIntroPanelController extends Controller
{
    public function index()
    {
        $banners = Banner::where('type', 'intro')->orderBy('order')->get();
        $introActive = Setting::where('key', 'intro_active')->value('value') ?? '1';
        return view('admin.intro-panels.index', compact('banners', 'introActive'));
    }

    public function updateSettings(Request $request)
    {
        Setting::updateOrCreate(['key' => 'intro_active'], ['value' => $request->has('intro_active') ? '1' : '0']);
        return redirect()->back()->with('success', 'Intro settings updated successfully.');
    }

    public function create()
    {
        return view('admin.intro-panels.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'nullable|string|max:255',
            'image_path' => 'nullable|string',
            'image_file' => 'nullable|image|max:20480',
            'link' => 'nullable|string',
            'is_active' => 'required|boolean',
            'order' => 'required|integer',
        ]);

        $data['type'] = 'intro';

        if ($request->hasFile('image_file')) {
            $path = $request->file('image_file')->store('banners/intro', 'public');
            $data['image_path'] = $path;
        }

        Banner::create($data);

        return redirect()->route('admin.intro-panels.index')->with('success', 'Intro panel created successfully.');
    }

    public function edit(Banner $introPanel)
    {
        return view('admin.intro-panels.create', compact('introPanel'));
    }

    public function update(Request $request, Banner $introPanel)
    {
        $data = $request->validate([
            'title' => 'nullable|string|max:255',
            'image_path' => 'nullable|string',
            'image_file' => 'nullable|image|max:20480',
            'link' => 'nullable|string',
            'is_active' => 'required|boolean',
            'order' => 'required|integer',
        ]);

        if ($request->hasFile('image_file')) {
            if ($introPanel->image_path && !str_starts_with($introPanel->image_path, 'http')) {
                Storage::disk('public')->delete($introPanel->image_path);
            }
            $path = $request->file('image_file')->store('banners/intro', 'public');
            $data['image_path'] = $path;
        }

        $introPanel->update($data);

        return redirect()->route('admin.intro-panels.index')->with('success', 'Intro panel updated successfully.');
    }

    public function destroy(Banner $introPanel)
    {
        if ($introPanel->image_path && !str_starts_with($introPanel->image_path, 'http')) {
            Storage::disk('public')->delete($introPanel->image_path);
        }

        $introPanel->delete();

        return redirect()->route('admin.intro-panels.index')->with('success', 'Intro panel deleted successfully.');
    }
}
