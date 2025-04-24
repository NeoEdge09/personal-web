<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MyResume extends Model
{
    use HasFactory;

    protected $fillable = [
        'education',
        'experience',
    ];

    protected $casts = [
        'education' => 'array',
        'experience' => 'array',
    ];
}
