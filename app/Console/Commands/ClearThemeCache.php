<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Cache;

class ClearThemeCache extends Command
{
    protected $signature = 'theme:clear-cache';
    protected $description = 'Clear all theme-related caches';

    public function handle()
    {
        Cache::forget('site_theme_vars');
        Cache::forget('site_dynamic_css');

        $this->info('Theme cache cleared successfully!');

        return Command::SUCCESS;
    }
}
