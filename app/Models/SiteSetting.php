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
        'primary_color',
        'secondary_color',
        'text_color',
        'heading_color',
        'background_color',
        'dark_mode_primary_color',
        'dark_mode_background_color',
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

    // Default color values if not set
    public function getPrimaryColorAttribute($value)
    {
        return $value ?? '#adff00';
    }

    public function getSecondaryColorAttribute($value)
    {
        return $value ?? '#8acc00';
    }

    public function getTextColorAttribute($value)
    {
        return $value ?? '#615978';
    }

    public function getHeadingColorAttribute($value)
    {
        return $value ?? '#222';
    }

    public function getBackgroundColorAttribute($value)
    {
        return $value ?? '#aab6c2';
    }

    public function getDarkModePrimaryColorAttribute($value)
    {
        return $value ?? '#adff00';
    }

    public function getDarkModeBackgroundColorAttribute($value)
    {
        return $value ?? '#31333c';
    }
}
