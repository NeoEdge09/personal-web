<?php

namespace App\Providers;

use App\Models\SiteSetting;
use App\Models\SocialMedia;
use App\Observers\SiteSettingObserver;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Register observers
        SiteSetting::observe(SiteSettingObserver::class);

        View::composer('*', function ($view) {
            $siteSettings = \App\Models\SiteSetting::first();
            $view->with('siteSettings', $siteSettings);
        });

        View::composer(['partials.header', 'partials.footer'], function ($view) {
            $view->with('socialMedia', SocialMedia::getActive());
        });
    }
}
