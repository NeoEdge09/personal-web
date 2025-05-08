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
            // 1. Modern Purple - More vibrant gradient
            [
                'name' => 'Modern Purple',
                'is_active' => true,
                'colors' => [
                    'primary_color' => '#7C3AED',
                    'secondary_color' => '#5B21B6',
                    'text_color' => '#374151',
                    'heading_color' => '#111827',
                    'background_color' => '#F5F3FF',
                    'dark_mode_primary_color' => '#A78BFA',
                    'dark_mode_background_color' => '#1F1937',
                ]
            ],
            // 2. Ocean Blue - Deeper, richer tones
            [
                'name' => 'Ocean Blue',
                'is_active' => false,
                'colors' => [
                    'primary_color' => '#2563EB',
                    'secondary_color' => '#1D4ED8',
                    'text_color' => '#475569',
                    'heading_color' => '#0F172A',
                    'background_color' => '#EFF6FF',
                    'dark_mode_primary_color' => '#60A5FA',
                    'dark_mode_background_color' => '#0B1120',
                ]
            ],
            // 3. Emerald Green - More lush and crisp
            [
                'name' => 'Emerald Green',
                'is_active' => false,
                'colors' => [
                    'primary_color' => '#10B981',
                    'secondary_color' => '#047857',
                    'text_color' => '#374151',
                    'heading_color' => '#064E3B',
                    'background_color' => '#ECFDF5',
                    'dark_mode_primary_color' => '#34D399',
                    'dark_mode_background_color' => '#053E2F',
                ]
            ],
            // 4. Amber Glow - Warmer and more luxurious
            [
                'name' => 'Amber Glow',
                'is_active' => false,
                'colors' => [
                    'primary_color' => '#F59E0B',
                    'secondary_color' => '#D97706',
                    'text_color' => '#422006',
                    'heading_color' => '#78350F',
                    'background_color' => '#FFFBEB',
                    'dark_mode_primary_color' => '#FBBF24',
                    'dark_mode_background_color' => '#451A03',
                ]
            ],
            // 5. Rose Passion - More elegant and rich
            [
                'name' => 'Rose Passion',
                'is_active' => false,
                'colors' => [
                    'primary_color' => '#E11D48',
                    'secondary_color' => '#BE123C',
                    'text_color' => '#4B5563',
                    'heading_color' => '#9F1239',
                    'background_color' => '#FFF1F2',
                    'dark_mode_primary_color' => '#FB7185',
                    'dark_mode_background_color' => '#9F1239',
                ]
            ],
            // 6. Midnight Teal - More sophisticated
            [
                'name' => 'Midnight Teal',
                'is_active' => false,
                'colors' => [
                    'primary_color' => '#0D9488',
                    'secondary_color' => '#0F766E',
                    'text_color' => '#334155',
                    'heading_color' => '#134E4A',
                    'background_color' => '#CCFBF1',
                    'dark_mode_primary_color' => '#5EEAD4',
                    'dark_mode_background_color' => '#042F2E',
                ]
            ],
            // 7. Fuchsia Dream - More vibrant and dreamy
            [
                'name' => 'Fuchsia Dream',
                'is_active' => false,
                'colors' => [
                    'primary_color' => '#C026D3',
                    'secondary_color' => '#A21CAF',
                    'text_color' => '#4A044E',
                    'heading_color' => '#6B21A8',
                    'background_color' => '#FAF5FF',
                    'dark_mode_primary_color' => '#E879F9',
                    'dark_mode_background_color' => '#581C87',
                ]
            ],
            // 8. Sky Breeze - More airy and fresh
            [
                'name' => 'Sky Breeze',
                'is_active' => false,
                'colors' => [
                    'primary_color' => '#0EA5E9',
                    'secondary_color' => '#0284C7',
                    'text_color' => '#0C4A6E',
                    'heading_color' => '#075985',
                    'background_color' => '#E0F2FE',
                    'dark_mode_primary_color' => '#38BDF8',
                    'dark_mode_background_color' => '#082F49',
                ]
            ],
            // 9. Lime Zest - More energetic
            [
                'name' => 'Lime Zest',
                'is_active' => false,
                'colors' => [
                    'primary_color' => '#84CC16',
                    'secondary_color' => '#65A30D',
                    'text_color' => '#3F6212',
                    'heading_color' => '#4D7C0F',
                    'background_color' => '#ECFCCB',
                    'dark_mode_primary_color' => '#BEF264',
                    'dark_mode_background_color' => '#1A2E05',
                ]
            ],
            // 10. Slate Elegance - More refined
            [
                'name' => 'Slate Elegance',
                'is_active' => false,
                'colors' => [
                    'primary_color' => '#475569',
                    'secondary_color' => '#334155',
                    'text_color' => '#64748B',
                    'heading_color' => '#1E293B',
                    'background_color' => '#F8FAFC',
                    'dark_mode_primary_color' => '#94A3B8',
                    'dark_mode_background_color' => '#0F172A',
                ]
            ],
            // 11. Coral Sunset - More vivid sunset tones
            [
                'name' => 'Coral Sunset',
                'is_active' => false,
                'colors' => [
                    'primary_color' => '#F43F5E',
                    'secondary_color' => '#E11D48',
                    'text_color' => '#422006',
                    'heading_color' => '#881337',
                    'background_color' => '#FFF1F2',
                    'dark_mode_primary_color' => '#FDA4AF',
                    'dark_mode_background_color' => '#4C0519',
                ]
            ],
            // 12. Nordic Frost - More balanced cool tones
            [
                'name' => 'Nordic Frost',
                'is_active' => false,
                'colors' => [
                    'primary_color' => '#5E81AC',
                    'secondary_color' => '#4C566A',
                    'text_color' => '#3B4252',
                    'heading_color' => '#2E3440',
                    'background_color' => '#E5E9F0',
                    'dark_mode_primary_color' => '#88C0D0',
                    'dark_mode_background_color' => '#2E3440',
                ]
            ],
            // 13. Matcha Zen - More serene
            [
                'name' => 'Matcha Zen',
                'is_active' => false,
                'colors' => [
                    'primary_color' => '#84A98C',
                    'secondary_color' => '#52796F',
                    'text_color' => '#354F52',
                    'heading_color' => '#2F3E46',
                    'background_color' => '#CAD2C5',
                    'dark_mode_primary_color' => '#84A98C',
                    'dark_mode_background_color' => '#2F3E46',
                ]
            ],
            // 14. Plum Elegance - More luxurious
            [
                'name' => 'Plum Elegance',
                'is_active' => false,
                'colors' => [
                    'primary_color' => '#9333EA',
                    'secondary_color' => '#7E22CE',
                    'text_color' => '#4C1D95',
                    'heading_color' => '#6B21A8',
                    'background_color' => '#F3E8FF',
                    'dark_mode_primary_color' => '#C084FC',
                    'dark_mode_background_color' => '#3B0764',
                ]
            ],
            // 15. Sunny Horizon - More cheerful
            [
                'name' => 'Sunny Horizon',
                'is_active' => false,
                'colors' => [
                    'primary_color' => '#FBBF24',
                    'secondary_color' => '#F59E0B',
                    'text_color' => '#78350F',
                    'heading_color' => '#92400E',
                    'background_color' => '#FEFCE8',
                    'dark_mode_primary_color' => '#FDE68A',
                    'dark_mode_background_color' => '#78350F',
                ]
            ],
            // 16. Urban Gray - More contemporary
            [
                'name' => 'Urban Gray',
                'is_active' => false,
                'colors' => [
                    'primary_color' => '#6B7280',
                    'secondary_color' => '#4B5563',
                    'text_color' => '#374151',
                    'heading_color' => '#1F2937',
                    'background_color' => '#F9FAFB',
                    'dark_mode_primary_color' => '#9CA3AF',
                    'dark_mode_background_color' => '#111827',
                ]
            ],
            // 17. Coastal Breeze - More refreshing
            [
                'name' => 'Coastal Breeze',
                'is_active' => false,
                'colors' => [
                    'primary_color' => '#06B6D4',
                    'secondary_color' => '#0891B2',
                    'text_color' => '#155E75',
                    'heading_color' => '#164E63',
                    'background_color' => '#CFFAFE',
                    'dark_mode_primary_color' => '#22D3EE',
                    'dark_mode_background_color' => '#083344',
                ]
            ],
            // 18. Berry Smoothie - More sweet and vibrant
            [
                'name' => 'Berry Smoothie',
                'is_active' => false,
                'colors' => [
                    'primary_color' => '#DB2777',
                    'secondary_color' => '#BE185D',
                    'text_color' => '#831843',
                    'heading_color' => '#9D174D',
                    'background_color' => '#FCE7F3',
                    'dark_mode_primary_color' => '#F472B6',
                    'dark_mode_background_color' => '#500724',
                ]
            ],
            // 19. Desert Sand - More warm and earthy
            [
                'name' => 'Desert Sand',
                'is_active' => false,
                'colors' => [
                    'primary_color' => '#D4A276',
                    'secondary_color' => '#B87333',
                    'text_color' => '#7D4F2A',
                    'heading_color' => '#69351F',
                    'background_color' => '#FBF0EA',
                    'dark_mode_primary_color' => '#E3B587',
                    'dark_mode_background_color' => '#442511',
                ]
            ],
            // 20. Mono Contrast - More dramatic
            [
                'name' => 'Mono Contrast',
                'is_active' => false,
                'colors' => [
                    'primary_color' => '#171717',
                    'secondary_color' => '#404040',
                    'text_color' => '#525252',
                    'heading_color' => '#171717',
                    'background_color' => '#FAFAFA',
                    'dark_mode_primary_color' => '#E5E5E5',
                    'dark_mode_background_color' => '#0A0A0A',
                ]
            ],
            // 21. Soft Peach - More delicate
            [
                'name' => 'Soft Peach',
                'is_active' => false,
                'colors' => [
                    'primary_color' => '#FCA5A5',
                    'secondary_color' => '#F87171',
                    'text_color' => '#7F1D1D',
                    'heading_color' => '#991B1B',
                    'background_color' => '#FEF2F2',
                    'dark_mode_primary_color' => '#FECACA',
                    'dark_mode_background_color' => '#7F1D1D',
                ]
            ],
            // 22. Glacier Mint - More icy fresh
            [
                'name' => 'Glacier Mint',
                'is_active' => false,
                'colors' => [
                    'primary_color' => '#67E8F9',
                    'secondary_color' => '#22D3EE',
                    'text_color' => '#0E7490',
                    'heading_color' => '#155E75',
                    'background_color' => '#ECFEFF',
                    'dark_mode_primary_color' => '#A5F3FC',
                    'dark_mode_background_color' => '#164E63',
                ]
            ],
            // 23. Lavender Dreams - More dreamy
            [
                'name' => 'Lavender Dreams',
                'is_active' => false,
                'colors' => [
                    'primary_color' => '#A78BFA',
                    'secondary_color' => '#8B5CF6',
                    'text_color' => '#5B21B6',
                    'heading_color' => '#6D28D9',
                    'background_color' => '#F3E8FF',
                    'dark_mode_primary_color' => '#C4B5FD',
                    'dark_mode_background_color' => '#4C1D95',
                ]
            ],
            // 24. Forest Whisper - More natural and organic
            [
                'name' => 'Forest Whisper',
                'is_active' => false,
                'colors' => [
                    'primary_color' => '#4D7C0F',
                    'secondary_color' => '#3F6212',
                    'text_color' => '#365314',
                    'heading_color' => '#3F6212',
                    'background_color' => '#F7FEE7',
                    'dark_mode_primary_color' => '#A3E635',
                    'dark_mode_background_color' => '#1A2E05',
                ]
            ],
            // 25. Golden Luxury - More opulent
            [
                'name' => 'Golden Luxury',
                'is_active' => false,
                'colors' => [
                    'primary_color' => '#EAB308',
                    'secondary_color' => '#CA8A04',
                    'text_color' => '#854D0E',
                    'heading_color' => '#713F12',
                    'background_color' => '#FEFCE8',
                    'dark_mode_primary_color' => '#FDE047',
                    'dark_mode_background_color' => '#422006',
                ]
            ],
            // 26. Cherry Blossom - More delicate and seasonal
            [
                'name' => 'Cherry Blossom',
                'is_active' => false,
                'colors' => [
                    'primary_color' => '#FDA4AF',
                    'secondary_color' => '#FB7185',
                    'text_color' => '#9F1239',
                    'heading_color' => '#BE123C',
                    'background_color' => '#FFF1F2',
                    'dark_mode_primary_color' => '#FECDD3',
                    'dark_mode_background_color' => '#881337',
                ]
            ],
            // 27. Ocean Depths - More mysterious
            [
                'name' => 'Ocean Depths',
                'is_active' => false,
                'colors' => [
                    'primary_color' => '#0F766E',
                    'secondary_color' => '#0D9488',
                    'text_color' => '#ECFDF5',
                    'heading_color' => '#D1FAE5',
                    'background_color' => '#134E4A',
                    'dark_mode_primary_color' => '#2DD4BF',
                    'dark_mode_background_color' => '#042F2E',
                ]
            ],
            // 28. Autumn Warmth - More seasonal and rich
            [
                'name' => 'Autumn Warmth',
                'is_active' => false,
                'colors' => [
                    'primary_color' => '#EA580C',
                    'secondary_color' => '#C2410C',
                    'text_color' => '#7C2D12',
                    'heading_color' => '#9A3412',
                    'background_color' => '#FFF7ED',
                    'dark_mode_primary_color' => '#FB923C',
                    'dark_mode_background_color' => '#431407',
                ]
            ],
            // 29. Electric Neon - More futuristic
            [
                'name' => 'Electric Neon',
                'is_active' => false,
                'colors' => [
                    'primary_color' => '#10B981',
                    'secondary_color' => '#059669',
                    'text_color' => '#ECFDF5',
                    'heading_color' => '#D1FAE5',
                    'background_color' => '#111827',
                    'dark_mode_primary_color' => '#34D399',
                    'dark_mode_background_color' => '#030712',
                ]
            ],
            // 30. Pastel Dream - More harmonious
            [
                'name' => 'Pastel Dream',
                'is_active' => false,
                'colors' => [
                    'primary_color' => '#94A3B8',
                    'secondary_color' => '#CBD5E1',
                    'text_color' => '#334155',
                    'heading_color' => '#475569',
                    'background_color' => '#F1F5F9',
                    'dark_mode_primary_color' => '#E2E8F0',
                    'dark_mode_background_color' => '#1E293B',
                ]
            ],
        ];
    }
}
