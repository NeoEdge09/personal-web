<?php

namespace App\Http\Controllers;

use App\Models\SiteSetting;
use Illuminate\Http\Response;

class DynamicStyleController extends Controller
{
    public function css()
    {
        $settings = SiteSetting::first() ?? new SiteSetting();

        $css = "
            :root {
                --primary-color: {$settings->primary_color};
                --secondary-color: {$settings->secondary_color};
                --text-color: {$settings->text_color};
                --heading-color: {$settings->heading_color};
                --background-color: {$settings->background_color};
                --dark-mode-primary: {$settings->dark_mode_primary_color};
                --dark-mode-background: {$settings->dark_mode_background_color};
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
        ";

        return (new Response($css, 200))
            ->header('Content-Type', 'text/css')
            ->header('Cache-Control', 'public, max-age=3600');
    }
}
