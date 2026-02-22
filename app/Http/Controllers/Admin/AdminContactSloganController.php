<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminContactSloganController extends Controller
{
    public function index()
    {
        $settings = [
            'contact_slogan_title' => Setting::get('contact_slogan_title', 'Contact Us'),
            'contact_slogan_subtitle' => Setting::get('contact_slogan_subtitle', 'Have a Question? Our Team is Ready to Help.'),
            'contact_hq_address' => Setting::get('contact_hq_address', "Akihabara District, 1-2-3 Chiyoda\nTokyo, Japan 101-0021"),
            'contact_email_support_1' => Setting::get('contact_email_support_1', 'support@hikari-store.jp'),
            'contact_email_support_2' => Setting::get('contact_email_support_2', 'orders@hikari-store.jp'),
            'contact_phone_line_1' => Setting::get('contact_phone_line_1', '+81 (03) 1234-5678'),
            'contact_phone_line_2' => Setting::get('contact_phone_line_2', 'Mon-Fri: 9AM - 6PM JST'),
            'contact_slogan_image' => Setting::get('contact_slogan_image', null),
        ];

        return view('admin.contact-slogan.index', compact('settings'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'contact_slogan_title' => 'required|string|max:255',
            'contact_slogan_subtitle' => 'required|string|max:255',
            'contact_hq_address' => 'required|string|max:500',
            'contact_email_support_1' => 'required|string|max:255',
            'contact_email_support_2' => 'nullable|string|max:255',
            'contact_phone_line_1' => 'required|string|max:255',
            'contact_phone_line_2' => 'nullable|string|max:255',
            'contact_slogan_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ]);

        Setting::set('contact_slogan_title', $request->contact_slogan_title);
        Setting::set('contact_slogan_subtitle', $request->contact_slogan_subtitle);
        Setting::set('contact_hq_address', $request->contact_hq_address);
        Setting::set('contact_email_support_1', $request->contact_email_support_1);
        Setting::set('contact_email_support_2', $request->contact_email_support_2);
        Setting::set('contact_phone_line_1', $request->contact_phone_line_1);
        Setting::set('contact_phone_line_2', $request->contact_phone_line_2);

        if ($request->hasFile('contact_slogan_image')) {
            $oldImage = Setting::get('contact_slogan_image');
            if ($oldImage) {
                Storage::disk('public')->delete($oldImage);
            }
            $path = $request->file('contact_slogan_image')->store('slogans', 'public');
            Setting::set('contact_slogan_image', $path);
        }

        return redirect()->route('admin.contact-slogan.index')->with('success', 'Contact settings updated successfully.');
    }
}
