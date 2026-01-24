@if($this->isEnabled)
    <section
        class="py-12 px-4 sm:py-16 sm:px-8"
        @if($backgroundColor)
            style="background-color: {{ $backgroundColor }}; @if($textColor) color: {{ $textColor }}; @endif"
        @elseif($textColor)
            style="color: {{ $textColor }};"
        @endif
    >
        <div class="mx-auto max-w-2xl flex flex-col {{ $this->alignmentClasses }}">
            @if($showIcon)
                {{-- Calendar Icon --}}
                <div @class([
                    'mb-6 flex h-14 w-14 items-center justify-center rounded-full',
                    'bg-primary-100' => !$backgroundColor,
                    'bg-white/20' => $backgroundColor,
                ])>
                    <svg class="h-7 w-7 {{ $backgroundColor ? 'text-current' : 'text-primary-600' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5m-9-6h.008v.008H12v-.008zM12 15h.008v.008H12V15zm0 2.25h.008v.008H12v-.008zM9.75 15h.008v.008H9.75V15zm0 2.25h.008v.008H9.75v-.008zM7.5 15h.008v.008H7.5V15zm0 2.25h.008v.008H7.5v-.008zm6.75-4.5h.008v.008h-.008v-.008zm0 2.25h.008v.008h-.008V15zm0 2.25h.008v.008h-.008v-.008zm2.25-4.5h.008v.008H16.5v-.008zm0 2.25h.008v.008H16.5V15z" />
                    </svg>
                </div>
            @endif

            {{-- Title --}}
            <h2 @class([
                'text-2xl font-bold tracking-tight sm:text-3xl',
                'text-gray-900' => !$textColor && !$backgroundColor,
            ])>
                {{ $title }}
            </h2>

            {{-- Description --}}
            <p @class([
                'mt-4 text-lg max-w-xl',
                'text-gray-600' => !$textColor && !$backgroundColor,
                'opacity-90' => $backgroundColor,
            ])>
                {{ $description }}
            </p>

            {{-- CTA Button --}}
            <div class="mt-8">
                <a href="{{ $this->bookingUrl }}" class="{{ $this->buttonClasses }}">
                    <svg class="mr-2 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5" />
                    </svg>
                    {{ $buttonText }}
                </a>
            </div>
        </div>
    </section>
@endif
