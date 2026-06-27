<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', $siteSettings->seo_title ?: $siteSettings->site_name)</title>
    <meta name="description" content="@yield('meta_description', $siteSettings->seo_description)">
    @if($siteSettings->favicon_url)
        <link rel="icon" href="{{ $siteSettings->favicon_url }}">
    @endif
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@500;600;700&family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/css/'.trim($__env->yieldContent('page_css', 'home')).'.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/site-overrides.css') }}">
    @stack('styles')
</head>
<body data-image-fallback-text="{{ $siteSettings->image_fallback_text ?: 'Image is not available.' }}">
    @include('frontend.partials.header')

    @if(session('success'))
        <div class="site-flash site-flash-success" role="status">{{ session('success') }}</div>
    @endif

    @if($errors->any())
        <div class="site-flash site-flash-error" role="alert">
            <strong>Please correct the highlighted information.</strong>
            <ul>
                @foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach
            </ul>
        </div>
    @endif

    @yield('content')

    @include('frontend.partials.footer')

    <script src="{{ asset('assets/js/site.js') }}" defer></script>
    @stack('scripts')
</body>
</html>
