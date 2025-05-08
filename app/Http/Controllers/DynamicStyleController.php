<?php

namespace App\Http\Controllers;

use App\Models\SiteSetting;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Cache;

class DynamicStyleController extends Controller
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

        return (new Response($css, 200))
            ->header('Content-Type', 'text/css')
            ->header('Cache-Control', 'public, max-age=3600');
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

        $css = "
            :root {
                --primary-color: {$primaryColor};
                --secondary-color: {$secondaryColor};
                --text-color: {$textColor};
                --heading-color: {$headingColor};
                --background-color: {$backgroundColor};
                --dark-mode-primary: {$darkPrimaryColor};
                --dark-mode-background: {$darkBackgroundColor};
            }
            
            /* Primary color elements */
            .btn-main, .section-title h2:before, .section-title h2:after, 
            .site-header .nav-link.active, 
            .hero-area .hero-head strong,
            .site-header .nav-social a:hover,
            .blog-section .post-meta li a:hover,
            .site-footer .back-to-top a,
            .service-section .icon-box {
                color: var(--heading-color);
                background-color: var(--primary-color);
            }
            
            /* Text color elements */
            body {
                color: var(--text-color);
                background: var(--background-color);
            }
            
            /* Heading colors */
            h1, h2, h3, h4, h5, h6 {
                color: var(--heading-color);
            }
            
            /* Links and accents */
            a {
                color: var(--primary-color);
            }
            
            a:hover {
                color: var(--secondary-color);
            }
            
            /* Button hovers */
            .btn-main:hover {
                background: var(--secondary-color);
            }
            
            /* Section title colors */
            .section-title h2 span, 
            .block-title span,
            .about-section .content-block h2 span,
            .skill-section h2 span {
                color: var(--primary-color);
            }
            
            /* Border colors */
            .btn-ghost {
                border: 2px solid var(--primary-color);
            }
            
            .btn-ghost:hover {
                background: var(--primary-color);
            }
            
            /* Dark mode styles */
            .dark-mode {
                background: var(--dark-mode-background);
            }
            
            .dark-mode h1, .dark-mode h2, .dark-mode h3, 
            .dark-mode h4, .dark-mode h5, .dark-mode h6 {
                color: #fff;
            }
            
            .dark-mode a {
                color: var(--dark-mode-primary);
            }
            
            .dark-mode .btn-main, 
            .dark-mode .site-header .nav-link.active,
            .dark-mode .service-section .icon-box {
                background-color: var(--dark-mode-primary);
            }
            
            /* Custom theme elements */
            .about-social li a:hover {
                color: var(--primary-color);
            }
            
            .services-item, .portfolio-thumbnail, .blog-item {
                border-color: var(--primary-color);
            }
            
           
        ";

        return $css;
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
