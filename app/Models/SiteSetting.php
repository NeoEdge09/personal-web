<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SiteSetting extends Model
{
    protected $fillable = [
        'site_name',
        'favicon',
        'logo',
        'description',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];
    public function getLogoUrlAttribute()
    {
        return $this->logo ? asset('storage/' . $this->logo) : null;
    }
    public function getFaviconUrlAttribute()
    {
        return $this->favicon ? asset('storage/' . $this->favicon) : null;
    }
}
