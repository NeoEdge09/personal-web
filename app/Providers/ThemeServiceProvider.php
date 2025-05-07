<?php

namespace App\Providers;

use App\Models\SiteSetting;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Vite;
use Illuminate\Support\Facades\Cache;

class ThemeServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        // Add the theme bindings to Vite
        Vite::macro('theme', function () {
            // Cache theme for 30 minutes to avoid frequent DB queries
            $themeVars = Cache::remember('site_theme_vars', 1800, function () {
                $settings = SiteSetting::first();
                
                if (!$settings) {
                    return $this->getDefaultThemeValues();
                }
                
                $activeTheme = $settings->active_theme;
                
                if (empty($activeTheme) || empty($activeTheme['colors'])) {
                    return $this->getDefaultThemeValues();
                }
                
                return [
                    'primary_color' => $activeTheme['colors']['primary_color'] ?? '#adff00',
                    'secondary_color' => $activeTheme['colors']['secondary_color'] ?? '#8acc00',
                    'text_color' => $activeTheme['colors']['text_color'] ?? '#615978',
                    'heading_color' => $activeTheme['colors']['heading_color'] ?? '#222',
                    'background_color' => $activeTheme['colors']['background_color'] ?? '#aab6c2',
                    'dark_mode_primary_color' => $activeTheme['colors']['dark_mode_primary_color'] ?? '#adff00',
                    'dark_mode_background_color' => $activeTheme['colors']['dark_mode_background_color'] ?? '#31333c',
                ];
            });
            
            return $themeVars;
        });

        // Helper function to provide default theme values 
        // (Defined inside the macro to be accessible via $this)
        Vite::macro('getDefaultThemeValues', function() {
            return [
                'primary_color' => '#adff00',
                'secondary_color' => '#8acc00',
                'text_color' => '#615978',
                'heading_color' => '#222',
                'background_color' => '#aab6c2',
                'dark_mode_primary_color' => '#adff00',
                'dark_mode_background_color' => '#31333c',
            ];
        });

        View::composer('*', function ($view) {
            $view->with('themeVars', Vite::theme());
        });
    }
}
