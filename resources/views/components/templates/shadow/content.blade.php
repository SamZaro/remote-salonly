{{--
    Template-specifieke content sectie voor Shadow (Barbershop)

    Free-form rich text content sectie met optionele titel en achtergrondafbeelding.
    Props: $content, $theme, $section
--}}
@props([
    'content' => [],
    'theme' => [],
    'section' => null,
])

@php
    use Filament\Forms\Components\RichEditor\RichContentRenderer;

    // Content
    $title = $content['title'] ?? null;
    $body = $content['body'] ?? '';
    $backgroundImage = $section?->getFirstMediaUrl('background') ?: null;

    // Render rich content with RichContentRenderer to preserve classes and styles
    $renderedBody = $body ? RichContentRenderer::make($body)
        ->fileAttachmentsDisk('public')
        ->toHtml() : '';

    // Theme kleuren met defaults
    $primaryColor = $theme['primary_color'] ?? '#f59e0b';
    $secondaryColor = $theme['secondary_color'] ?? '#1f2937';
    $textColor = $theme['text_color'] ?? '#333333';
    $headingColor = $theme['heading_color'] ?? $textColor;
    $backgroundColor = $theme['background_color'] ?? '#ffffff';
@endphp

{{-- Styles for Filament Rich Editor grid layout --}}
<style>
    .rich-content .grid-layout {
        display: grid;
        gap: 1.5rem;
        grid-template-columns: var(--cols, 1fr);
    }
    .rich-content .grid-layout-col {
        grid-column: var(--col-span, span 1);
    }
    /* Handle responsive breakpoints from Rich Editor */
    .rich-content .grid-layout[data-from-breakpoint="sm"] {
        grid-template-columns: 1fr;
    }
    .rich-content .grid-layout[data-from-breakpoint="md"] {
        grid-template-columns: 1fr;
    }
    .rich-content .grid-layout[data-from-breakpoint="lg"] {
        grid-template-columns: 1fr;
    }
    @media (min-width: 640px) {
        .rich-content .grid-layout[data-from-breakpoint="sm"] {
            grid-template-columns: var(--cols, 1fr);
        }
    }
    @media (min-width: 768px) {
        .rich-content .grid-layout[data-from-breakpoint="md"] {
            grid-template-columns: var(--cols, 1fr);
        }
    }
    @media (min-width: 1024px) {
        .rich-content .grid-layout[data-from-breakpoint="lg"] {
            grid-template-columns: var(--cols, 1fr);
        }
    }
</style>

<section id="content" class="relative py-20 lg:py-28 overflow-hidden" style="background-color: {{ $backgroundColor }};">
    {{-- Optional background image with overlay --}}
    @if($backgroundImage)
        <div class="absolute inset-0">
            <img src="{{ $backgroundImage }}" alt="" class="w-full h-full object-cover opacity-5" />
        </div>
    @endif

    <div class="relative mx-auto max-w-4xl px-4 sm:px-6 lg:px-8">
        {{-- Optional title with accent line --}}
        @if($title)
            <div class="mb-12 text-center"
                x-data x-intersect.once="$el.style.opacity = 1; $el.style.transform = 'translateY(0)'"
                style="opacity: 0; transform: translateY(16px); transition: all 0.8s cubic-bezier(0.22, 1, 0.36, 1);"
            >
                <h2
                    class="text-3xl sm:text-4xl lg:text-5xl font-bold mb-4"
                    style="color: {{ $headingColor }};"
                >
                    {{ $title }}
                </h2>
                <div class="w-20 h-1 mx-auto" style="background-color: {{ $primaryColor }};"></div>
            </div>
        @endif

        {{-- Rich text content --}}
        @if($renderedBody)
            <div
                x-data x-intersect.once="$el.style.opacity = 1; $el.style.transform = 'translateY(0)'"
                class="rich-content prose prose-lg lg:prose-xl max-w-none
                    prose-headings:font-bold prose-headings:mb-4
                    prose-p:leading-relaxed prose-p:mb-6
                    prose-a:font-semibold prose-a:no-underline hover:prose-a:underline
                    prose-img:shadow-lg
                    prose-blockquote:border-l-4 prose-blockquote:pl-6 prose-blockquote:italic
                    prose-ul:space-y-2 prose-ol:space-y-2
                    prose-table:border-collapse prose-th:p-3 prose-td:p-3
                    prose-code:px-2 prose-code:py-1 prose-code:rounded prose-code:text-sm
                    prose-pre:p-4 prose-pre:overflow-x-auto
                    [&_.lead]:text-lg [&_.lead]:leading-relaxed
                    [&_.small]:text-sm [&_.small]:opacity-75
                    [&_mark]:bg-yellow-200 [&_mark]:px-1"
                style="
                    color: {{ $textColor }};
                    --tw-prose-body: {{ $textColor }};
                    --tw-prose-headings: {{ $headingColor }};
                    --tw-prose-links: {{ $primaryColor }};
                    --tw-prose-bold: {{ $headingColor }};
                    --tw-prose-bullets: {{ $primaryColor }};
                    --tw-prose-counters: {{ $primaryColor }};
                    --tw-prose-quote-borders: {{ $primaryColor }};
                    --tw-prose-quotes: {{ $textColor }};
                    --tw-prose-code: {{ $secondaryColor }};
                    --tw-prose-th-borders: {{ $primaryColor }};
                    --tw-prose-td-borders: color-mix(in srgb, {{ $textColor }} 20%, transparent);
                    opacity: 0; transform: translateY(16px); transition: all 0.8s cubic-bezier(0.22, 1, 0.36, 1) 0.15s;
                "
            >
                {!! $renderedBody !!}
            </div>
        @endif
    </div>
</section>
