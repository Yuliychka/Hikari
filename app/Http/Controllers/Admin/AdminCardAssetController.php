<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CardFrame;
use App\Models\CardAttribute;
use App\Models\CardType;
use App\Models\CardStar;
use Illuminate\Support\Facades\Storage;

class AdminCardAssetController extends Controller
{
    public function index()
    {
        $frames = CardFrame::all();
        $attributes = CardAttribute::all();
        $stars = CardStar::all();
        $cardBack = \App\Models\Setting::where('key', 'card_back_image')->value('value');
        
        return view('admin.card-assets.index', compact('frames', 'attributes', 'stars', 'cardBack'));
    }

    public function storeBack(Request $request) 
    {
        $request->validate([
            'image_file' => 'required|image|max:5120',
        ]);

        $path = $request->file('image_file')->store('card_assets/backs', 'public');

        // Delete old one if exists
        $oldBack = \App\Models\Setting::where('key', 'card_back_image')->value('value');
        if ($oldBack) {
            Storage::disk('public')->delete($oldBack);
        }

        \App\Models\Setting::updateOrCreate(
            ['key' => 'card_back_image'],
            ['value' => $path]
        );

        return redirect()->back()->with('success', 'Global Card Back updated successfully.');
    }

    public function store(Request $request)
    {
        $request->validate([
            'asset_type' => 'required|in:frame,attribute,star',
            'name' => 'required|string|max:255',
            'image_file' => 'required|image|max:5120', // 5MB max
        ]);

        $path = $request->file('image_file')->store('card_assets/' . $request->asset_type . 's', 'public');

        $data = [
            'name' => $request->name,
            'image_path' => $path,
        ];

        switch ($request->asset_type) {
            case 'frame':
                CardFrame::create($data);
                break;
            case 'attribute':
                CardAttribute::create($data);
                break;
            case 'star':
                CardStar::create($data);
                break;
        }

        return redirect()->back()->with('success', ucfirst($request->asset_type) . ' uploaded successfully.');
    }

    public function destroy($type, $id)
    {
        $model = null;

        switch ($type) {
            case 'frame':
                $model = CardFrame::find($id);
                break;
            case 'attribute':
                $model = CardAttribute::find($id);
                break;
            case 'star':
                $model = CardStar::find($id);
                break;
        }

        if ($model) {
            if ($model->image_path) {
                Storage::disk('public')->delete($model->image_path);
            }
            $model->delete();
            return redirect()->back()->with('success', 'Asset deleted successfully.');
        }

        return redirect()->back()->with('error', 'Asset not found.');
    }
}
