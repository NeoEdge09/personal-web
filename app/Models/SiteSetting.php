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
        return $templates[0];
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
            [
                'name' => 'Coral Sunset',
                'is_active' => false,
                'colors' => [
                    'primary_color' => '#FF6B6B',
                    'secondary_color' => '#FF8787',
                    'text_color' => '#495057',
                    'heading_color' => '#212529',
                    'background_color' => '#FFF5F5',
                    'dark_mode_primary_color' => '#FA5252',
                    'dark_mode_background_color' => '#2B2B2B',
                ]
            ],
            // 12. Nordic Frost
            [
                'name' => 'Nordic Frost',
                'is_active' => false,
                'colors' => [
                    'primary_color' => '#81A1C1',
                    'secondary_color' => '#5E81AC',
                    'text_color' => '#4C566A',
                    'heading_color' => '#2E3440',
                    'background_color' => '#ECEFF4',
                    'dark_mode_primary_color' => '#88C0D0',
                    'dark_mode_background_color' => '#2E3440',
                ]
            ],
            // 13. Matcha Zen
            [
                'name' => 'Matcha Zen',
                'is_active' => false,
                'colors' => [
                    'primary_color' => '#9CBE5E',
                    'secondary_color' => '#7DA63F',
                    'text_color' => '#5C6E58',
                    'heading_color' => '#3C4A3E',
                    'background_color' => '#F1F8E9',
                    'dark_mode_primary_color' => '#AED581',
                    'dark_mode_background_color' => '#33472E',
                ]
            ],
            // 14. Plum Elegance
            [
                'name' => 'Plum Elegance',
                'is_active' => false,
                'colors' => [
                    'primary_color' => '#9C27B0',
                    'secondary_color' => '#7B1FA2',
                    'text_color' => '#4A4A4A',
                    'heading_color' => '#212121',
                    'background_color' => '#F3E5F5',
                    'dark_mode_primary_color' => '#BA68C8',
                    'dark_mode_background_color' => '#3E2253',
                ]
            ],
            // 15. Sunny Horizon
            [
                'name' => 'Sunny Horizon',
                'is_active' => false,
                'colors' => [
                    'primary_color' => '#FFB400',
                    'secondary_color' => '#F29F05',
                    'text_color' => '#474747',
                    'heading_color' => '#262626',
                    'background_color' => '#FFFAEB',
                    'dark_mode_primary_color' => '#FFD54F',
                    'dark_mode_background_color' => '#3D3A2E',
                ]
            ],
            // 16. Urban Gray
            [
                'name' => 'Urban Gray',
                'is_active' => false,
                'colors' => [
                    'primary_color' => '#607D8B',
                    'secondary_color' => '#546E7A',
                    'text_color' => '#555555',
                    'heading_color' => '#263238',
                    'background_color' => '#ECEFF1',
                    'dark_mode_primary_color' => '#90A4AE',
                    'dark_mode_background_color' => '#263238',
                ]
            ],
            // 17. Coastal Breeze
            [
                'name' => 'Coastal Breeze',
                'is_active' => false,
                'colors' => [
                    'primary_color' => '#4FC3F7',
                    'secondary_color' => '#29B6F6',
                    'text_color' => '#546E7A',
                    'heading_color' => '#0D47A1',
                    'background_color' => '#E1F5FE',
                    'dark_mode_primary_color' => '#40C4FF',
                    'dark_mode_background_color' => '#01579B',
                ]
            ],
            // 18. Berry Smoothie
            [
                'name' => 'Berry Smoothie',
                'is_active' => false,
                'colors' => [
                    'primary_color' => '#EC407A',
                    'secondary_color' => '#D81B60',
                    'text_color' => '#5D4037',
                    'heading_color' => '#311B92',
                    'background_color' => '#FCE4EC',
                    'dark_mode_primary_color' => '#F48FB1',
                    'dark_mode_background_color' => '#4A148C',
                ]
            ],
            // 19. Desert Sand
            [
                'name' => 'Desert Sand',
                'is_active' => false,
                'colors' => [
                    'primary_color' => '#BCAAA4',
                    'secondary_color' => '#A1887F',
                    'text_color' => '#5D4037',
                    'heading_color' => '#3E2723',
                    'background_color' => '#EFEBE9',
                    'dark_mode_primary_color' => '#D7CCC8',
                    'dark_mode_background_color' => '#3E2723',
                ]
            ],
            // 20. Mono Contrast
            [
                'name' => 'Mono Contrast',
                'is_active' => false,
                'colors' => [
                    'primary_color' => '#212121',
                    'secondary_color' => '#424242',
                    'text_color' => '#757575',
                    'heading_color' => '#212121',
                    'background_color' => '#FAFAFA',
                    'dark_mode_primary_color' => '#E0E0E0',
                    'dark_mode_background_color' => '#121212',
                ]
            ],
            // 20. Mono Contrast
            [
                'name' => 'Mono Contrast',
                'is_active' => false,
                'colors' => [
                    'primary_color' => '#212121',
                    'secondary_color' => '#424242',
                    'text_color' => '#757575',
                    'heading_color' => '#212121',
                    'background_color' => '#FAFAFA',
                    'dark_mode_primary_color' => '#E0E0E0',
                    'dark_mode_background_color' => '#121212',
                ]
            ],
            // 21. Soft Peach
            [
                'name' => 'Soft Peach',
                'is_active' => false,
                'colors' => [
                    'primary_color' => '#FFAB91',
                    'secondary_color' => '#FF8A65',
                    'text_color' => '#5D4037',
                    'heading_color' => '#3E2723',
                    'background_color' => '#FFF3E0',
                    'dark_mode_primary_color' => '#FFCCBC',
                    'dark_mode_background_color' => '#3E2723',
                ]
            ],
            // 22. Glacier Mint
            [
                'name' => 'Glacier Mint',
                'is_active' => false,
                'colors' => [
                    'primary_color' => '#80DEEA',
                    'secondary_color' => '#4DD0E1',
                    'text_color' => '#37474F',
                    'heading_color' => '#263238',
                    'background_color' => '#E0F7FA',
                    'dark_mode_primary_color' => '#B2EBF2',
                    'dark_mode_background_color' => '#006064',
                ]
            ],
            // 23. Lavender Dreams
            [
                'name' => 'Lavender Dreams',
                'is_active' => false,
                'colors' => [
                    'primary_color' => '#B39DDB',
                    'secondary_color' => '#9575CD',
                    'text_color' => '#4A148C',
                    'heading_color' => '#311B92',
                    'background_color' => '#F3E5F5',
                    'dark_mode_primary_color' => '#D1C4E9',
                    'dark_mode_background_color' => '#311B92',
                ]
            ],
            // 24. Forest Whisper
            [
                'name' => 'Forest Whisper',
                'is_active' => false,
                'colors' => [
                    'primary_color' => '#558B2F',
                    'secondary_color' => '#33691E',
                    'text_color' => '#3E2723',
                    'heading_color' => '#1B5E20',
                    'background_color' => '#F1F8E9',
                    'dark_mode_primary_color' => '#8BC34A',
                    'dark_mode_background_color' => '#1B5E20',
                ]
            ],
            // 25. Golden Luxury
            [
                'name' => 'Golden Luxury',
                'is_active' => false,
                'colors' => [
                    'primary_color' => '#FFD700',
                    'secondary_color' => '#FFC107',
                    'text_color' => '#5D4037',
                    'heading_color' => '#3E2723',
                    'background_color' => '#FFFDE7',
                    'dark_mode_primary_color' => '#FFECB3',
                    'dark_mode_background_color' => '#3E2723',
                ]
            ],
            // 26. Cherry Blossom
            [
                'name' => 'Cherry Blossom',
                'is_active' => false,
                'colors' => [
                    'primary_color' => '#F8BBD0',
                    'secondary_color' => '#F48FB1',
                    'text_color' => '#6A1B9A',
                    'heading_color' => '#4A148C',
                    'background_color' => '#FCE4EC',
                    'dark_mode_primary_color' => '#F8BBD0',
                    'dark_mode_background_color' => '#4A148C',
                ]
            ],
            // 27. Ocean Depths
            [
                'name' => 'Ocean Depths',
                'is_active' => false,
                'colors' => [
                    'primary_color' => '#00796B',
                    'secondary_color' => '#00695C',
                    'text_color' => '#E0F2F1',
                    'heading_color' => '#B2DFDB',
                    'background_color' => '#004D40',
                    'dark_mode_primary_color' => '#80CBC4',
                    'dark_mode_background_color' => '#004D40',
                ]
            ],
            // 28. Autumn Warmth
            [
                'name' => 'Autumn Warmth',
                'is_active' => false,
                'colors' => [
                    'primary_color' => '#E65100',
                    'secondary_color' => '#EF6C00',
                    'text_color' => '#3E2723',
                    'heading_color' => '#BF360C',
                    'background_color' => '#FFF3E0',
                    'dark_mode_primary_color' => '#FF9800',
                    'dark_mode_background_color' => '#3E2723',
                ]
            ],
            // 29. Electric Neon
            [
                'name' => 'Electric Neon',
                'is_active' => false,
                'colors' => [
                    'primary_color' => '#00E676',
                    'secondary_color' => '#1DE9B6',
                    'text_color' => '#FFFFFF',
                    'heading_color' => '#FFFFFF',
                    'background_color' => '#212121',
                    'dark_mode_primary_color' => '#69F0AE',
                    'dark_mode_background_color' => '#000000',
                ]
            ],
            // 30. Pastel Dream
            [
                'name' => 'Pastel Dream',
                'is_active' => false,
                'colors' => [
                    'primary_color' => '#B2EBF2',
                    'secondary_color' => '#C5CAE9',
                    'text_color' => '#5D4037',
                    'heading_color' => '#3949AB',
                    'background_color' => '#E8EAF6',
                    'dark_mode_primary_color' => '#D1C4E9',
                    'dark_mode_background_color' => '#303F9F',
                ]
            ],
        ];
    }
}
