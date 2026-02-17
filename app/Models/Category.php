<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'slug', 'description', 'parent_id', 'image_path', 'is_active', 'order',
        'card_frame_id', 'card_type_id', 'card_attribute_id', 'card_star_id', 
        'card_level', 'card_atk', 'card_def', 'show_card_stats'
    ];

    public function parent()
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(Category::class, 'parent_id')->orderBy('order');
    }

    public function cardFrame()
    {
        return $this->belongsTo(CardFrame::class);
    }

    public function cardAttribute()
    {
        return $this->belongsTo(CardAttribute::class);
    }

    public function cardType()
    {
        return $this->belongsTo(CardType::class);
    }

    public function cardStar()
    {
        return $this->belongsTo(CardStar::class);
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
