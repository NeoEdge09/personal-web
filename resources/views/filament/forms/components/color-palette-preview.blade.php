<x-dynamic-component :component="$getFieldWrapperView()" :id="$getId()" :label="$getLabel()" :label-sr-only="$isLabelHidden()" :helper-text="$getHelperText()"
    :required="$isRequired()" :state-path="$getStatePath()">
    <div>
        @if ($getState())
            <div class="rounded-xl border border-gray-300 p-4">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-4">
                    @php
                        $colors = collect($getState())->firstWhere('is_active', true)['colors'] ?? [];
                    @endphp

                    @foreach ($colors as $name => $value)
                        <div class="flex flex-col items-center">
                            <div class="w-full h-16 rounded-md mb-2" style="background-color: {{ $value }}"></div>
                            <div class="text-xs text-gray-500">{{ str_replace('_', ' ', ucwords($name)) }}</div>
                            <div class="text-xs font-mono">{{ $value }}</div>
                        </div>
                    @endforeach
                </div>
            </div>
        @else
            <div class="text-sm text-gray-500 italic">Select a theme to preview colors</div>
        @endif
    </div>
</x-dynamic-component>
