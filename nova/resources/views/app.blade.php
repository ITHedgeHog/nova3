<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, viewport-fit=cover, user-scalable=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Nova NextGen') }}</title>

    <link rel="manifest" href="{{ asset('site.webmanifest') }}">
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">

    @livewireStyles
    @bukStyles
    @novaStyles
    @stack('styles')
</head>
<body class="font-sans bg-gray-100 text-gray-900 antialiased">
    <div id="app" style="-webkit-tap-highlight-color: transparent">
        @yield('layout')

        <x-toasts />
        @stack('modal')
    </div>

    @livewireScripts
    @bukScripts
    @novaScripts
    @stack('scripts')
</body>
</html>
