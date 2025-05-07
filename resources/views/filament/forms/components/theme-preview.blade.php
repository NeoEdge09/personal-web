<div>
    @php
        $livewire = $getLivewire();
        $selectedTheme = $livewire->selected_theme ?? 'Modern Purple';

        // Get the theme data
        $siteSettings = new \App\Models\SiteSetting();
        $themes = $siteSettings->getThemeTemplates();
        $activeTheme = collect($themes)->firstWhere('name', $selectedTheme);

        if (!$activeTheme) {
            $activeTheme = $themes[0];
        }

        // Extract colors
        $colors = $activeTheme['colors'];
        $primaryColor = $colors['primary_color'] ?? '#8B5CF6';
        $secondaryColor = $colors['secondary_color'] ?? '#6D28D9';
        $textColor = $colors['text_color'] ?? '#4B5563';
        $headingColor = $colors['heading_color'] ?? '#1F2937';
        $backgroundColor = $colors['background_color'] ?? '#F9FAFB';
        $darkPrimaryColor = $colors['dark_mode_primary_color'] ?? '#A78BFA';
        $darkBackgroundColor = $colors['dark_mode_background_color'] ?? '#1F2937';
    @endphp

    <div class="p-4 rounded-lg border">
        <h3 class="text-lg font-bold mb-4">{{ $selectedTheme }} Theme Preview</h3>

        <!-- Color Palette -->
        <div class="flex flex-wrap gap-3 mb-6">
            <div class="flex flex-col items-center">
                <div class="w-12 h-12 rounded-full mb-1" style="background-color: {{ $primaryColor }}"></div>
                <span class="text-xs">Primary</span>
            </div>
            <div class="flex flex-col items-center">
                <div class="w-12 h-12 rounded-full mb-1" style="background-color: {{ $secondaryColor }}"></div>
                <span class="text-xs">Secondary</span>
            </div>
            <div class="flex flex-col items-center">
                <div class="w-12 h-12 rounded-full mb-1" style="background-color: {{ $textColor }}"></div>
                <span class="text-xs">Text</span>
            </div>
            <div class="flex flex-col items-center">
                <div class="w-12 h-12 rounded-full mb-1" style="background-color: {{ $headingColor }}"></div>
                <span class="text-xs">Heading</span>
            </div>
            <div class="flex flex-col items-center">
                <div class="w-12 h-12 rounded-full border mb-1" style="background-color: {{ $backgroundColor }}"></div>
                <span class="text-xs">Background</span>
            </div>
        </div>

        <!-- Theme Preview -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <!-- Light Mode Preview -->
            <div class="p-4 rounded border" style="background-color: {{ $backgroundColor }};">
                <div class="text-sm font-medium mb-2">Light Mode</div>
                <div class="mb-3">
                    <h4 style="color: {{ $headingColor }}; font-weight: 600;">Heading Example</h4>
                    <p style="color: {{ $textColor }};">This is how your content will look with this theme.</p>
                </div>
                <div class="flex gap-2 mb-3">
                    <button class="px-3 py-1 rounded text-white text-sm" style="background-color: {{ $primaryColor }};">
                        Primary Button
                    </button>
                    <button class="px-3 py-1 rounded text-white text-sm"
                        style="background-color: {{ $secondaryColor }};">
                        Secondary Button
                    </button>
                </div>
                <div class="p-2 rounded"
                    style="background-color: {{ $primaryColor }}20; border: 1px solid {{ $primaryColor }};">
                    <span style="color: {{ $primaryColor }}; font-weight: 500;">Highlighted Section</span>
                </div>
            </div>

            <!-- Dark Mode Preview -->
            <div class="p-4 rounded border" style="background-color: {{ $darkBackgroundColor }};">
                <div class="text-sm font-medium mb-2 text-white">Dark Mode</div>
                <div class="mb-3">
                    <h4 style="color: #ffffff; font-weight: 600;">Heading Example</h4>
                    <p style="color: #b0aac0;">This is how your content will look with this theme.</p>
                </div>
                <div class="flex gap-2 mb-3">
                    <button class="px-3 py-1 rounded text-sm"
                        style="background-color: {{ $darkPrimaryColor }}; color: {{ $darkBackgroundColor }};">
                        Primary Button
                    </button>
                    <button class="px-3 py-1 rounded text-white text-sm"
                        style="background-color: {{ $secondaryColor }};">
                        Secondary Button
                    </button>
                </div>
                <div class="p-2 rounded"
                    style="background-color: {{ $darkPrimaryColor }}20; border: 1px solid {{ $darkPrimaryColor }};">
                    <span style="color: {{ $darkPrimaryColor }}; font-weight: 500;">Highlighted Section</span>
                </div>
            </div>
        </div>
    </div>
</div>
