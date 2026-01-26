@php
    use App\Services\TemplateService;
    $templateService = app(TemplateService::class);
@endphp

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    @include('components.layouts.partials.head')

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="antialiased">
    {{-- Navigation --}}
    @livewire('navigation')

    {{-- Preview Mode Indicator --}}
    @if($isPreview ?? false)
        <div class="fixed top-0 left-0 right-0 z-[9999] bg-blue-600 text-white px-4 py-2 text-center text-sm font-medium shadow-lg">
            <div class="flex items-center justify-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                </svg>
                <span>Preview Mode: {{ $template?->name ?? 'Template' }}</span>
            </div>
        </div>
    @endif

    {{-- Template Sections --}}
    @if($template && $sections->isNotEmpty())
        @foreach($sections as $section)
            @php
                $viewName = $templateService->resolveSectionView($section->section_type, $template->slug);
                // Remove 'components.' prefix for x-dynamic-component
                $componentName = str_starts_with($viewName, 'components.')
                    ? substr($viewName, 11)
                    : $viewName;
            @endphp

            <x-dynamic-component
                :component="$componentName"
                :content="$section->content ?? []"
                :theme="$theme"
                :section="$section"
            />
        @endforeach
    @else
        {{-- Fallback als geen template is ingesteld --}}
        <div class="min-h-screen flex items-center justify-center bg-gray-100">
            <div class="text-center px-4">
                <h1 class="text-4xl font-bold text-gray-900 mb-4">Welkom</h1>
                <p class="text-lg text-gray-600 mb-8">Je website wordt momenteel ingericht.</p>
                <a href="/dashboard" class="inline-flex items-center px-6 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
                    Naar Dashboard
                </a>
            </div>
        </div>
    @endif

    {{-- Back to Top Button --}}
    <button
        id="backToTopBtn"
        class="hidden fixed bottom-6 right-6 z-50 bg-gray-500 text-white p-3 rounded-full shadow-lg hover:bg-gray-600 transition"
        onclick="window.scrollTo({top: 0, behavior: 'smooth'})"
        aria-label="Back to top"
    >
        <svg xmlns="http://www.w3.org/2000/svg"
            class="w-6 h-6"
            fill="none"
            viewBox="0 0 24 24"
            stroke="currentColor"
            stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M5 15l7-7 7 7" />
        </svg>
    </button>

    <script>
        const backToTopBtn = document.getElementById("backToTopBtn");
        window.addEventListener("scroll", () => {
            if (window.scrollY > 300) {
                backToTopBtn.classList.remove("hidden");
            } else {
                backToTopBtn.classList.add("hidden");
            }
        });
    </script>

    @stack('scripts')
</body>
</html>
