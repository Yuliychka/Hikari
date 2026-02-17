<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function index()
    {
        if (Auth::check()) {
            $cartItems = Cart::where('user_id', Auth::id())->with('product')->get();
        } else {
            // Should handle guest cart for fully functional implementation, but keeping simple for now
            $cartItems = collect();
        }
        return view('cart', compact('cartItems'));
    }

    public function add(Request $request, $id)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $userId = Auth::id();
        $cartItem = Cart::where('user_id', $userId)->where('product_id', $id)->first();

        if ($cartItem) {
            // Increment quantity if already in cart
            $cartItem->quantity += $request->input('quantity', 1);
            $cartItem->save();
            return redirect()->back()->with('success', 'Cart updated!');
        } else {
            Cart::create([
                'user_id' => $userId,
                'product_id' => $id,
                'quantity' => $request->input('quantity', 1),
            ]);
            return redirect()->back()->with('success', 'Product added to cart!');
        }
    }

    public function update(Request $request, $id)
    {
        $cartItem = Cart::where('user_id', Auth::id())->where('id', $id)->first();
        if ($cartItem) {
            $cartItem->quantity = $request->input('quantity');
            $cartItem->save();
        }
        return redirect()->back();
    }

    public function remove($id)
    {
        Cart::where('user_id', Auth::id())->where('id', $id)->delete();
        return redirect()->back()->with('success', 'Item removed from cart');
    }
}
