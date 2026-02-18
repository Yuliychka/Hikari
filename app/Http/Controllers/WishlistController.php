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

    public function toggle(Request $request, $id)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $userId = Auth::id();
        $wishlist = Wishlist::where('user_id', $userId)->where('product_id', $id)->first();

        if ($wishlist) {
            $wishlist->delete();
            if ($request->ajax()) return response()->json(['status' => 'removed', 'message' => 'Removed from wishlist']);
            return redirect()->back()->with('success', 'Product removed from wishlist!');
        } else {
            Wishlist::create([
                'user_id' => $userId,
                'product_id' => $id,
            ]);
            if ($request->ajax()) return response()->json(['status' => 'added', 'message' => 'Added to wishlist']);
            return redirect()->back()->with('success', 'Product added to wishlist!');
        }
    }

    public function remove($id)
    {
        Wishlist::where('user_id', Auth::id())->where('id', $id)->delete();
        return redirect()->back()->with('success', 'Item removed from wishlist');
    }
}
