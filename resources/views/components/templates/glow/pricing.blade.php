{{--
    Glow Template: Pricing Section
    Warm minimalist — clean menu-style price lists without gradient headers
    Props: $content, $theme
--}}
@props([
    'content' => [],
    'theme' => [],
])

@php
    $title = $content['title'] ?? 'Prijslijst';
    $subtitle = $content['subtitle'] ?? 'Onze behandelingen en tarieven';
    $categories = $content['categories'] ?? [
        [
            'name' => 'Haar',
            'icon' => 'hair',
            'items' => [
                ['service' => 'Knippen & Föhnen', 'description' => 'Inclusief wasbeurt en styling', 'price' => '€55'],
                ['service' => 'Knippen & Stylen Deluxe', 'description' => 'Met behandeling en finishing', 'price' => '€75'],
                ['service' => 'Kleuren Uitgroei', 'description' => 'Bijwerken van de aanzet', 'price' => '€65'],
                ['service' => 'Full Colour', 'description' => 'Volledige haarkleuring', 'price' => '€85'],
                ['service' => 'Balayage / Highlights', 'description' => 'Hand-painted highlights', 'price' => 'Vanaf €120', 'popular' => true],
                ['service' => 'Keratine Behandeling', 'description' => 'Glad, glanzend haar', 'price' => 'Vanaf €150'],
            ],
        ],
        [
            'name' => 'Nagels',
            'icon' => 'nails',
            'items' => [
                ['service' => 'Manicure Classic', 'description' => 'Verzorging en lakken', 'price' => '€35'],
                ['service' => 'Manicure Deluxe', 'description' => 'Met scrub en masker', 'price' => '€50'],
                ['service' => 'Gel Nagels', 'description' => 'Nieuw set of bijwerken', 'price' => 'Vanaf €55'],
                ['service' => 'Nail Art', 'description' => 'Creatieve designs', 'price' => 'Vanaf €15'],
                ['service' => 'Pedicure Spa', 'description' => 'Complete voetverzorging', 'price' => '€55'],
            ],
        ],
        [
            'name' => 'Lash & Brow',
            'icon' => 'lash',
            'items' => [
                ['service' => 'Brow Design', 'description' => 'Wax, epileren & shapen', 'price' => '€25'],
                ['service' => 'Brow Lamination', 'description' => 'Volle, gedefinieerde wenkbrauwen', 'price' => '€45', 'popular' => true],
                ['service' => 'Lash Lift', 'description' => 'Natuurlijke wimper-lift', 'price' => '€55'],
                ['service' => 'Wimperextensions Classic', 'description' => 'Natuurlijke look', 'price' => '€85'],
                ['service' => 'Wimperextensions Volume', 'description' => 'Volle, dramatische look', 'price' => '€110'],
            ],
        ],
    ];

    $primaryColor = $theme['primary_color'] ?? '#E8D8D3';
    $secondaryColor = $theme['secondary_color'] ?? '#6E5F5B';
    $accentColor = $theme['accent_color'] ?? '#F2E7E4';
    $textColor = $theme['text_color'] ?? '#8A7B76';
    $headingColor = $theme['heading_color'] ?? '#6E5F5B';
    $backgroundColor = $theme['background_color'] ?? '#FBF9F8';
@endphp

<section id="pricing" class="py-20 lg:py-28" style="background-color: {{ $backgroundColor }};">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        {{-- Section header --}}
        <div
            class="text-center mb-14"
            x-data x-intersect.once="$el.style.opacity = 1; $el.style.transform = 'translateY(0)'"
            style="opacity: 0; transform: translateY(20px); transition: all 0.8s ease-out;"
        >
            <span class="text-xs font-semibold uppercase tracking-[0.2em] mb-4 block" style="color: {{ $secondaryColor }};">
                Prijzen
            </span>
            <h2 class="text-4xl sm:text-5xl font-bold mb-5" style="color: {{ $headingColor }}; font-family: 'Raleway', sans-serif;">
                {{ $title }}
            </h2>
            <p class="text-lg max-w-2xl mx-auto" style="color: {{ $textColor }};">
                {{ $subtitle }}
            </p>
        </div>

        {{-- Pricing categories --}}
        <div class="grid gap-8 lg:grid-cols-3">
            @foreach($categories as $index => $category)
                <div
                    class="p-8"
                    style="background-color: white; border-radius: 12px;"
                    x-data x-intersect.once="$el.style.opacity = 1; $el.style.transform = 'translateY(0)'"
                    x-bind:style="'opacity: 0; transform: translateY(16px); transition: all 0.6s ease-out {{ $index * 0.1 }}s;'"
                >
                    {{-- Category header --}}
                    <h3
                        class="text-2xl font-bold mb-6 pb-4"
                        style="color: {{ $headingColor }}; font-family: 'Raleway', sans-serif; border-bottom: 2px solid {{ $primaryColor }};"
                    >
                        {{ $category['name'] }}
                    </h3>

                    {{-- Price items --}}
                    <div class="space-y-4">
                        @foreach($category['items'] as $item)
                            <div class="flex items-start justify-between gap-4">
                                <div class="flex-1 min-w-0">
                                    <div class="flex items-center gap-2">
                                        <h4 class="font-medium" style="color: {{ $headingColor }};">
                                            {{ $item['service'] }}
                                        </h4>
                                        @if($item['popular'] ?? false)
                                            <span
                                                class="text-[10px] font-bold uppercase tracking-wider px-2 py-0.5"
                                                style="background-color: {{ $primaryColor }}; color: {{ $secondaryColor }}; border-radius: 3px;"
                                            >
                                                Populair
                                            </span>
                                        @endif
                                    </div>
                                    <p class="text-sm mt-0.5" style="color: {{ $textColor }};">
                                        {{ $item['description'] }}
                                    </p>
                                </div>
                                <span class="font-bold shrink-0" style="color: {{ $secondaryColor }};">
                                    {{ $item['price'] }}
                                </span>
                            </div>
                        @endforeach
                    </div>

                    {{-- Book button --}}
                    <a
                        href="#contact"
                        class="mt-8 w-full inline-flex items-center justify-center py-3 text-sm font-semibold tracking-wide uppercase transition-opacity hover:opacity-80"
                        style="background-color: {{ $accentColor }}; color: {{ $secondaryColor }}; border-radius: 6px;"
                    >
                        Afspraak maken
                    </a>
                </div>
            @endforeach
        </div>

        {{-- Footer note --}}
        <p class="mt-10 text-center text-sm" style="color: {{ $textColor }};">
            Alle prijzen zijn inclusief BTW. Lang haar vanaf +€10.
        </p>
    </div>
</section>
