<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @include('components.layouts.partials.head')
</head>
<body style="margin:0;padding:0;overflow-x:hidden;">
<div id="app">
    {{ $slot }}
</div>
@include('components.layouts.partials.tail', ['skipCookieContentBar' => true])
</body>
</html>
