@php
    $templateService = app(\App\Services\TemplateService::class);
    $description = isset($description) ? $description : config('app.description');
    $canonical = isset($canonical) ? $canonical : url()->current();
    $faviconUrl = $templateService->getActiveTemplate()?->favicon_url ?? asset('images/favicon.ico');
@endphp

<meta name="description" content="{{ $description }}">
<link rel="canonical" href="{{ $canonical }}">

<title>
    @isset($title)
        {{ $title }} | {{ config('app.name', 'Webvue') }}
    @else
        {{ config('app.name', 'Webvue') }}
    @endisset
</title>

<link rel="shortcut icon" href="{{ $faviconUrl }}">

@include('components.layouts.partials.social-cards')

<!-- Dynamische Fonts -->
<?php
    $theme = $templateService->getTheme() ?? [];
    $fontFamily = $theme['font_family'] ?? 'Inter';
    $headingFontFamily = $theme['heading_font_family'] ?? 'Poppins';
    $fontSize = $theme['font_size_base'] ?? '16px';

    // Determine fallback font type
    $serifFonts = ['Playfair Display', 'Merriweather', 'Libre Baskerville', 'Lora', 'Cormorant Garamond', 'DM Serif Display'];
    $fontFallback = ($fontFamily === 'system-ui') ? 'sans-serif' : (in_array($fontFamily, $serifFonts) ? 'serif' : 'sans-serif');
    $headingFallback = ($headingFontFamily === 'system-ui') ? 'sans-serif' : (in_array($headingFontFamily, $serifFonts) ? 'serif' : 'sans-serif');

    // Collect unique fonts for Google Fonts (exclude system-ui)
    $fonts = collect([$fontFamily, $headingFontFamily])
        ->filter(fn($font) => $font && $font !== 'system-ui')
        ->unique()
        ->map(fn($font) => str_replace(' ', '+', $font) . ':wght@300;400;500;600;700;800;900')
        ->implode('&family=');
?>
<?php if(!empty($fonts)): ?>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=<?= $fonts ?>&display=swap" rel="stylesheet">
<?php endif; ?>
<style>
    :root {
        --font-family: "<?= $fontFamily ?>", <?= $fontFallback ?>;
        --font-family-heading: "<?= $headingFontFamily ?>", <?= $headingFallback ?>;
        --font-size-base: <?= $fontSize ?>;
    }
    body {
        font-family: var(--font-family);
        font-size: var(--font-size-base);
    }
    h1, h2, h3, h4, h5, h6 {
        font-family: var(--font-family-heading);
    }
</style>

<!-- Scripts -->
@vite(['resources/css/app.css'])

@stack('head')

@livewireStyles
