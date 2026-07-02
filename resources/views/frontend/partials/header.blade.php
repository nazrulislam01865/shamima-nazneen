@php
    $home = route('home');
    $social = $siteSettings->social_links ?? [];
    $headerFollowLinks = collect($siteSettings->profile_card_links ?? [])
        ->filter(fn ($link) => filled($link['title'] ?? null) && filled($link['url'] ?? null))
        ->values();
    $hasFollowLinks = $headerFollowLinks->isNotEmpty() || collect($social)->filter()->isNotEmpty();
    $hasLogo = filled($siteSettings->logo_url);
@endphp
<header class="topbar">
    <div class="container nav">
        <a class="brand {{ $hasLogo ? 'brand-logo-only' : '' }}" href="{{ $home }}" aria-label="{{ $siteSettings->site_name }} home">
            @if($hasLogo)
                <img class="site-logo-img" src="{{ $siteSettings->logo_url }}" alt="{{ $siteSettings->site_name }} logo">
            @else
                <span class="brand-mark">
                    {{ mb_substr($siteSettings->site_name ?: 'S', 0, 1) }}
                </span>
                <span class="brand-name">{{ $siteSettings->site_name }}</span>
            @endif
        </a>

        <button class="mobile-nav-toggle" type="button" aria-expanded="false" aria-controls="mainNavigation" aria-label="Open navigation">
            <span></span><span></span><span></span>
        </button>

        <nav id="mainNavigation" class="navlinks" aria-label="Main navigation">
            <div class="mobile-nav-panel-brand" aria-hidden="true">
                <span class="brand-mark small">
                    {{ mb_substr($siteSettings->site_name ?: 'S', 0, 1) }}
                </span>
                <strong>{{ $siteSettings->site_name }}</strong>
            </div>

            <div class="navlinks-main">
                @forelse($headerMenuItems as $menuItem)
                    <a class="nav-menu-link" href="{{ $menuItem->public_url }}" @if($menuItem->open_new_tab) target="_blank" rel="noopener noreferrer" @endif>
                        <span>{{ $menuItem->label }}</span>
                    </a>
                @empty
                    <a class="nav-menu-link" href="{{ $home }}#about"><span>About</span></a>
                    <a class="nav-menu-link" href="{{ route('biography.index') }}"><span>Biography</span></a>
                    <a class="nav-menu-link" href="{{ route('works.index') }}"><span>Works</span></a>
                    <a class="nav-menu-link" href="{{ route('works.index', ['category' => 'films']) }}"><span>Films</span></a>
                    <a class="nav-menu-link" href="{{ route('videos.index') }}"><span>Videos</span></a>
                    <a class="nav-menu-link" href="{{ route('gallery.index') }}"><span>Gallery</span></a>
                    <a class="nav-menu-link" href="{{ $home }}#contact"><span>Contact</span></a>
                @endforelse
                @foreach($headerCustomPages as $customMenuPage)
                    <a class="nav-menu-link" href="{{ route('pages.show', $customMenuPage) }}">
                        <span>{{ $customMenuPage->name }}</span>
                    </a>
                @endforeach
            </div>

            @if($hasFollowLinks)
                <div class="mobile-nav-follow">
                    <span>Follow</span>
                    <div class="mobile-nav-follow-grid">
                        @include('frontend.partials.social-links', ['links' => $headerFollowLinks, 'compact' => true])
                    </div>
                </div>
            @endif
        </nav>

        <a class="nav-cta" href="{{ $home }}#contact">{{ $siteSettings->media_inquiry_label ?: 'Media Inquiry' }}</a>
    </div>
</header>
