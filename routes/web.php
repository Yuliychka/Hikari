<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\WishlistController;
use App\Http\Controllers\OrderController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    // Fetch products
    $newArrivals = \App\Models\Product::latest()->take(4)->get();
    $bestSellers = \App\Models\Product::inRandomOrder()->take(4)->get();
    $featured = \App\Models\Product::inRandomOrder()->take(8)->get();
    $otakuChoice = \App\Models\Product::inRandomOrder()->first();

    // Fetch Banners
    $heroBanner = \App\Models\Banner::where('type', 'hero')->where('is_active', true)->first();
    $promoBanner = \App\Models\Banner::where('type', 'promo')->where('is_active', true)->first();
    $categoryBanners = \App\Models\Banner::where('type', 'category')->where('is_active', true)->orderBy('order')->take(3)->get();

    return view('welcome', compact('newArrivals', 'bestSellers', 'featured', 'otakuChoice', 'heroBanner', 'promoBanner', 'categoryBanners'));
});

Route::get('/about', function () {
    return view('about');
})->name('about');

// Product Routes
Route::get('/index', [ProductController::class, 'index'])->name('products.index');
Route::get('/product/{id}', [ProductController::class, 'getProductById'])->name('products.show');

// Cart Routes
Route::middleware('auth')->group(function () {
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('/cart/add/{id}', [CartController::class, 'add'])->name('cart.add');
    Route::patch('/cart/update/{id}', [CartController::class, 'update'])->name('cart.update');
    Route::delete('/cart/remove/{id}', [CartController::class, 'remove'])->name('cart.remove');

    // Wishlist Routes
    Route::get('/wishlist', [WishlistController::class, 'index'])->name('wishlist.index');
    Route::post('/wishlist/toggle/{id}', [WishlistController::class, 'toggle'])->name('wishlist.toggle');

    // Order Routes
    Route::get('/checkout', [OrderController::class, 'checkout'])->name('orders.checkout');
    Route::post('/orders', [OrderController::class, 'store'])->name('orders.store');
    Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
    Route::get('/orders/{id}', [OrderController::class, 'show'])->name('orders.show');
});

Route::middleware(['auth', 'verified', 'admin'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
