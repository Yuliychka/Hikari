<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Cart;
use App\Models\Product;
use App\Models\Coupon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
    public function index()
    {
        if (Auth::check()) {
            $cartItems = Cart::where('user_id', Auth::id())->with('product')->get();
            
            $subtotal = 0;
            foreach ($cartItems as $item) {
                $subtotal += $item->product->price * $item->quantity;
            }

            // Shipping Logic: Free over $100, else $15
            $shipping = ($subtotal > 100 || $subtotal == 0) ? 0 : 15;
            
            // Coupon Logic
            $discount = 0;
            if (Session::has('coupon') && Session::has('coupon_applied')) {
                $coupon = Session::get('coupon');
                if ($coupon['type'] == 'fixed') {
                    $discount = $coupon['value'];
                } else {
                    $discount = ($subtotal * $coupon['value']) / 100;
                }
            }

            $total = ($subtotal + $shipping) - $discount;
            if ($total < 0) $total = 0;

            if ($cartItems->count() == 0) {
                Session::forget(['coupon', 'coupon_applied']);
            }
            
            return view('cart', compact('cartItems', 'subtotal', 'shipping', 'total', 'discount'));
        } else {
            return redirect()->route('login');
        }
    }

    public function add(Request $request, $id)
    {
        if (!Auth::check()) {
            if ($request->ajax()) return response()->json(['status' => 'error', 'message' => 'Login required'], 401);
            return redirect()->route('login');
        }

        $userId = Auth::id();
        $cartItem = Cart::where('user_id', $userId)->where('product_id', $id)->first();

        if ($cartItem) {
            if ($request->ajax()) {
                $cartItem->delete();
                return response()->json(['status' => 'removed', 'message' => 'Removed from vault']);
            }
            $cartItem->quantity += $request->input('quantity', 1);
            $cartItem->save();
            return redirect()->back()->with('success', 'Cart updated!');
        } else {
            Cart::create([
                'user_id' => $userId,
                'product_id' => $id,
                'quantity' => $request->input('quantity', 1),
            ]);
            if ($request->ajax()) return response()->json(['status' => 'added', 'message' => 'Product added to vault']);
            return redirect()->back()->with('success', 'Product added to vault!');
        }
    }

    public function update(Request $request, $id)
    {
        $cartItem = Cart::where('user_id', Auth::id())->where('id', $id)->with('product')->first();
        if ($cartItem) {
            $cartItem->quantity = $request->input('quantity');
            $cartItem->save();

            if ($request->ajax()) {
                $cartItems = Cart::where('user_id', Auth::id())->with('product')->get();
                $subtotal = 0;
                foreach ($cartItems as $items) {
                    $subtotal += $items->product->price * $items->quantity;
                }
                
                $shipping = ($subtotal > 100 || $subtotal == 0) ? 0 : 15;
                
                $discount = 0;
                if (Session::has('coupon')) {
                    $coupon = Session::get('coupon');
                    if ($coupon['type'] == 'fixed') {
                        $discount = $coupon['value'];
                    } else {
                        $discount = ($subtotal * $coupon['value']) / 100;
                    }
                }

                $total = ($subtotal + $shipping) - $discount;
                if ($total < 0) $total = 0;

                return response()->json([
                    'status' => 'success',
                    'item_subtotal' => number_format($cartItem->product->price * $cartItem->quantity, 2),
                    'cart_subtotal' => number_format($subtotal, 2),
                    'shipping' => $shipping == 0 ? 'FREE' : '$' . number_format($shipping, 2),
                    'discount' => number_format($discount, 2),
                    'total' => number_format($total, 2),
                    'coupon_applied' => Session::get('coupon_applied', false)
                ]);
            }
        }
        return redirect()->back();
    }

    public function remove(Request $request, $id)
    {
        Cart::where('user_id', Auth::id())->where('id', $id)->delete();
        
        if ($request->ajax()) {
            $cartItems = Cart::where('user_id', Auth::id())->with('product')->get();
            $subtotal = 0;
            foreach ($cartItems as $items) {
                $subtotal += $items->product->price * $items->quantity;
            }
            $shipping = ($subtotal > 100 || $subtotal == 0) ? 0 : 15;
            $discount = 0;
            if (Session::has('coupon') && Session::has('coupon_applied')) {
                $coupon = Session::get('coupon');
                $discount = ($coupon['type'] == 'fixed') ? $coupon['value'] : ($subtotal * $coupon['value'] / 100);
            }
            $total = max(0, ($subtotal + $shipping) - $discount);

            return response()->json([
                'success' => true,
                'cart_subtotal' => number_format($subtotal, 2),
                'shipping' => $shipping == 0 ? 'FREE' : '$' . number_format($shipping, 2),
                'discount' => number_format($discount, 2),
                'total' => number_format($total, 2),
                'cart_count' => $cartItems->sum('quantity')
            ]);
        }
        
        return redirect()->back()->with('success', 'Item removed from cart');
    }

    public function applyCoupon(Request $request)
    {
        $code = $request->input('code');
        $coupon = Coupon::where('code', $code)
                        ->where('is_active', true)
                        ->where(function ($query) {
                            $query->whereNull('expires_at')
                                  ->orWhere('expires_at', '>', now());
                        })
                        ->first();

        if ($coupon) {
            Session::put('coupon', [
                'code' => $coupon->code,
                'type' => $coupon->type,
                'value' => $coupon->value
            ]);
            Session::put('coupon_applied', true);

            if ($request->ajax()) {
                $cartItems = Cart::where('user_id', Auth::id())->with('product')->get();
                $subtotal = 0;
                foreach ($cartItems as $item) {
                    $subtotal += $item->product->price * $item->quantity;
                }
                $shipping = ($subtotal > 100 || $subtotal == 0) ? 0 : 15;
                $discount = ($coupon['type'] == 'fixed') ? $coupon['value'] : ($subtotal * $coupon['value'] / 100);
                $total = max(0, ($subtotal + $shipping) - $discount);

                return response()->json([
                    'status' => 'success',
                    'message' => 'Coupon applied successfully!',
                    'discount' => number_format($discount, 2),
                    'total' => number_format($total, 2),
                    'cart_subtotal' => number_format($subtotal, 2),
                    'shipping' => $shipping == 0 ? 'FREE' : '$' . number_format($shipping, 2)
                ]);
            }

            return redirect()->back()->with('success', 'Coupon applied successfully!');
        }

        if ($request->ajax()) {
            return response()->json(['status' => 'error', 'message' => 'Invalid or expired coupon code.'], 422);
        }

        return redirect()->back()->with('error', 'Invalid or expired coupon code.');
    }
}
