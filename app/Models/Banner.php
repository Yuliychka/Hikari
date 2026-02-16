<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    use HasFactory;

    protected $fillable = [
        'type',
        'category_id',
        'title',
        'subtitle',
        'description',
        'btn_text',
        'image_path',
        'link',
        'order',
        'is_active'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
