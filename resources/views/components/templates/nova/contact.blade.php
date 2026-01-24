@props([
    'content' => [],
    'theme' => [],
    'template' => null,
    'section' => null,
])

@php
    // Content met defaults
    $title = $content['title'] ?? 'Contact';
    $address = $content['address'] ?? 'Oostermeent West 15, 7274 SP Huizen';
    $phone = $content['phone'] ?? '035-5447595';
    $image = $section?->getFirstMediaUrl('background') ?: ($content['image'] ?? null);

    // Openingstijden - flexibele structuur
    $rawHours = $content['opening_hours'] ?? [];
    $openingHours = collect($rawHours)->map(function ($entry) {
        return [
            'day' => $entry['day'] ?? $entry['label'] ?? '',
            'hours' => $entry['hours'] ?? $entry['time'] ?? $entry['value'] ?? '',
        ];
    })->toArray();

    if (empty($openingHours)) {
        $openingHours = [
            ['day' => 'Maandag', 'hours' => '09:00 - 18:00'],
            ['day' => 'Dinsdag', 'hours' => '09:00 - 18:00'],
            ['day' => 'Woensdag', 'hours' => '09:00 - 18:00'],
            ['day' => 'Donderdag', 'hours' => '09:00 - 18:00'],
            ['day' => 'Vrijdag', 'hours' => '09:00 - 21:00'],
            ['day' => 'Zaterdag', 'hours' => '09:00 - 18:00'],
            ['day' => 'Zondag', 'hours' => 'Gesloten'],
        ];
    }

    // Theme kleuren
    $primaryColor = $theme['primary_color'] ?? '#14B8A6';
    $backgroundColor = $theme['background_color'] ?? '#FFFFFF';
    $textColor = $theme['text_color'] ?? '#57534E';
    $headingColor = $theme['heading_color'] ?? '#44403C';

    // Logo configuratie op basis van theme_config
    $logoType = $theme['logo']['type'] ?? 'text';
    $logoText = $theme['logo']['text'] ?? $template?->name ?? config('app.name');
    $logoImage = ($logoType === 'image') ? $template?->logo_url : null;
@endphp

<section id="contact" class="py-16 lg:py-24" style="background-color: {{ $backgroundColor }};">
    <div class="max-w-7xl mx-auto px-4 sm:px-6">

        {{-- Header --}}
        <div class="text-center mb-12">
            <div class="flex items-center justify-center gap-4 mb-6">
                <div class="w-16 h-px" style="background-color: {{ $primaryColor }};"></div>
                <svg class="w-6 h-6" style="color: {{ $primaryColor }};" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="m7.848 8.25 1.536.887M7.848 8.25a3 3 0 1 1-5.196-3 3 3 0 0 1 5.196 3Zm1.536.887a2.165 2.165 0 0 1 1.083 1.839c.005.351.054.695.14 1.024M9.384 9.137l2.077 1.199M7.848 15.75l1.536-.887m-1.536.887a3 3 0 1 1-5.196 3 3 3 0 0 1 5.196-3Zm1.536-.887a2.165 2.165 0 0 0 1.083-1.838c.005-.352.054-.695.14-1.025m-1.223 2.863 2.077-1.199m0-3.328a4.323 4.323 0 0 1 2.068-1.379l5.325-1.628a4.5 4.5 0 0 1 2.48-.044l.803.215-7.794 4.5m-2.882-1.664A4.33 4.33 0 0 0 10.607 12m3.736 0 7.794 4.5-.802.215a4.5 4.5 0 0 1-2.48-.043l-5.326-1.629a4.324 4.324 0 0 1-2.068-1.379M14.343 12l-2.882 1.664"/>
                </svg>
                <div class="w-16 h-px" style="background-color: {{ $primaryColor }};"></div>
            </div>
            <h2
                class="text-3xl sm:text-4xl font-extrabold mb-4"
                style="color: {{ $headingColor }};"
                x-intersect="$el.classList.add('fadeInUp')"
            >
                {{ $title }}
            </h2>
        </div>

        {{-- Content grid --}}
        <div class="grid md:grid-cols-3 gap-6" x-intersect="$el.classList.add('fadeInUp')">

            {{-- Adres & Contact --}}
            <div class="rounded p-8" style="background-color: {{ $primaryColor }};">
                <h3 class="text-2xl font-medium text-white mb-4">Adres & Contact</h3>
                <div class="text-white text-lg space-y-1">
                    @foreach(explode(',', $address) as $line)
                        <p>{{ trim($line) }}</p>
                    @endforeach
                    <p class="font-semibold pt-2">{{ $phone }}</p>
                </div>
            </div>

            {{-- Afbeelding --}}
            <div class="rounded overflow-hidden bg-gray-100">
                @if($image)
                    <img
                        src="{{ $image }}"
                        alt="{{ $title }}"
                        class="w-full h-full object-cover"
                    >
                @else
                    <div class="w-full h-full min-h-[250px] flex items-center justify-center" style="background-color: {{ $textColor }}20;">
                        <svg class="w-12 h-12 opacity-30" style="color: {{ $textColor }};" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                    </div>
                @endif
            </div>

            {{-- Openingstijden --}}
            <div class="rounded p-8" style="background-color: {{ $primaryColor }};">
                <h3 class="text-2xl font-medium text-white mb-4">Openingstijden</h3>
                <div class="space-y-1">
                    @foreach($openingHours as $entry)
                        <p class="text-white text-lg">
                            {{ $entry['day'] }}: {{ $entry['hours'] }}
                        </p>
                    @endforeach
                </div>
            </div>

        </div>
    </div>
