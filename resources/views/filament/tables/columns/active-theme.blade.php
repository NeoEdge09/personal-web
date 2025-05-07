@php
    $themes = $getState() ?? [];

    if (is_array($themes) && !empty($themes)) {
        $activeTheme = collect($themes)->firstWhere('is_active', true);
    } else {
        $siteSettings = new \App\Models\SiteSetting();
        $templates = $siteSettings->getThemeTemplates();
        $activeTheme = $templates[0];
    }

    $primaryColor = $activeTheme['colors']['primary_color'] ?? '#8B5CF6';
    $themeName = $activeTheme['name'] ?? 'Modern Purple';
@endphp

<div class="flex items-center space-x-2">
    <div class="w-4 h-4 rounded-full" style="background-color: {{ $primaryColor }}"></div>
    <span>{{ $themeName }}</span>
</div>
