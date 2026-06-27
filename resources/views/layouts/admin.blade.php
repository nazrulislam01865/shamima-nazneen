<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Admin') | {{ $siteSettings->site_name }}</title>
    @if($siteSettings->favicon_url)
        <link rel="icon" href="{{ $siteSettings->favicon_url }}">
    @endif
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&family=Playfair+Display:wght@600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/css/admin.css') }}">
    @stack('styles')
</head>
<body class="admin-body" data-image-fallback-text="{{ $siteSettings->image_fallback_text ?: 'Image is not available.' }}">
    <div class="admin-shell" data-admin-shell>
        <aside class="admin-sidebar" data-admin-sidebar>
            <a class="admin-brand" href="{{ route('admin.dashboard') }}">
                @if($siteSettings->logo_url)
                    <img src="{{ $siteSettings->logo_url }}" alt="{{ $siteSettings->site_name }}">
                @else
                    <span class="admin-brand-mark">SN</span>
                @endif
                <span>
                    <strong>{{ $siteSettings->site_name }}</strong>
                    <small>Website administration</small>
                </span>
            </a>

            <nav class="admin-nav" aria-label="Admin navigation">
                <div class="admin-nav-group">
                    <span class="admin-nav-group-title">Overview</span>
                    <a href="{{ route('admin.dashboard') }}" class="admin-nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                        <span class="nav-icon" aria-hidden="true">@include('admin.partials.icon', ['name' => 'grid'])</span>
                        <span>Dashboard</span>
                    </a>
                </div>

                <div class="admin-nav-group">
                    <span class="admin-nav-group-title">Website Pages</span>
                    @foreach($adminPages as $pageKey => $page)
                        @php
                            $pageActive = \App\Support\AdminPageRegistry::isPageActive($page);
                        @endphp
                        <details class="admin-nav-section {{ $pageActive ? 'active' : '' }}" @if($pageActive) open @endif>
                            <summary>
                                <span class="nav-icon" aria-hidden="true">@include('admin.partials.icon', ['name' => $page['icon']])</span>
                                <span>{{ $page['label'] }}</span>
                                <span class="nav-chevron" aria-hidden="true">@include('admin.partials.icon', ['name' => 'chevron-down'])</span>
                            </summary>
                            <div class="admin-subnav">
                                @foreach($page['modules'] as $module)
                                    @php
                                        $moduleActive = \App\Support\AdminPageRegistry::isModuleActive($module);
                                    @endphp
                                    <a href="{{ route($module['route'], $module['params'] ?? []) }}" class="{{ $moduleActive ? 'active' : '' }}">
                                        <span class="subnav-dot" aria-hidden="true"></span>
                                        <span>{{ $module['label'] }}</span>
                                        @if($module['key'] === 'inquiries' && ($adminNewInquiryCount ?? 0) > 0)
                                            <span class="nav-count">{{ $adminNewInquiryCount }}</span>
                                        @endif
                                    </a>
                                @endforeach
                            </div>
                        </details>
                    @endforeach

                    @php

                        $customPagesActive = request()->routeIs('admin.custom-pages.*');

                    @endphp
                    <details class="admin-nav-section {{ $customPagesActive ? 'active' : '' }}" @if($customPagesActive) open @endif>
                        <summary>
                            <span class="nav-icon" aria-hidden="true">@include('admin.partials.icon', ['name' => 'layout'])</span>
                            <span>Custom Pages</span>
                            <span class="nav-chevron" aria-hidden="true">@include('admin.partials.icon', ['name' => 'chevron-down'])</span>
                        </summary>
                        <div class="admin-subnav">
                            <a href="{{ route('admin.custom-pages.index') }}" class="{{ request()->routeIs('admin.custom-pages.index', 'admin.custom-pages.edit') ? 'active' : '' }}">
                                <span class="subnav-dot" aria-hidden="true"></span>
                                <span>All Custom Pages</span>
                            </a>
                            <a href="{{ route('admin.custom-pages.create') }}" class="{{ request()->routeIs('admin.custom-pages.create') ? 'active' : '' }}">
                                <span class="subnav-dot" aria-hidden="true"></span>
                                <span>Add New Page</span>
                            </a>
                        </div>
                    </details>
                </div>

                <div class="admin-nav-group">
                    <span class="admin-nav-group-title">General Settings</span>
                    <a href="{{ route('admin.settings.edit') }}" class="admin-nav-link {{ request()->routeIs('admin.settings.*') ? 'active' : '' }}">
                        <span class="nav-icon" aria-hidden="true">@include('admin.partials.icon', ['name' => 'settings'])</span>
                        <span>Site Identity & SEO</span>
                    </a>
                    <a href="{{ route('admin.menu-items.index', ['location' => 'header']) }}" class="admin-nav-link {{ request()->routeIs('admin.menu-items.*') ? 'active' : '' }}">
                        <span class="nav-icon" aria-hidden="true">@include('admin.partials.icon', ['name' => 'layout'])</span>
                        <span>Header & Footer Menus</span>
                    </a>
                    <a href="{{ route('admin.account.edit') }}" class="admin-nav-link {{ request()->routeIs('admin.account.*') ? 'active' : '' }}">
                        <span class="nav-icon" aria-hidden="true">@include('admin.partials.icon', ['name' => 'user'])</span>
                        <span>Administrator Account</span>
                    </a>
                </div>
            </nav>

            <div class="admin-sidebar-footer">
                <a href="{{ route('home') }}" target="_blank" rel="noopener noreferrer">View public website ↗</a>
            </div>
        </aside>

        <div class="admin-main">
            <header class="admin-topbar">
                <button class="admin-menu-button" type="button" data-sidebar-toggle aria-label="Open navigation">
                    <span></span><span></span><span></span>
                </button>
                <div class="admin-topbar-title">
                    <small>@yield('page_context', 'Website administration')</small>
                    <strong>@yield('page_title', 'Dashboard')</strong>
                </div>
                <div class="admin-account">
                    <span class="admin-avatar">{{ strtoupper(substr(auth()->user()->name, 0, 1)) }}</span>
                    <span class="admin-account-copy"><strong>{{ auth()->user()->name }}</strong><small>Administrator</small></span>
                    <form method="POST" action="{{ route('admin.logout') }}">
                        @csrf
                        <button class="admin-logout" type="submit">Log out</button>
                    </form>
                </div>
            </header>

            <main class="admin-content">
                @if(session('success'))
                    <div class="admin-alert success" role="status">
                        <strong>Saved.</strong> {{ session('success') }}
                        <button type="button" data-dismiss-alert aria-label="Dismiss">×</button>
                    </div>
                @endif
                @if(session('error'))
                    <div class="admin-alert error" role="alert">
                        <strong>Unable to continue.</strong> {{ session('error') }}
                        <button type="button" data-dismiss-alert aria-label="Dismiss">×</button>
                    </div>
                @endif
                @if($errors->any())
                    <div class="admin-alert error" role="alert">
                        <strong>Please correct the highlighted information.</strong>
                        <ul>@foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul>
                        <button type="button" data-dismiss-alert aria-label="Dismiss">×</button>
                    </div>
                @endif

                @yield('content')
            </main>
        </div>
        <button class="sidebar-backdrop" type="button" data-sidebar-backdrop aria-label="Close navigation"></button>
    </div>
    <script src="{{ asset('assets/js/admin.js') }}" defer></script>
    @stack('scripts')
</body>
</html>
