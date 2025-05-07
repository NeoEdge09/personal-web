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
        'themes',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'themes' => 'array',
    ];

    public function getLogoUrlAttribute()
    {
        return $this->logo ? asset('storage/' . $this->logo) : null;
    }

    public function getFaviconUrlAttribute()
    {
        return $this->favicon ? asset('storage/' . $this->favicon) : null;
    }

    public function getActiveThemeAttribute()
    {
        $themes = $this->themes ?? [];

        if (empty($themes)) {
            return $this->getDefaultTheme();
        }

        $activeTheme = collect($themes)->firstWhere('is_active', true);
        return $activeTheme ?? $this->getDefaultTheme();
    }

    public function getDefaultTheme()
    {
        $templates = $this->getThemeTemplates();
        return $templates[0]; // Return first theme as default
    }

    public function getThemeTemplates()
    {
        return [
            // 1. Modern Purple
            [
                'name' => 'Modern Purple',
                'is_active' => true,
                'colors' => [
                    'primary_color' => '#8B5CF6',
                    'secondary_color' => '#6D28D9',
                    'text_color' => '#4B5563',
                    'heading_color' => '#1F2937',
                    'background_color' => '#F9FAFB',
                    'dark_mode_primary_color' => '#A78BFA',
                    'dark_mode_background_color' => '#1F2937',
                ]
            ],
            // 2. Ocean Blue
            [
                'name' => 'Ocean Blue',
                'is_active' => false,
                'colors' => [
                    'primary_color' => '#3B82F6',
                    'secondary_color' => '#2563EB',
                    'text_color' => '#4B5563',
                    'heading_color' => '#111827',
                    'background_color' => '#F0F9FF',
                    'dark_mode_primary_color' => '#60A5FA',
                    'dark_mode_background_color' => '#0F172A',
                ]
            ],
            // 3. Emerald Green
            [
                'name' => 'Emerald Green',
                'is_active' => false,
                'colors' => [
                    'primary_color' => '#10B981',
                    'secondary_color' => '#059669',
                    'text_color' => '#4B5563',
                    'heading_color' => '#111827',
                    'background_color' => '#ECFDF5',
                    'dark_mode_primary_color' => '#34D399',
                    'dark_mode_background_color' => '#064E3B',
                ]
            ],
            // 4. Amber Glow
            [
                'name' => 'Amber Glow',
                'is_active' => false,
                'colors' => [
                    'primary_color' => '#F59E0B',
                    'secondary_color' => '#D97706',
                    'text_color' => '#4B5563',
                    'heading_color' => '#111827',
                    'background_color' => '#FFFBEB',
                    'dark_mode_primary_color' => '#FBBF24',
                    'dark_mode_background_color' => '#1E293B',
                ]
            ],
            // 5. Rose Passion
            [
                'name' => 'Rose Passion',
                'is_active' => false,
                'colors' => [
                    'primary_color' => '#F43F5E',
                    'secondary_color' => '#E11D48',
                    'text_color' => '#4B5563',
                    'heading_color' => '#111827',
                    'background_color' => '#FFF1F2',
                    'dark_mode_primary_color' => '#FB7185',
                    'dark_mode_background_color' => '#881337',
                ]
            ],
            // 6. Midnight Teal
            [
                'name' => 'Midnight Teal',
                'is_active' => false,
                'colors' => [
                    'primary_color' => '#14B8A6',
                    'secondary_color' => '#0F766E',
                    'text_color' => '#4B5563',
                    'heading_color' => '#111827',
                    'background_color' => '#F0FDFA',
                    'dark_mode_primary_color' => '#2DD4BF',
                    'dark_mode_background_color' => '#134E4A',
                ]
            ],
            // 7. Fuchsia Dream
            [
                'name' => 'Fuchsia Dream',
                'is_active' => false,
                'colors' => [
                    'primary_color' => '#D946EF',
                    'secondary_color' => '#C026D3',
                    'text_color' => '#4B5563',
                    'heading_color' => '#111827',
                    'background_color' => '#FAF5FF',
                    'dark_mode_primary_color' => '#E879F9',
                    'dark_mode_background_color' => '#701A75',
                ]
            ],
            // 8. Sky Breeze
            [
                'name' => 'Sky Breeze',
                'is_active' => false,
                'colors' => [
                    'primary_color' => '#0EA5E9',
                    'secondary_color' => '#0284C7',
                    'text_color' => '#4B5563',
                    'heading_color' => '#111827',
                    'background_color' => '#F0F9FF',
                    'dark_mode_primary_color' => '#38BDF8',
                    'dark_mode_background_color' => '#0C4A6E',
                ]
            ],
            // 9. Lime Zest
            [
                'name' => 'Lime Zest',
                'is_active' => false,
                'colors' => [
                    'primary_color' => '#84CC16',
                    'secondary_color' => '#65A30D',
                    'text_color' => '#4B5563',
                    'heading_color' => '#111827',
                    'background_color' => '#F7FEE7',
                    'dark_mode_primary_color' => '#A3E635',
                    'dark_mode_background_color' => '#365314',
                ]
            ],
            // 10. Slate Elegance
            [
                'name' => 'Slate Elegance',
                'is_active' => false,
                'colors' => [
                    'primary_color' => '#64748B',
                    'secondary_color' => '#475569',
                    'text_color' => '#4B5563',
                    'heading_color' => '#111827',
                    'background_color' => '#F8FAFC',
                    'dark_mode_primary_color' => '#94A3B8',
                    'dark_mode_background_color' => '#0F172A',
                ]
            ],
        ];
    }
}
