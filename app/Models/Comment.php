<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = [
        'content',
        'blog_id',
        'user_id',
        'user_name',
        'email',
        'parent_id'
    ];

    // Relasi ke Blog
    public function blog()
    {
        return $this->belongsTo(Blog::class);
    }

    // Relasi ke User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relasi ke komentar parent (untuk replies)
    public function parent()
    {
        return $this->belongsTo(Comment::class, 'parent_id');
    }

    // Relasi ke replies
    public function replies()
    {
        return $this->hasMany(Comment::class, 'parent_id');
    }
}
