<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Banner;
use App\Models\Order;
use Illuminate\Http\Request;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'total_products' => Product::count(),
            'total_banners' => Banner::count(),
            'total_orders' => Order::count(),
            'recent_orders' => Order::latest()->take(5)->get(),
        ];

        return view('admin.dashboard', compact('stats'));
    }
}
