<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <meta name="description" content="Sistem pemesanan mobil travel online.">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="base-url" content="{{ url('/') }}">

        {{-- Favicon --}}
        @isset(perusahaan()->logo)
            <link rel="shortcut icon" href="{{ storage(perusahaan()->logo) }}" type="image/x-icon" />
        @endisset

        {{-- CSS --}}
        <link rel="stylesheet" href="{{ main_asset('css/libs.bundle.css') }}" />
        <link rel="stylesheet" href="{{ main_asset('css/index.bundle.css') }}" />

        {{-- Title --}}
        <title>{{ $title }} - {{ config('app.name') }}</title>

        {{-- Vite --}}
        @vite(['resources/scss/app.scss', 'resources/js/app.js'])

        {{-- Page style --}}
        @isset($style)
            {{ $style }}
        @endisset
    </head>

    <body id="mainLayout" class="{{ $bgColor }}">
        <x-main.navbar bg-color="{{ $headerBgColor }}"></x-main.navbar>
        <x-main.sidebar></x-main.sidebar>

        {{-- Main content --}}
        {{ $slot }}

        {{-- Footer --}}
        <x-main.footer bg-color="{{ $footerBgColor }}"></x-main.footer>

        {{-- form logout --}}
        <form action="{{ route('logout') }}" method="post" id="formLogout" class="d-none">
            @method('delete') @csrf
        </form>

        {{-- javascript --}}
        <script src="{{ main_asset('js/vendor.bundle.js') }}"></script>
        <script src="{{ main_asset('js/index.bundle.js') }}"></script>
        <script src="{{ main_asset('vendor/jquery/jquery.min.js') }}"></script>

        {{-- Logout --}}
        <script>
            function handleLogout(e) {
                e.preventDefault();
                document.querySelector('#formLogout').submit();
            }
        </script>

        {{-- Page script --}}
        @isset($script)
            {{ $script }}
        @endisset
    </body>

</html>
