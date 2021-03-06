<!doctype html>

<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ $title() }}</title>
        <meta name="description" content="{{ $description() }}">

        {{ $meta ?? '' }}

        {{-- Styles --}}
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
        @stack('styles')

        {{-- Scripts --}}
        <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.8.2/dist/alpine.min.js" defer></script>
        @stack('head-scripts')
    </head>

    <body {{ $attributes }}>
        {{ $slot }}

        @stack('scripts')
    </body>
</html>
