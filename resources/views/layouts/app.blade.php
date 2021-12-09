<!DOCTYPE html>
<html lang="{{ App::getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>
        {{ isset($title) ? $title.' | ' : '' }}
        {{ config('app.name') }}
    </title>

    <meta name="description" content="{{env("APP_DESCRIPTION")}}" />
    <link rel="canonical" href="{{ $canonical ?? Request::url() }}" />
    <!-- Scripts -->
    <script src="{{ asset('js/splide.min.js') }}"></script>
    <link href="{{ asset('css/splide-default.min.css') }}" rel="stylesheet">

    <script src="{{ mix('js/app.js') }}" defer></script>

    <!-- Styles -->
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">

    @stack('meta')

    <script>
        window.Laravel = {!! json_encode(['csrfToken' => csrf_token()]) !!};
    </script>

    @livewireStyles
</head>

<body class="{{ $bodyClass ?? '' }} {{ isset($isTailwindUi) && $isTailwindUi ? '' : 'standard' }} font-sans bg-gray-900 antialiased" x-data="{ activeModal: false }" @keyup.escape="activeModal = false">

@yield('body')

@stack('modals')

@livewireScripts


<script>
    new Splide( '#image-slider', {
        // transition
        autoplay: 1,
        rewind: 1,
        type        : 'fade',
        interval: 60000,
        speed: 1000,
        // size
        width : '100vw',
        height: '100vh',
        //fixedHeight: 1080,
        // minimal layout
        arrows: 0,
        pagination: 0,
        focus: "center",
        //cover      : true,
    } ).mount();
</script></body>
</html>
