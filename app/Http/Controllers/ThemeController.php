<?php

namespace App\Http\Controllers;

use App\Models\SiteSetting;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Response;

class ThemeController extends Controller
{
    public function css()
    {
        // Cache the CSS for 30 minutes to avoid frequent DB queries
        $css = Cache::remember('site_dynamic_css', 1800, function () {
            $settings = SiteSetting::first();

            if (!$settings) {
                return $this->getDefaultCss();
            }

            $activeTheme = $settings->active_theme;

            if (empty($activeTheme) || empty($activeTheme['colors'])) {
                return $this->getDefaultCss();
            }

            return $this->generateCss($activeTheme['colors']);
        });

        return Response::make($css, 200, ['Content-Type' => 'text/css']);
    }

    protected function generateCss($colors)
    {
        $primaryColor = $colors['primary_color'] ?? '#adff00';
        $secondaryColor = $colors['secondary_color'] ?? '#8acc00';
        $textColor = $colors['text_color'] ?? '#615978';
        $headingColor = $colors['heading_color'] ?? '#222';
        $backgroundColor = $colors['background_color'] ?? '#aab6c2';
        $darkPrimaryColor = $colors['dark_mode_primary_color'] ?? '#adff00';
        $darkBackgroundColor = $colors['dark_mode_background_color'] ?? '#31333c';

        return <<<CSS
/* Auto-generated theme CSS */
:root {
    --primary-color: {$primaryColor};
    --secondary-color: {$secondaryColor};
    --text-color: {$textColor};
    --heading-color: {$headingColor};
    --background-color: {$backgroundColor};
}

/* Light mode (default) */
body {
    background-color: var(--background-color);
    color: var(--text-color);
}

h1, h2, h3, h4, h5, h6 {
    color: var(--heading-color);
}

.bg-primary, .btn-primary, .theme-bg-primary {
    background-color: var(--primary-color) !important;
}

.text-primary, .theme-text-primary {
    color: var(--primary-color) !important;
}

.bg-secondary, .btn-secondary, .theme-bg-secondary {
    background-color: var(--secondary-color) !important;
}

.text-secondary, .theme-text-secondary {
    color: var(--secondary-color) !important;
}

.btn-primary {
    border-color: var(--primary-color);
}

.btn-secondary {
    border-color: var(--secondary-color);
}

/* Custom theme elements */
.about-social li a:hover {
    color: var(--primary-color);
}

.services-item, .portfolio-thumbnail, .blog-item {
    border-color: var(--primary-color);
}

/* Dark mode overrides */
@media (prefers-color-scheme: dark) {
    :root {
        --primary-color: {$darkPrimaryColor};
        --background-color: {$darkBackgroundColor};
        --heading-color: #ffffff;
        --text-color: #b0aac0;
    }
    
    body {
        background-color: var(--background-color);
        color: var(--text-color);
    }
    
    h1, h2, h3, h4, h5, h6 {
        color: var(--heading-color);
    }
}
CSS;
    }

    protected function getDefaultCss()
    {
        return $this->generateCss([
            'primary_color' => '#adff00',
            'secondary_color' => '#8acc00',
            'text_color' => '#615978',
            'heading_color' => '#222',
            'background_color' => '#aab6c2',
            'dark_mode_primary_color' => '#adff00',
            'dark_mode_background_color' => '#31333c',
        ]);
    }
}
