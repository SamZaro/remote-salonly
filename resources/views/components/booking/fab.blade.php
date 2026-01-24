@props(['label' => __('Reserveren')])

@bookingEnabled
    <a
        href="{{ url(config('booking-module.route_prefix', 'booking')) }}"
        {{ $attributes->merge([
            'class' => 'fixed bottom-6 right-6 z-50 flex items-center gap-2 rounded-full bg-primary-600 px-5 py-3 text-white shadow-lg transition-all duration-200 hover:bg-primary-700 hover:shadow-xl focus:outline-none focus:ring-2 focus:ring-primary-500 focus:ring-offset-2'
        ]) }}
    >
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
            <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd" />
        </svg>
        <span class="font-medium">{{ $label }}</span>
    </a>
@endbookingEnabled
