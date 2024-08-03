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
        @isset(perusahaan()->logo)
            <link rel="shortcut icon" href="{{ image(perusahaan()->logo) }}">
        @endisset

        {{-- Google font --}}
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&amp;display=swap">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

        {{-- CSS --}}
        <link rel="stylesheet" href="{{ dashboard_asset('css/vendor.min.css') }}">
        <link rel="stylesheet" href="{{ dashboard_asset('css/theme.minc619.css?v=1.0') }}">
        <link rel="preload" href="{{ dashboard_asset('css/theme.min.css') }}" data-hs-appearance="default" as="style">
        <link rel="preload" href="{{ dashboard_asset('css/theme-dark.min.css') }}" data-hs-appearance="dark" as="style">
        <link rel="stylesheet" href="{{ dashboard_asset('vendor/datatables/datatables.min.css') }}">

        {{-- Theme style --}}
        <style data-hs-appearance-onload-styles>
            * {
                transition: unset !important;
            }

            body {
                opacity: 0;
            }
        </style>

        {{-- Head script --}}
        <script src="{{ dashboard_asset('js/head.js') }}"></script>

        {{-- Vite --}}
        @vite(['resources/scss/app.scss', 'resources/js/app.js'])
        
        {{-- Page style --}}
        @isset($style) {{ $style }} @endisset
    </head>


    <body id="dashboardLayout" class="has-navbar-vertical-aside navbar-vertical-aside-show-xl navbar-vertical-aside-closed-mode splitted-content">
        <script src="{{ dashboard_asset('js/theme-appearance.js') }}"></script>

        {{-- Preloader --}}
        <x-preloader></x-preloader>
        
        {{-- Sidebar --}}
        <x-dashboard.sidebar></x-dashboard.sidebar>

        {{-- Main content --}}
        <main id="content" role="main" class="main splitted-content-main">
            <div class="splitted-content-fluid content-space">
                <div class="d-flex d-xl-none justify-content-end">
                    <button type="button"
                        class="js-navbar-vertical-aside-toggle-invoker navbar-aside-toggler position-static">
                        <i class="bi-arrow-bar-left navbar-toggler-short-align"></i>
                        <i class="bi-arrow-bar-right navbar-toggler-full-align"></i>
                    </button>
                </div>

                {{-- content --}}
                <div class="mt-xl-0 mt-sm-5 mt-2">
                    <div class="page-header">
                        <div class="row align-items-end">
                            <div class="col-sm mb-2 mb-sm-0">
                                <h1 class="page-header-title">{{ $title }}</h1>
                            </div>

                            @isset($headerAction)
                                <div class="col-sm-auto">
                                    {{ $headerAction }}
                                </div>
                            @endisset
                        </div>

                        @isset($headerContent)
                            <div class="mt-3">
                                {{ $headerContent }}
                            </div>
                        @endisset
                    </div>

                    {{-- Alert notifikasi --}}
                    @session('alert')
                        <x-alert class="mb-5" variant="{{ session('alert')['variant'] }}">
                            {{ session('alert')['message'] }}
                        </x-alert>
                    @endsession

                    {{-- Alert error --}}
                    @if ($errors->any())
                        <x-alert variant="danger" class="mb-5">
                            <ul class="m-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </x-alert>
                    @endif

                    {{ $slot }}
                </div>
            </div>
        </main>

        {{-- Form logout --}}
        <form action="{{ route('logout') }}" method="post" id="formLogout">
            @method('delete') @csrf
        </form>

        {{-- JS Plugins --}}
        <script src="{{ dashboard_asset('js/vendor.min.js') }}"></script>
        <script src="{{ dashboard_asset('js/theme.min.js') }}"></script>
        <script src="{{ dashboard_asset('vendor/jquery/jquery.min.js') }}"></script>
        <script src="{{ dashboard_asset('vendor/bootbox/bootbox.all.min.js') }}"></script>
        <script src="{{ dashboard_asset('vendor/datatables/datatables.min.js') }}"></script>
        <script src="{{ dashboard_asset('js/app.js') }}"></script>

        {{-- Logout --}}
        <script>
            $('#logout').click(function(e) {
                e.preventDefault();
                $('#formLogout').submit();
            });
        </script>

        {{-- Page script --}}
        @isset($script) {{ $script }} @endisset
    </body>
</html>
