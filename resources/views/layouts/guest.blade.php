<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-100">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    {{-- <title>{{ config('app.name', 'Dikaper') }}</title> --}}
    <title>Dikaper Kota Bogor</title>


    <!-- Mobile Specific -->
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">
    @stack('before-styles')
    <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet">
    @stack('after-styles')

</head>

<body class="h-100">
    <div class="authincation h-100">
        {{ $slot }}
    </div>

    @stack('before-scripts')
    <!-- Required vendors -->
    <script src="{{ asset('assets/vendor/global/global.min.js') }}"></script>

    <script src="{{ asset('assets/js/custom.min.js') }}"></script>
    <script src="{{ asset('assets/js/deznav-init.js') }}"></script>
    @stack('after-scripts')

</body>

</html>