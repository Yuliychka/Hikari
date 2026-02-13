<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Wishlist;
use Illuminate\Support\Facades\Auth;

class WishlistController extends Controller
{
    public function index()
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $wishlistItems = Wishlist::where('user_id', Auth::id())->with('product')->get();
        return view('wishlist', compact('wishlistItems'));
    }

    public function toggle($id)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $userId = Auth::id();
        $wishlist = Wishlist::where('user_id', $userId)->where('product_id', $id)->first();

        if ($wishlist) {
            $wishlist->delete();
            return redirect()->back()->with('success', 'Product removed from wishlist!');
        } else {
            Wishlist::create([
                'user_id' => $userId,
                'product_id' => $id,
            ]);
            return redirect()->back()->with('success', 'Product added to wishlist!');
        }
    }
}
