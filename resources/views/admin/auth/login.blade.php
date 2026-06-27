<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Admin Login | {{ $siteSettings->site_name }}</title>
    @if($siteSettings->favicon_url)<link rel="icon" href="{{ $siteSettings->favicon_url }}">@endif
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&family=Playfair+Display:wght@600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/css/admin.css') }}">
</head>
<body class="login-page">
    <main class="login-card">
        <div class="login-brand">
            @if($siteSettings->logo_url)
                <img class="current-logo" src="{{ $siteSettings->logo_url }}" alt="{{ $siteSettings->site_name }}">
            @else
                <span class="admin-brand-mark">SN</span>
            @endif
            <h1>Admin Login</h1>
            <p>Manage the biography, works, gallery, videos, and website settings.</p>
        </div>

        @if($errors->any())
            <div class="admin-alert error" role="alert">
                <strong>Login failed.</strong>
                <ul>@foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul>
            </div>
        @endif

        <form action="{{ route('admin.login.store') }}" method="POST">
            @csrf
            <x-admin.input name="email" label="Email address" type="email" :value="old('email')" required autocomplete="email" autofocus placeholder="admin@example.com" />
            <x-admin.input name="password" label="Password" type="password" required autocomplete="current-password" placeholder="Enter your admin password" />
            <x-admin.checkbox name="remember" label="Keep me signed in" :checked="false" help="Use this only on a trusted device." />
            <button class="admin-button primary" type="submit">Sign in to administration</button>
        </form>
        <p class="login-footer"><a href="{{ route('home') }}">← Return to public website</a></p>
    </main>
</body>
</html>
