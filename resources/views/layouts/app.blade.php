@props(['title'])
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title> {{ isset($title) ? $title . ' - ' : '' }}{{ config('app.name', '') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    @stack('styles') 
    {{-- <script src="https://www.google.com/recaptcha/api.js?render={{ config('services.recaptcha.site_key') }}"></script>  --}}

    <!-- Styles -->
    @livewireStyles

    @livewire('wire-elements-modal')

</head>

<body class="font-sans antialiased">
    <x-banner />

    @include('layouts.partials.header')

    @yield('hero')

    <main class="container flex flex-grow px-5 mx-auto">
        {{ $slot }}
    </main>

    @include('layouts.partials.footer')

    @stack('modals')
    @stack('scripts') 

    {{-- <script src="{{ asset('/js_custom/functions.js') }}"></script> --}}
    @livewireScripts
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <x-livewire-alert::scripts />

</body>

</html>
