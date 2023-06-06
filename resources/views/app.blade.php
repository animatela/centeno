<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="En Automotriz Centeno atendemos Ford, Toyota, Kia, Mazda, Nissan, Mitsubishi, Chevrolet, Honda, Hyundai.">
        <meta name="keywords" content="Automotriz, Centeno, Ford, Toyota, Kia, Mazda, Nissan, Mitsubishi, Chevrolet, Honda, Hyundai">
        <meta name="author" content="Automotriz, Centeno">

        <title inertia>{{ config('app.name', 'Laravel') }}</title>

        <!-- Meta -->
        <meta property="og:title" content="Automotriz Centeno">
        <meta property="og:description" content="En Automotriz Centeno atendemos Ford, Toyota, Kia, Mazda, Nissan, Mitsubishi, Chevrolet, Honda, Hyundai.">
        <meta property="og:type" content="website">
        <meta property="og:url" content="{{ url()->current() }}">
        <meta property="og:image" content="{{ asset('/og-image.jpg') }}">
        <meta property="og:image:alt" content="Automotriz Centeno">
        <meta property="og:image:width" content="1920">
        <meta property="og:image:height" content="1080">
        <meta property="og:site_name" content="Automotriz Centeno">
        <meta property="og:locale" content="{{ app()->getLocale() }}">
        <meta property="og:article:published_time" content="2023-06-01T12:00:00Z">
        <meta property="og:article:author" content="John Doe">
        <meta property="og:article:section" content="Automotriz">
        <meta property="og:article:tag" content="Open Graph">
        <meta property="og:article:tag" content="Meta Tags">
        <!--<meta property="fb:app_id" content="123456789">-->
        <meta name="twitter:card" content="summary_large_image">
        <meta name="twitter:site" content="@automotizcenteno">
        <meta name="twitter:title" content="Automotriz Centeno">
        <meta name="twitter:description" content="En Automotriz Centeno atendemos Ford, Toyota, Kia, Mazda, Nissan, Mitsubishi, Chevrolet, Honda, Hyundai.">
        <meta name="twitter:image" content="{{ asset('/og-image.jpg') }}">
        <meta name="twitter:image:alt" content="Automotriz Centeno">

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @routes
        @vite(['resources/js/app.ts', "resources/js/Pages/{$page['component']}.vue"])
        @inertiaHead
    </head>
    <body class="font-sans antialiased">
        @inertia
    </body>
</html>
