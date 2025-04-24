<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Portfolio extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'description',
        'featured_image',
        'category',
        'gallery',
        'status',
    ];

    protected $casts = [
        'gallery' => 'array',
        'status' => 'string',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($portfolio) {
            if (!$portfolio->slug) {
                $portfolio->slug = Str::slug($portfolio->title);
            }
        });
    }
}
