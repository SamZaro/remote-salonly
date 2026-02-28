@php
    $fontFamily = $get('theme_config.font_family') ?? 'Inter';
    $headingFontFamily = $get('theme_config.heading_font_family') ?? 'Poppins';
    $fontSize = $get('theme_config.font_size_base') ?? '16px';

    // Build Google Fonts URL
    $fonts = collect([$fontFamily, $headingFontFamily])
        ->filter(fn($font) => $font && $font !== 'system-ui')
        ->unique()
        ->map(fn($font) => str_replace(' ', '+', $font) . ':wght@400;600;700')
        ->implode('&family=');

    $serifFonts = ['Playfair Display', 'Merriweather', 'Libre Baskerville', 'Lora', 'Lustria', 'Cormorant Garamond', 'DM Serif Display'];
    $getFallback = fn($font) => $font === 'system-ui' ? 'sans-serif' : (in_array($font, $serifFonts) ? 'serif' : 'sans-serif');
@endphp

@if($fonts)
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family={{ $fonts }}&display=swap" rel="stylesheet">
@endif

<div
    class="rounded-lg border border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-800 p-4"
    wire:key="font-preview-{{ md5($fontFamily . $headingFontFamily . $fontSize) }}"
>
    <div class="text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wide mb-3">
        {{ __('Preview') }}
    </div>

    {{-- Heading Font Preview --}}
    <div class="mb-4">
        <div class="text-xs text-gray-400 dark:text-gray-500 mb-1">Heading Font</div>
        <h3
            class="text-2xl font-bold text-gray-900 dark:text-gray-100"
            style="font-family: '{{ $headingFontFamily }}', {{ $getFallback($headingFontFamily) }};"
        >
            {{ $headingFontFamily }}
        </h3>
        <p
            class="text-lg text-gray-700 dark:text-gray-300"
            style="font-family: '{{ $headingFontFamily }}', {{ $getFallback($headingFontFamily) }};"
        >
            The quick brown fox jumps over the lazy dog
        </p>
    </div>

    {{-- Body Font Preview --}}
    <div class="pt-4 border-t border-gray-200 dark:border-gray-600">
        <div class="text-xs text-gray-400 dark:text-gray-500 mb-1">Body Font ({{ $fontSize }})</div>
        <p
            class="font-semibold text-gray-900 dark:text-gray-100"
            style="font-family: '{{ $fontFamily }}', {{ $getFallback($fontFamily) }}; font-size: {{ $fontSize }};"
        >
            {{ $fontFamily }}
        </p>
        <p
            class="text-gray-700 dark:text-gray-300"
            style="font-family: '{{ $fontFamily }}', {{ $getFallback($fontFamily) }}; font-size: {{ $fontSize }};"
        >
            The quick brown fox jumps over the lazy dog. Pack my box with five dozen liquor jugs. 0123456789
        </p>
    </div>
</div>
