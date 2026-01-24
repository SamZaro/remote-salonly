<x-layouts.app>
    <div class="min-h-screen bg-gray-50 py-12">
        <div class="mx-auto max-w-2xl px-4 sm:px-6 lg:px-8">
            <div class="rounded-xl bg-white p-6 shadow-sm ring-1 ring-gray-900/5 sm:p-8">
                {{-- Success icon --}}
                <div class="mx-auto flex h-16 w-16 items-center justify-center rounded-full bg-green-100">
                    <svg class="h-8 w-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                    </svg>
                </div>

                {{-- Title --}}
                <div class="mt-6 text-center">
                    <h1 class="text-2xl font-bold text-gray-900">{{ __('Reservering ontvangen!') }}</h1>
                    <p class="mt-2 text-gray-600">
                        {{ __('Bedankt voor uw reservering. U ontvangt binnenkort een bevestiging per e-mail.') }}
                    </p>
                </div>

                {{-- Booking details --}}
                <div class="mt-8 rounded-lg bg-gray-50 p-6">
                    <h2 class="text-lg font-semibold text-gray-900">{{ __('Reserveringsdetails') }}</h2>

                    <dl class="mt-4 space-y-4">
                        <div class="flex justify-between">
                            <dt class="text-sm text-gray-500">{{ __('Datum') }}</dt>
                            <dd class="text-sm font-medium text-gray-900">
                                {{ $booking->booking_date->translatedFormat('l j F Y') }}
                            </dd>
                        </div>

                        <div class="flex justify-between">
                            <dt class="text-sm text-gray-500">{{ __('Tijd') }}</dt>
                            <dd class="text-sm font-medium text-gray-900">
                                {{ \Carbon\Carbon::parse($booking->booking_time)->format('H:i') }}
                            </dd>
                        </div>

                        <div class="flex justify-between">
                            <dt class="text-sm text-gray-500">{{ __('Naam') }}</dt>
                            <dd class="text-sm font-medium text-gray-900">{{ $booking->customer_name }}</dd>
                        </div>

                        <div class="flex justify-between">
                            <dt class="text-sm text-gray-500">{{ __('E-mail') }}</dt>
                            <dd class="text-sm font-medium text-gray-900">{{ $booking->customer_email }}</dd>
                        </div>

                        <div class="flex justify-between">
                            <dt class="text-sm text-gray-500">{{ __('Telefoon') }}</dt>
                            <dd class="text-sm font-medium text-gray-900">{{ $booking->customer_phone }}</dd>
                        </div>

                        @if($booking->notes)
                            <div class="border-t border-gray-200 pt-4">
                                <dt class="text-sm text-gray-500">{{ __('Opmerkingen') }}</dt>
                                <dd class="mt-1 text-sm text-gray-900">{{ $booking->notes }}</dd>
                            </div>
                        @endif

                        <div class="flex justify-between border-t border-gray-200 pt-4">
                            <dt class="text-sm text-gray-500">{{ __('Status') }}</dt>
                            <dd>
                                <span @class([
                                    'inline-flex items-center rounded-full px-2.5 py-0.5 text-xs font-medium',
                                    'bg-yellow-100 text-yellow-800' => $booking->status->value === 'pending',
                                    'bg-green-100 text-green-800' => $booking->status->value === 'confirmed',
                                    'bg-red-100 text-red-800' => $booking->status->value === 'cancelled',
                                ])>
                                    {{ $booking->status->label() }}
                                </span>
                            </dd>
                        </div>
                    </dl>
                </div>

                {{-- Info box --}}
                <div class="mt-6 rounded-lg bg-blue-50 p-4">
                    <div class="flex">
                        <svg class="h-5 w-5 text-blue-400" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd" />
                        </svg>
                        <p class="ml-3 text-sm text-blue-700">
                            {{ __('Uw reservering is in behandeling. U ontvangt een bevestiging zodra deze is goedgekeurd.') }}
                        </p>
                    </div>
                </div>

                {{-- Back to home --}}
                <div class="mt-8 text-center">
                    <a
                        href="{{ route('home') }}"
                        class="inline-flex items-center text-sm font-medium text-primary-600 hover:text-primary-700"
                    >
                        <svg class="mr-2 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                        </svg>
                        {{ __('Terug naar de homepagina') }}
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-layouts.app>
