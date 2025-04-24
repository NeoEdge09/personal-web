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
        'published_at',

        // SEO
        'seo_title',
        'seo_keywords',
        'seo_description',
    ];

    protected $casts = [
        'tags' => 'array',
        'seo_keywords' => 'array',
        'published_at' => 'datetime',
        'status' => 'string',
    ];

    public function author()
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    // Tambahkan relasi untuk comments
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    // Method untuk mengambil komentar root (bukan reply)
    public function rootComments()
    {
        return $this->hasMany(Comment::class)->whereNull('parent_id');
    }
}
