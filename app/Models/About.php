<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class About extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'base',
        'main_title',
        'desc',
        'title',
        'cv',
        'image',
        'image_2',
        'email',
        'phone',
        'address',
        'birth_date',
        'education',
        'freelance_status'
    ];

    protected $casts = [
        'title' => 'array',
        'birth_date' => 'date',
    ];
}
