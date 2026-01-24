@if($this->isEnabled)
    @if($style === 'navbar')
        {{-- Navbar style: CTA button with dynamic colors --}}
        <a
            href="{{ $this->bookingUrl }}"
            class="inline-flex items-center px-4 py-2 rounded font-medium transition-all duration-300 hover:opacity-90 hover:scale-105"
            style="background-color: {{ $backgroundColor ?? '#c9a227' }}; color: {{ $textColor ?? '#1a1a1a' }};"
        >
            {{ $label }}
        </a>
    @elseif($style === 'mobile')
        {{-- Mobile menu style: CTA button --}}
        <a
            href="{{ $this->bookingUrl }}"
            class="block mx-3 my-2 px-4 py-3 rounded text-center font-medium transition-all duration-300"
            style="background-color: {{ $backgroundColor ?? '#c9a227' }}; color: {{ $textColor ?? '#1a1a1a' }};"
        >
            {{ $label }}
        </a>
    @elseif($style === 'button')
        {{-- Standalone CTA button --}}
        <a
            href="{{ $this->bookingUrl }}"
            class="inline-flex items-center px-4 py-2 rounded-lg font-medium bg-primary-600 text-white shadow-sm transition-colors hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:ring-offset-2"
        >
            <svg class="mr-2 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
            </svg>
            {{ $label }}
        </a>
    @elseif($style === 'link')
        {{-- Simple text link --}}
        <a
            href="{{ $this->bookingUrl }}"
            class="text-primary-600 hover:text-primary-700 hover:underline"
        >
            {{ $label }}
        </a>
    @endif
@endif
