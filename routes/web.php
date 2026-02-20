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
    $newArrivals = \App\Models\Product::latest()->take(12)->get();
    $bestSellers = \App\Models\Product::bestSellers(4)->get();
    $featured = \App\Models\Product::inRandomOrder()->take(8)->get();
    $otakuChoice = \App\Models\Product::inRandomOrder()->first();

    // Fetch Banners
    $heroBanners = \App\Models\Banner::where('type', 'hero')->where('is_active', true)->orderBy('order')->get();
    $heroCarousel = \App\Models\Setting::where('key', 'hero_carousel')->value('value') ?? '0';
    $heroEffect = \App\Models\Setting::where('key', 'hero_effect')->value('value') ?? 'none';
    $promoBanner = \App\Models\FlashSale::where('is_active', true)->where('end_time', '>', now())->orderBy('created_at', 'desc')->first();
    $categoryBanners = \App\Models\Category::where('is_active', true)->whereNotNull('image_path')->orderBy('order')->get();
    $introBanners = \App\Models\Banner::where('type', 'intro')->where('is_active', true)->orderBy('order')->get();
    $introActive = \App\Models\Setting::where('key', 'intro_active')->value('value') ?? '1';
    
    // Hero Text Settings
    $heroTitle = \App\Models\Setting::where('key', 'hero_title')->value('value') ?? 'HIKARI ANIME STORE';
    $heroSubtitle = \App\Models\Setting::where('key', 'hero_subtitle')->value('value') ?? 'Premium Manga & Anime Merchandise';
    $heroDescription = \App\Models\Setting::where('key', 'hero_description')->value('value') ?? 'Discover our exclusive collection of hand-forged katanas, figures, and apparel.';
    $heroBtnText = \App\Models\Setting::where('key', 'hero_btn_text')->value('value') ?? 'SHOP NOW';

    return view('index', compact(
        'newArrivals', 'bestSellers', 'featured', 'otakuChoice', 
        'heroBanners', 'heroCarousel', 'heroEffect', 'promoBanner', 
        'categoryBanners', 'introBanners', 'introActive',
        'heroTitle', 'heroSubtitle', 'heroDescription', 'heroBtnText'
    ));
});

Route::get('/about', function () {
    return view('about');
})->name('about');

Route::get('/contact', function () {
    return view('contact');
})->name('contact');

Route::get('/shipping-policy', function () {
    return view('policies.shipping');
})->name('policies.shipping');

Route::get('/returns-policy', function () {
    return view('policies.returns');
})->name('policies.returns');

// Product Routes
Route::get('/products', [ProductController::class, 'index'])->name('products.index');
Route::get('/categories', [ProductController::class, 'categories'])->name('categories.index');
Route::get('/product/{id}', [ProductController::class, 'getProductById'])->name('products.show');

// Cart Routes
Route::middleware('auth')->group(function () {
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('/cart/add/{id}', [CartController::class, 'add'])->name('cart.add');
    Route::patch('/cart/update/{id}', [CartController::class, 'update'])->name('cart.update');
    Route::delete('/cart/remove/{id}', [CartController::class, 'remove'])->name('cart.remove');
    Route::post('/cart/coupon', [CartController::class, 'applyCoupon'])->name('cart.coupon');

    // Wishlist Routes
    Route::get('/wishlist', [WishlistController::class, 'index'])->name('wishlist.index');
    Route::post('/wishlist/toggle/{id}', [WishlistController::class, 'toggle'])->name('wishlist.toggle');
    Route::delete('/wishlist/remove/{id}', [WishlistController::class, 'remove'])->name('wishlist.remove');

    // Order Routes
    Route::get('/checkout', [OrderController::class, 'checkout'])->name('orders.checkout');
    Route::post('/orders', [OrderController::class, 'store'])->name('orders.store');
    Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
    Route::get('/orders/{order}', [App\Http\Controllers\OrderController::class, 'show'])->name('orders.show');
    Route::get('/flash-sales/{slug}', [App\Http\Controllers\FlashSaleController::class, 'show'])->name('flash-sales.show');
});

Route::middleware(['auth', 'verified', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [App\Http\Controllers\Admin\AdminDashboardController::class, 'index'])->name('dashboard');
    
    // Product Management
    Route::post('products/{product}/toggle', [App\Http\Controllers\Admin\AdminProductController::class, 'toggleStatus'])->name('products.toggle');
    Route::resource('products', App\Http\Controllers\Admin\AdminProductController::class);
    
    // Category Management
    Route::resource('categories', App\Http\Controllers\Admin\AdminCategoryController::class);
    
    // Review Management
    Route::post('reviews', [App\Http\Controllers\ReviewController::class, 'store'])->name('reviews.store');
    
    
    // Banner Management - Separated by Type
    Route::post('hero-banners/update-settings', [App\Http\Controllers\Admin\AdminHeroBannerController::class, 'updateSettings'])->name('hero-banners.update-settings');
    Route::post('hero-banners/{heroBanner}/toggle', [App\Http\Controllers\Admin\AdminHeroBannerController::class, 'toggleStatus'])->name('hero-banners.toggle');
    Route::resource('hero-banners', App\Http\Controllers\Admin\AdminHeroBannerController::class);
    Route::resource('category-banners', App\Http\Controllers\Admin\AdminCategoryBannerController::class);
    Route::resource('intro-panels', App\Http\Controllers\Admin\AdminIntroPanelController::class);
    Route::post('intro-panels/update-settings', [App\Http\Controllers\Admin\AdminIntroPanelController::class, 'updateSettings'])->name('intro-panels.update-settings');
    Route::resource('promo-banners', App\Http\Controllers\Admin\AdminPromoBannerController::class);
    
    // Keep old route for backward compatibility (optional)
    Route::resource('banners', App\Http\Controllers\Admin\AdminBannerController::class);

    // Order Management
    Route::get('/orders', [App\Http\Controllers\Admin\AdminOrderController::class, 'index'])->name('orders.index');
    Route::patch('/orders/{order}/status', [App\Http\Controllers\Admin\AdminOrderController::class, 'updateStatus'])->name('orders.updateStatus');

    // Coupon Management
    Route::resource('coupons', App\Http\Controllers\Admin\AdminCouponController::class);
    Route::resource('flash-sales', App\Http\Controllers\Admin\AdminFlashSaleController::class);
    
    // Card Assets
    Route::resource('card-assets', \App\Http\Controllers\Admin\AdminCardAssetController::class)->only(['index', 'store']);
    Route::post('card-assets/back', [\App\Http\Controllers\Admin\AdminCardAssetController::class, 'storeBack'])->name('card-assets.storeBack');
    Route::delete('card-assets/{type}/{id}', [\App\Http\Controllers\Admin\AdminCardAssetController::class, 'destroy'])->name('card-assets.destroy');

    // Site Settings
    Route::get('/settings', [App\Http\Controllers\Admin\SettingController::class, 'index'])->name('settings.index');
    Route::put('/settings', [App\Http\Controllers\Admin\SettingController::class, 'update'])->name('settings.update');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
