<?php

namespace App\Http\Controllers;

use App\Models\FlashSale;
use Illuminate\Http\Request;

class FlashSaleController extends Controller
{
    public function show($slug)
    {
        $flashSale = FlashSale::where('slug', $slug)->where('is_active', true)->with('products')->firstOrFail();
        
        // Check if expired (optional: redirect or show expired view)
        // if ($flashSale->end_time->isPast()) { ... }

        return view('flash-sales.show', compact('flashSale'));
    }
}
