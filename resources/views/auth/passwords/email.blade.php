@include('auth.partials.auth-page-styles')

<x-layouts.auth-minimal>
    <div class="lp-bg">

        <a href="{{ route('login') }}" class="lp-back">← {{ __('Back to login') }}</a>

        <div class="lp-card">

            <div class="lp-header">
                <a href="{{ url('/') }}" class="flex justify-center">
                    <img src="{{ url('/images/logos/salon-blaze-black.png') }}" alt="{{ config('app.name') }}" class="h-20">
                </a>
                <p class="lp-sub">{{ __('Reset your password') }}</p>
            </div>

            <div class="lp-body">

                @if (session('status'))
                    <div class="mb-4 text-sm text-emerald-600 bg-emerald-50 border border-emerald-200 rounded-md px-4 py-3" style="font-family:'Outfit',sans-serif;">
                        {{ session('status') }}
                    </div>
                @endif

                <form method="POST" action="{{ route('password.email') }}">
                    @csrf

                    <x-input.field label="{{ __('Email Address') }}" type="email" name="email"
                                   value="{{ old('email') }}" required autofocus="true"
                                   autocomplete="email" max-width="w-full"/>

                    @error('email')
                        <span class="text-xs text-red-500 block mt-1" role="alert">{{ $message }}</span>
                    @enderror

                    @if (config('app.recaptcha_enabled'))
                        <div class="my-4">{!! htmlFormSnippet() !!}</div>
                        @error('g-recaptcha-response')
                            <span class="text-xs text-red-500 block mt-1" role="alert">{{ $message }}</span>
                        @enderror
                    @endif

                    <div class="mt-6">
                        <x-button-link.primary class="inline-block w-full! my-2" elementType="button" type="submit">
                            {{ __('Send Password Reset Link') }}
                        </x-button-link.primary>
                    </div>

                </form>

            </div>
        </div>

        <p class="lp-footer">© {{ date('Y') }} SalonBlaze</p>

    </div>

    @if (config('app.recaptcha_enabled'))
        @push('tail')
            {!! htmlScriptTagJsApi() !!}
        @endpush
    @endif
</x-layouts.auth-minimal>