</section>

<footer class="w-full py-14 bg-stone-900">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="max-w-3xl mx-auto">
            <!-- Logo -->
            <a href="{{ url('home') }}" class="flex justify-center">
                 @if($logoType === 'image' && $logoImage)
                        <img src="{{ $logoImage }}" alt="{{ $logoText }}" class="h-14 sm:h-14">
                    @else
                    @endif
            </a>

            <ul class="text-lg flex items-center justify-center flex-col gap-7 md:flex-row md:gap-12 transition-all duration-500 py-16 mb-10 border-b border-gray-200">
                <li><a href="{{ url('#home') }}" class="text-white hover:text-stone-300 underline">Home</a></li>
                <li><a href="{{ url('#about') }}" class=" text-white hover:text-stone-300 underline">Over ons</a></li>
                <li><a href="{{ url('#gallery') }}" class=" text-white hover:text-stone-300 underline">Gallerij</a></li>
                <li><a href="{{ url('#pricing') }}" class=" text-white hover:text-stone-300 underline">Prijslijst</a></li>
                <li><a href="{{ url('#contact') }}" class=" text-white hover:text-stone-300 underline">Contact</a></li>
            </ul>
            <div class="flex space-x-10 justify-center items-center mb-14">
                <a href="https://www.instagram.com/kapsalon_oasis_huizen/" class="block  text-white transition-all duration-500 hover:text-indigo-600 ">
                    <svg class="w-[1.688rem] h-[1.688rem] " viewBox="0 0 29 29" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M9.76556 14.8811C9.76556 12.3243 11.8389 10.2511 14.3972 10.2511C16.9555 10.2511 19.03 12.3243 19.03 14.8811C19.03 17.4379 16.9555 19.5111 14.3972 19.5111C11.8389 19.5111 9.76556 17.4379 9.76556 14.8811ZM7.26117 14.8811C7.26117 18.82 10.456 22.0129 14.3972 22.0129C18.3385 22.0129 21.5333 18.82 21.5333 14.8811C21.5333 10.9422 18.3385 7.7493 14.3972 7.7493C10.456 7.7493 7.26117 10.9422 7.26117 14.8811ZM20.1481 7.46652C20.148 7.79616 20.2457 8.11843 20.4288 8.39258C20.6119 8.66674 20.8723 8.88046 21.177 9.00673C21.4817 9.133 21.8169 9.16614 22.1405 9.10196C22.464 9.03778 22.7612 8.87916 22.9945 8.64617C23.2278 8.41318 23.3868 8.11627 23.4513 7.79299C23.5157 7.46972 23.4829 7.13459 23.3568 6.83C23.2307 6.5254 23.017 6.26502 22.7428 6.08178C22.4687 5.89853 22.1463 5.80065 21.8164 5.80052H21.8158C21.3737 5.80073 20.9497 5.9763 20.637 6.28867C20.3243 6.60104 20.1485 7.02467 20.1481 7.46652ZM8.78274 26.1863C7.42782 26.1246 6.69138 25.8991 6.20197 25.7085C5.55314 25.4561 5.0902 25.1554 4.60346 24.6696C4.11672 24.1839 3.81543 23.7216 3.56395 23.0732C3.37317 22.5843 3.14748 21.8481 3.08588 20.494C3.01851 19.03 3.00506 18.5902 3.00506 14.8812C3.00506 11.1722 3.01962 10.7336 3.08588 9.26841C3.14759 7.9143 3.37495 7.17952 3.56395 6.68919C3.81654 6.04074 4.11739 5.57808 4.60346 5.09163C5.08953 4.60519 5.55203 4.30408 6.20197 4.05274C6.69116 3.86208 7.42782 3.63652 8.78274 3.57497C10.2476 3.50763 10.6877 3.49419 14.3972 3.49419C18.1068 3.49419 18.5473 3.50874 20.0134 3.57497C21.3683 3.63663 22.1035 3.86385 22.5941 4.05274C23.243 4.30408 23.7059 4.60585 24.1926 5.09163C24.6794 5.57741 24.9796 6.04074 25.2322 6.68919C25.4229 7.17808 25.6486 7.9143 25.7102 9.26841C25.7776 10.7336 25.7911 11.1722 25.7911 14.8812C25.7911 18.5902 25.7776 19.0287 25.7102 20.494C25.6485 21.8481 25.4217 22.5841 25.2322 23.0732C24.9796 23.7216 24.6787 24.1843 24.1926 24.6696C23.7066 25.155 23.243 25.4561 22.5941 25.7085C22.105 25.8992 21.3683 26.1247 20.0134 26.1863C18.5485 26.2536 18.1084 26.2671 14.3972 26.2671C10.686 26.2671 10.2472 26.2536 8.78274 26.1863ZM8.66768 1.0763C7.18823 1.14363 6.17729 1.37808 5.29443 1.72141C4.3801 2.07597 3.60608 2.55163 2.83262 3.32341C2.05916 4.09519 1.58443 4.86997 1.22966 5.78374C0.88612 6.66663 0.651535 7.67641 0.584162 9.15497C0.515676 10.6359 0.5 11.1093 0.5 14.8811C0.5 18.6529 0.515676 19.1263 0.584162 20.6072C0.651535 22.0859 0.88612 23.0955 1.22966 23.9784C1.58443 24.8916 2.05927 25.6673 2.83262 26.4387C3.60597 27.2102 4.3801 27.6852 5.29443 28.0407C6.17896 28.3841 7.18823 28.6185 8.66768 28.6859C10.1502 28.7532 10.6232 28.77 14.3972 28.77C18.1713 28.77 18.645 28.7543 20.1268 28.6859C21.6063 28.6185 22.6166 28.3841 23.5 28.0407C24.4138 27.6852 25.1884 27.2105 25.9618 26.4387C26.7353 25.667 27.209 24.8916 27.5648 23.9784C27.9083 23.0955 28.144 22.0857 28.2103 20.6072C28.2777 19.1252 28.2933 18.6529 28.2933 14.8811C28.2933 11.1093 28.2777 10.6359 28.2103 9.15497C28.1429 7.6763 27.9083 6.66608 27.5648 5.78374C27.209 4.87052 26.7341 4.09641 25.9618 3.32341C25.1896 2.55041 24.4138 2.07597 23.5011 1.72141C22.6166 1.37808 21.6062 1.14252 20.1279 1.0763C18.6461 1.00897 18.1724 0.992188 14.3983 0.992188C10.6243 0.992188 10.1502 1.00785 8.66768 1.0763Z" fill="currentColor"/>
                    </svg>
                </a>
                <a href="https://www.facebook.com/OasisHuizen/?locale=nl_NL" class="block  text-white transition-all duration-500 hover:text-indigo-600 ">
                    <svg class="w-[0.938rem] h-[1.625rem]" viewBox="0 0 15 26" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M13.7926 14.4697L14.5174 9.86889H10.0528V6.87836C10.0528 5.62033 10.6761 4.39105 12.6692 4.39105H14.7275V0.473179C13.5289 0.282204 12.3177 0.178886 11.1037 0.164062C7.42917 0.164062 5.0302 2.37101 5.0302 6.36077V9.86889H0.957031V14.4697H5.0302V25.5979H10.0528V14.4697H13.7926Z" fill="currentColor"/>
                    </svg>
                </a>
            </div>
            <span class="text-lg text-gray-500 text-center block">©<a href="https://webvue.nl/">WEBVUE</a> 2025</span>
        </div>
    </div>
</footer>
