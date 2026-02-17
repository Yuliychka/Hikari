<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CardAttribute extends Model
{
    protected $fillable = ['name', 'image_path'];
}
