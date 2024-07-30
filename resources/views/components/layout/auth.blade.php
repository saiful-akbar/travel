<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="base-url" content="{{ url('/') }}">
        <meta name="description" content="Sistem pemesanan mobil travel online.">
        <meta name="author" content="saifulakbar.dev@gmail.com">

        {{-- Title --}}
        <title>{{ $title }} - {{ config('app.name') }} Dashboard</title>

        {{-- Icon --}}
        <link rel="shortcut icon" href="{{ asset('assets/favicon.ico') }}">

        {{-- Google font --}}
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&amp;display=swap">

        {{-- CSS --}}
        <link rel="stylesheet" href="{{ asset('assets/css/vendor.min.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/css/theme.minc619.css?v=1.0') }}">
        <link rel="preload" href="{{ asset('assets/css/theme.min.css') }}" data-hs-appearance="default" as="style">
        <link rel="preload" href="{{ asset('assets/css/theme-dark.min.css') }}" data-hs-appearance="dark" as="style">

        {{-- Tema style --}}
        <style data-hs-appearance-onload-styles>
            * {
                transition: unset !important;
            }

            body {
                opacity: 0;
            }
        </style>

        {{-- Head script --}}
        <script src="{{ asset('assets/js/head.js') }}"></script>

        {{-- Vite --}}
        @vite(['resources/scss/app.scss', 'resources/js/app.js'])
        
        {{-- Page style --}}
        @isset($style) {{ $style }} @endisset
    </head>

    <body id="authLayout">
        <script src="{{ asset('assets/js/theme-appearance.js') }}"></script>

        <x-preloader></x-preloader>

        {{-- Main content --}}
        <main id="content" role="main" class="main">
            <div class="position-fixed top-0 end-0 start-0 bg-img-start" style="height: 32rem; background-image: url({{ asset('assets/images/bg-login.svg') }});">
                <div class="shape shape-bottom zi-1">
                    <svg preserveAspectRatio="none" xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" viewBox="0 0 1921 273">
                        <polygon fill="#fff" points="0,273 1921,273 1921,0 " />
                    </svg>
                </div>
            </div>
        
            <div class="container py-5 py-sm-7">
                <a class="d-flex justify-content-center mb-5" href="{{ route('main.home') }}">
                    <img class="zi-2" src="{{ image(perusahaan()?->logo) }}" alt="Image Description" style="width: 8rem;">
                </a>
        
                <div class="mx-auto" style="max-width: 30rem;">
                    {{ $slot }}
                </div>
            </div>
        </main>

        {{-- Javascript --}}
        <script src="{{ asset('assets/js/vendor.min.js') }}"></script>
        <script src="{{ asset('assets/js/theme.min.js') }}"></script>
        <script src="{{ asset('assets/vendor/jquery/jquery.min.js') }}"></script>
        <script src="{{ asset('assets/vendor/bootbox/bootbox.all.min.js') }}"></script>
        <script src="{{ asset('assets/js/app.js') }}"></script>

        {{-- Page script --}}
        @isset($script) {{ $script }} @endisset
    </body>
</html>