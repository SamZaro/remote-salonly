{{--
    Content section - Free-form rich text content

    Displays rich text content with optional title and background image.
    Props: $content, $theme, $section
--}}
@props([
    'content' => [],
    'theme' => [],
    'section' => null,
])

@php
    use Filament\Forms\Components\RichEditor\RichContentRenderer;

    $title = $content['title'] ?? null;
    $body = $content['body'] ?? '';
    $backgroundImage = $section?->getFirstMediaUrl('background') ?: null;

    // Render rich content with RichContentRenderer to preserve classes and styles
    $renderedBody = $body ? RichContentRenderer::make($body)
        ->fileAttachmentsDisk('public')
        ->toHtml() : '';

    // Theme kleuren
    $backgroundColor = $theme['background_color'] ?? '#ffffff';
    $headingColor = $theme['heading_color'] ?? '#111827';
    $headingFontFamily = $theme['heading_font_family'] ?? 'inherit';
    $textColor = $theme['text_color'] ?? '#1f2937';
    $primaryColor = $theme['primary_color'] ?? '#3b82f6';
@endphp

<section
    id="content"
    class="relative py-16 lg:py-20 overflow-hidden"
    style="background-color: {{ $backgroundColor }};"
>
    {{-- Optional background image --}}
    @if($backgroundImage)
        <div class="absolute inset-0">
            <img src="{{ $backgroundImage }}" alt="" class="w-full h-full object-cover opacity-10" />
        </div>
    @endif

    <div class="relative max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        @if($title)
            <h2
                class="text-3xl md:text-4xl font-bold mb-8 text-center"
                style="
                    font-family: {{ $headingFontFamily }};
                    color: {{ $headingColor }};
                "
            >
                {{ $title }}
            </h2>
        @endif

        @if($renderedBody)
            <div
                class="prose prose-lg max-w-none
                    prose-headings:font-bold
                    prose-a:no-underline hover:prose-a:underline
                    prose-img:rounded-lg prose-img:shadow-md
                    [&_.lead]:text-lg [&_.lead]:leading-relaxed
                    [&_.small]:text-sm [&_.small]:opacity-75
                    [&_mark]:bg-yellow-200 [&_mark]:px-1
                    [&_.grid]:grid [&_.grid]:gap-6 [&_.grid]:grid-cols-1
                    [&_.grid.grid-cols-2]:md:grid-cols-2
                    [&_.grid.grid-cols-3]:md:grid-cols-3
                    [&_.grid.grid-cols-4]:md:grid-cols-4"
                style="
                    color: {{ $textColor }};
                    --tw-prose-headings: {{ $headingColor }};
                    --tw-prose-links: {{ $primaryColor }};
                    --tw-prose-bullets: {{ $primaryColor }};
                    --tw-prose-counters: {{ $primaryColor }};
                    --tw-prose-quote-borders: {{ $primaryColor }};
                "
            >
                {!! $renderedBody !!}
            </div>
        @endif
    </div>
</section>
