@props(['backButton' => true])

<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @include('components.layouts.partials.head')
</head>
<body {{ $attributes->merge(['class' => 'text-primary-900 w-full']) }} >
    <div id="app">

        <div class="flex justify-between">
            <a href="{{ url('/')}}">
                <img src="{{ url('/images/logos/webvue_logo.png')}}" class="inline-block h-10 m-10" alt="Logo" />
            </a>

            @if($backButton)
                <div class="self-end text-primary-300 m-4 text-xs">
                    <x-link href="{{ url('/')}}" class="flex items-center text-primary-200">{{__('<< back')}}</x-link>
                </div>
            @endif
        </div>

        <div>
            {{$slot}}
        </div>

        @include('components.layouts.partials.tail', ['skipCookieContentBar' => true])
    </div>
</body>
</html>
