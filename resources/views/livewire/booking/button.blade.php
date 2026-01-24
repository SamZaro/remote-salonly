<div>
    @if($this->isEnabled)
        @if($style === 'button')
            <a
                href="{{ $this->bookingUrl }}"
                {{ $attributes ?? '' }}
                @class([
                    'inline-flex items-center justify-center rounded-md bg-primary-600 px-4 py-2 text-sm font-medium text-white shadow-sm transition-colors hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:ring-offset-2',
                    $class,
                ])
            >
                <svg class="mr-2 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                </svg>
                {{ $label }}
            </a>
        @elseif($style === 'link')
            <a
                href="{{ $this->bookingUrl }}"
                @class([
                    'text-primary-600 hover:text-primary-700 hover:underline',
                    $class,
                ])
            >
                {{ $label }}
            </a>
        @elseif($style === 'navbar')
            <a
                href="{{ $this->bookingUrl }}"
                @class([
                    'inline-flex items-center rounded-md bg-primary-600 px-3 py-1.5 text-sm font-medium text-white transition-colors hover:bg-primary-700',
                    $class,
                ])
            >
                {{ $label }}
            </a>
        @endif
    @endif
</div>
