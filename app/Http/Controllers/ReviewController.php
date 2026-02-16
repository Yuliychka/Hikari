<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProductReview;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'nullable|string|max:1000',
        ]);

        $userId = Auth::id();
        $productId = $request->product_id;

        // Verify purchase again for security
        $hasPurchased = Order::where('user_id', $userId)
            ->where('status', 'completed')
            ->whereHas('items', function($query) use ($productId) {
                $query->where('product_id', $productId);
            })->exists();

        if (!$hasPurchased) {
            return redirect()->back()->with('error', 'You must purchase the product to leave a review.');
        }

        // Check if already reviewed
        $existingReview = ProductReview::where('user_id', $userId)
            ->where('product_id', $productId)
            ->first();

        if ($existingReview) {
            $existingReview->update([
                'rating' => $request->rating,
                'comment' => $request->comment,
            ]);
            return redirect()->back()->with('success', 'Your review has been updated!');
        }

        ProductReview::create([
            'user_id' => $userId,
            'product_id' => $productId,
            'rating' => $request->rating,
            'comment' => $request->comment,
        ]);

        return redirect()->back()->with('success', 'Thank you for your review!');
    }
}
