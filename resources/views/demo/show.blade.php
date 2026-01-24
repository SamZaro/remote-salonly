@php
    use App\Services\TemplateService;
    $templateService = app(TemplateService::class);
    $mainSiteUrl = config('app.main_site_url');
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

    {{-- Template Sections --}}
    @if($template && $sections->isNotEmpty())
        @foreach($sections as $section)
            @php
                $viewName = $templateService->resolveSectionView($section->section_type, $template->slug);
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
        <div class="min-h-screen flex items-center justify-center bg-gray-100">
            <div class="text-center px-4">
                <h1 class="text-4xl font-bold text-gray-900 mb-4">Template niet gevonden</h1>
                <p class="text-lg text-gray-600 mb-8">Dit template heeft nog geen secties.</p>
                <a href="{{ $mainSiteUrl }}/templates" class="inline-flex items-center px-6 py-3 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700">
                    Bekijk alle templates
                </a>
            </div>
        </div>
    @endif

    {{-- Demo Banner (Bottom) --}}
    <div class="fixed bottom-0 left-0 right-0 z-50 bg-gradient-to-r from-indigo-600 to-purple-600 text-white shadow-[0_-4px_20px_rgba(0,0,0,0.15)]">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col sm:flex-row items-center justify-between gap-2 py-3 sm:py-4">
                {{-- Demo label --}}
                <div class="flex items-center gap-2">
                    <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                    </svg>
                    <span class="text-sm font-medium">
                        Demo: <strong>{{ $template->name }}</strong>
                    </span>
                </div>
                {{-- Actions --}}
                <div class="flex items-center gap-3">
                    <a href="{{ $mainSiteUrl }}/templates"
                        class="inline-flex items-center gap-1.5 text-sm text-white/90 hover:text-white transition"
                    >
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z" />
                        </svg>
                        <span>Alle templates</span>
                    </a>

                    <a href="{{ $mainSiteUrl }}/templates/{{ $template->category->slug }}/{{ $template->slug }}"
                        class="inline-flex items-center gap-1.5 px-4 py-2 bg-white text-indigo-600 text-sm font-semibold rounded-full hover:bg-indigo-50 transition shadow-sm"
                    >
                        <span>Bekijk details</span>
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6" />
                        </svg>
                    </a>
                </div>
            </div>
        </div>
    </div>

    {{-- Back to Top Button --}}
    <button
        id="backToTopBtn"
        class="hidden fixed bottom-24 right-6 z-40 bg-gray-500 text-white p-3 rounded-full shadow-lg hover:bg-gray-600 transition"
        onclick="window.scrollTo({top: 0, behavior: 'smooth'})"
        aria-label="Back to top"
    >
        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M5 15l7-7 7 7" />
        </svg>
    </button>

    <script>
        // Back to top button
        const backToTopBtn = document.getElementById("backToTopBtn");
        window.addEventListener("scroll", () => {
            backToTopBtn.classList.toggle("hidden", window.scrollY <= 300);
        });

        // Disable forms in demo mode
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('form').forEach(function(form) {
                form.addEventListener('submit', function(e) {
                    e.preventDefault();

                    const notification = document.createElement('div');
                    notification.className = 'fixed top-4 left-1/2 -translate-x-1/2 z-[9999] bg-amber-500 text-white px-6 py-3 rounded-lg shadow-lg text-sm font-medium';
                    notification.textContent = 'Formulieren zijn uitgeschakeld in demo modus';
                    document.body.appendChild(notification);
                    setTimeout(() => notification.remove(), 3000);
                });
            });
        });
    </script>

    @stack('scripts')
</body>
</html>
