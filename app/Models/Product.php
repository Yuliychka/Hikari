<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'subcategory_id',
        'name',
        'description',
        'price',
        'old_price',
        'sku',
        'image',
        'status',
        'stock_quantity',
        'discount_active',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function subcategory()
    {
        return $this->belongsTo(Category::class, 'subcategory_id');
    }

    public function images()
    {
        return $this->hasMany(ProductImage::class);
    }

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function reviews()
    {
        return $this->hasMany(ProductReview::class);
    }

    public function isInCart($userId)
    {
        return \App\Models\Cart::where('user_id', $userId)->where('product_id', $this->id)->exists();
    }

    public function isInWishlist($userId)
    {
        return \App\Models\Wishlist::where('user_id', $userId)->where('product_id', $this->id)->exists();
    }

    public function scopeBestSellers($query, $limit = 4)
    {
        return $query->withCount('orderItems')
            ->orderBy('order_items_count', 'desc')
            ->limit($limit);
    }
}
