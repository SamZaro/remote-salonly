@include('auth.partials.auth-page-styles')

<x-layouts.auth-minimal>
    <div class="lp-bg">

        <a href="{{ route('login') }}" class="lp-back">← {{ __('Back to login') }}</a>

        <div class="lp-card">

            <div class="lp-header">
                <a href="{{ url('/') }}" class="flex justify-center">
                    <img src="{{ url('/images/logos/salon-blaze-black.png') }}" alt="{{ config('app.name') }}" class="h-20">
                </a>
                <p class="lp-sub">{{ __('Choose a new password') }}</p>
            </div>

            <div class="lp-body">

                <form method="POST" action="{{ route('password.update') }}">
                    @csrf
                    <input type="hidden" name="token" value="{{ $token }}">

                    <x-input.field label="{{ __('Email Address') }}" type="email" name="email"
                                   value="{{ $email ?? old('email') }}" required autofocus="true"
                                   autocomplete="email" max-width="w-full"/>
                    @error('email')
                        <span class="text-xs text-red-500 block mt-1" role="alert">{{ $message }}</span>
                    @enderror

                    <x-input.field label="{{ __('New Password') }}" type="password" name="password"
                                   required max-width="w-full"/>
                    @error('password')
                        <span class="text-xs text-red-500 block mt-1" role="alert">{{ $message }}</span>
                    @enderror

                    <x-input.field label="{{ __('Confirm Password') }}" type="password"
                                   name="password_confirmation" required max-width="w-full"/>

                    <div class="mt-6">
                        <x-button-link.primary class="inline-block w-full! my-2" elementType="button" type="submit">
                            {{ __('Reset Password') }}
                        </x-button-link.primary>
                    </div>

                </form>

            </div>
        </div>

        <p class="lp-footer">© {{ date('Y') }} SalonBlaze</p>

    </div>
</x-layouts.auth-minimal>
