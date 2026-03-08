<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @include('components.layouts.partials.head')
</head>
<body class="text-orange-900">
    <div id="app">

        <div class="w-full">
            <div class="flex flex-col-reverse flex-wrap md:flex-nowrap md:flex-row">
                 <div class="md:basis-3/5 flex flex-col">
                     <div class="hidden md:block">
                         <a href="{{url('/')}}">
                            <img src="{{ url('/images/logos/salon-blaze-black.png')}}" class="h-14 m-14" alt="Logo" />
                         </a>
                     </div>

                     {{$left}}
                 </div>
                <div class="md:basis-2/5 md:min-h-screen md:bg-linear-to-r md:from-orange-400 md:to-orange-700 flex flex-col md:text-white text-orange-900 text-center md:text-left left-shadow">
                    <div class="flex justify-between md:justify-end">
                        <div class="md:hidden">
                            <a href="{{url('/')}}">
                                <img src="{{ url('/images/logos/webvue_logo.png')}}" class="inline-block h-10 m-10" alt="Logo" />
                            </a>
                        </div>

                        <div class="self-end text-orange-200 m-4 text-xs">
                            <x-link href="{{url('/')}}" class="flex items-center text-orange-100">{{__('< back home')}}</x-link>
                        </div>
                    </div>

                    {{$right}}
                </div>
            </div>
        </div>

        @include('components.layouts.partials.tail')
    </div>
</body>
</html>
