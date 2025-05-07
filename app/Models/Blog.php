<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'content',
        'featured_image',
        'category',
        'tags',
        'author_id',
        'status',

        // SEO
        'seo_title',
        'seo_keywords',
        'seo_description',
    ];

    protected $casts = [
        'tags' => 'array',
        'seo_keywords' => 'array',
        'status' => 'string',
    ];

    public function author()
    {
        return $this->belongsTo(User::class, 'author_id');
    }
}
