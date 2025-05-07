<?php

namespace App\Observers;

use App\Models\SiteSetting;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Cache;

class SiteSettingObserver
{
    /**
     * Handle the SiteSetting "created" event.
     */
    public function created(SiteSetting $siteSetting): void
    {
        $this->clearThemeCache();
    }

    /**
     * Handle the SiteSetting "updated" event.
     */
    public function updated(SiteSetting $siteSetting): void
    {
        $this->clearThemeCache();
    }

    /**
     * Handle the SiteSetting "deleted" event.
     */
    public function deleted(SiteSetting $siteSetting): void
    {
        $this->clearThemeCache();
    }

    /**
     * Clear the theme-related caches.
     */
    private function clearThemeCache(): void
    {
        Cache::forget('site_theme_vars');
        Cache::forget('site_dynamic_css');
    }
}
