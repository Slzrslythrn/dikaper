<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    {{-- <title>{{ config('app.name', 'Dikaper') }}</title> --}}
    <title>Dikaper Kota Bogor</title>


    @stack('before-styles')
    {{--
    <link rel="icon" type="image/png" sizes="16x16" href="images/favicon.png"> --}}
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<link href="{{ asset('assets/vendor/jqvmap/css/jqvmap.min.css') }}" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('assets/vendor/chartist/css/chartist.min.css') }}">
{{--
<link href="{{ asset('assets/vendor/bootstrap-select/dist/css/bootstrap-select.min.css') }}" rel="stylesheet"> --}}
<link href="{{ asset('assets/css/style.css') }}" rel="stylesheet">
@stack('after-styles')

</head>

<body>
    @include('sweetalert::alert')
    <x-loader />

    <div id="main-wrapper">
        {{-- menu detail --}}

        <x-header />
        <x-sidebar />

        {{-- menu icon --}}

        <x-header-start />
        <x-sidebar-start />

        <div class="content-body">
            <!-- row -->
            {{ $slot }}
        </div>

        <x-footer />

        @stack('before-scripts')
        <!-- Required vendors -->
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
        <script src="{{ asset('assets/vendor/global/global.min.js') }}"></script>
        {{-- <script src="{{ asset('assets/vendor/bootstrap-select/dist/js/bootstrap-select.min.js') }}"></script> --}}
        <script src="{{ asset('assets/vendor/chart.js/Chart.bundle.min.js') }}"></script>
        <script src="{{ asset('assets/js/custom.min.js') }}"></script>
        <script src="{{ asset('assets/js/deznav-init.js') }}"></script>
        <!-- Apex Chart -->
        <script src="{{ asset('assets/vendor/apexchart/apexchart.js') }}"></script>

        <!-- Vectormap -->
        <!-- Chart piety plugin files -->
        <script src="{{ asset('assets/vendor/peity/jquery.peity.min.js') }}"></script>

        <!-- Chartist -->
        <script src="{{ asset('assets/vendor/chartist/js/chartist.min.js') }}"></script>

        <!-- Dashboard 1 -->
        <script src="{{ asset('assets/js/dashboard/dashboard-1.js') }}"></script>

        <!-- Svganimation scripts -->
        <script src="{{ asset('assets/vendor/svganimation/vivus.min.js') }}"></script>
        <script src="{{ asset('assets/vendor/svganimation/svg.animation.js') }}"></script>
        @stack('after-scripts')


</body>

</html>