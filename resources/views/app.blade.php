<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title inertia>{{ $general->company_name }}</title>

    <link rel="shortcut icon" href="{{ asset(imagePath()['logoIcon']['path'] . '/favicon.png') }}" type="image/x-icon">

    <meta name="description" content="{{ $general->company_seo_description }}">
    <meta name="keywords" content="{{ implode(', ', $general->company_seo_keywords) }}">

    <!-- Apple Stuff -->
    <link rel="apple-touch-icon" href="{{ asset(imagePath()['logoIcon']['path'] . '/logo_white.png') }}">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="apple-mobile-web-app-title" content="{{ $general->company_name }}">

    <!-- Google / Search Engine Tags -->
    <meta itemprop="name" content="{{ $general->company_name }}">
    <meta itemprop="description" content="{{ $general->company_seo_description }}">
    <meta itemprop="image" content="{{ asset(imagePath()['seo']['path'] .'/seo.png') }}">

    <!-- Facebook Meta Tags -->
    <meta property="og:type" content="website">
    <meta property="og:title" content="{{ $general->company_name }}">
    <meta property="og:description" content="{{ $general->company_seo_description }}">
    <meta property="og:image" content="{{ asset(imagePath()['seo']['path'] .'/seo.png') }}"/>
    <meta property="og:image:type" content="image/png" />
    @php $social_image_size = explode('x', imagePath()['seo']['size']) @endphp
    <meta property="og:image:width" content="{{ $social_image_size[0] }}" />
    <meta property="og:image:height" content="{{ $social_image_size[1] }}" />
    <meta property="og:url" content="{{ url()->current() }}">

    <!-- Twitter Meta Tags -->
    <meta name="twitter:card" content="summary_large_image">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @routes
    @vite(['resources/js/app.js', "resources/js/Pages/{$page['component']}.vue"])
    @inertiaHead
</head>

<body class="font-sans antialiased">
    @inertia
</body>

</html>
