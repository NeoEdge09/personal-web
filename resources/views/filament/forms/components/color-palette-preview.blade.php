<x-dynamic-component :component="$getFieldWrapperView()" :field="$field">
    @php
        $state = $getState();

        // Extract colors from state
        $primaryColor = $state['primary_color'] ?? '#8B5CF6';
        $secondaryColor = $state['secondary_color'] ?? '#6D28D9';
        $textColor = $state['text_color'] ?? '#4B5563';
        $headingColor = $state['heading_color'] ?? '#1F2937';
        $backgroundColor = $state['background_color'] ?? '#F9FAFB';
        $darkPrimaryColor = $state['dark_mode_primary_color'] ?? '#A78BFA';
        $darkBackgroundColor = $state['dark_mode_background_color'] ?? '#1F2937';
    @endphp

    <div class="space-y-6">
        <div class="space-y-2">
            <h3 class="text-lg font-medium">Theme Preview</h3>
            <div class="flex gap-3 mb-4">
                <div class="w-10 h-10 rounded-full" style="background-color: {{ $primaryColor }}"></div>
                <div class="w-10 h-10 rounded-full" style="background-color: {{ $secondaryColor }}"></div>
                <div class="w-10 h-10 rounded-full" style="background-color: {{ $textColor }}"></div>
                <div class="w-10 h-10 rounded-full" style="background-color: {{ $headingColor }}"></div>
                <div class="w-10 h-10 rounded-full border" style="background-color: {{ $backgroundColor }}"></div>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Light Mode Preview -->
            <div class="col-span-1">
                <div class="text-sm font-medium mb-2">Light Mode</div>
                <div class="p-6 rounded-xl border shadow-sm" style="background-color: {{ $backgroundColor }};">
                    <div class="mb-4">
                        <h1
                            style="color: {{ $headingColor }}; font-size: 1.5rem; font-weight: 700; margin-bottom: 0.5rem;">
                            Website Heading</h1>
                        <p style="color: {{ $textColor }}; margin-bottom: 1rem;">This is how your regular text will
                            appear on your website. Making sure it's readable is important for a good user experience.
                        </p>

                        <div class="flex flex-wrap gap-2 mb-4">
                            <button class="px-4 py-2 rounded-md text-white"
                                style="background-color: {{ $primaryColor }};">
                                Primary Button
                            </button>
                            <button class="px-4 py-2 rounded-md text-white"
                                style="background-color: {{ $secondaryColor }};">
                                Secondary Button
                            </button>
                        </div>

                        <div class="p-4 rounded-lg"
                            style="background-color: {{ $primaryColor }}20; border: 1px solid {{ $primaryColor }};">
                            <div style="color: {{ $primaryColor }}; font-weight: 500;">Feature highlight section</div>
                            <p style="color: {{ $textColor }}; font-size: 0.875rem;">Content in a highlighted
                                section with your primary color.</p>
                        </div>
                    </div>

                    <div class="flex items-center gap-3 mt-4">
                        <div class="w-8 h-8 rounded-full flex items-center justify-center"
                            style="background-color: {{ $primaryColor }}; color: white;">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20"
                                fill="currentColor">
                                <path fill-rule="evenodd"
                                    d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                    clip-rule="evenodd" />
                            </svg>
                        </div>
                        <span style="color: {{ $textColor }};">Modern Design</span>
                    </div>
                </div>
            </div>

            <!-- Dark Mode Preview -->
            <div class="col-span-1">
                <div class="text-sm font-medium mb-2">Dark Mode</div>
                <div class="p-6 rounded-xl border shadow-sm" style="background-color: {{ $darkBackgroundColor }};">
                    <div class="mb-4">
                        <h1 style="color: #ffffff; font-size: 1.5rem; font-weight: 700; margin-bottom: 0.5rem;">Website
                            Heading</h1>
                        <p style="color: #b0aac0; margin-bottom: 1rem;">This is how your regular text will appear on
                            your website in dark mode. Ensuring good contrast is crucial.</p>

                        <div class="flex flex-wrap gap-2 mb-4">
                            <button class="px-4 py-2 rounded-md"
                                style="background-color: {{ $darkPrimaryColor }}; color: {{ $darkBackgroundColor }};">
                                Primary Button
                            </button>
                            <button class="px-4 py-2 rounded-md text-white"
                                style="background-color: {{ $secondaryColor }};">
                                Secondary Button
                            </button>
                        </div>

                        <div class="p-4 rounded-lg"
                            style="background-color: {{ $darkPrimaryColor }}20; border: 1px solid {{ $darkPrimaryColor }};">
                            <div style="color: {{ $darkPrimaryColor }}; font-weight: 500;">Feature highlight section
                            </div>
                            <p style="color: #b0aac0; font-size: 0.875rem;">Content in a highlighted section with your
                                dark mode primary color.</p>
                        </div>
                    </div>

                    <div class="flex items-center gap-3 mt-4">
                        <div class="w-8 h-8 rounded-full flex items-center justify-center"
                            style="background-color: {{ $darkPrimaryColor }}; color: {{ $darkBackgroundColor }};">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20"
                                fill="currentColor">
                                <path fill-rule="evenodd"
                                    d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                    clip-rule="evenodd" />
                            </svg>
                        </div>
                        <span style="color: #b0aac0;">Modern Design</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-dynamic-component>
