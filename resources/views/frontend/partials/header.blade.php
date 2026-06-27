@php
    $home = route('home');
    $social = $siteSettings->social_links ?? [];
@endphp
<header class="topbar">
    <div class="container nav">
        <a class="brand" href="{{ $home }}" aria-label="{{ $siteSettings->site_name }} home">
            <span class="brand-mark">
                @if($siteSettings->logo_url)
                    <img src="{{ $siteSettings->logo_url }}" alt="{{ $siteSettings->site_name }} logo">
                @else
                    {{ mb_substr($siteSettings->site_name ?: 'S', 0, 1) }}
                @endif
            </span>
            <span>{{ $siteSettings->site_name }}</span>
        </a>

        <button class="mobile-nav-toggle" type="button" aria-expanded="false" aria-controls="mainNavigation" aria-label="Open navigation">
            <span></span><span></span><span></span>
        </button>

        <nav id="mainNavigation" class="navlinks" aria-label="Main navigation">
            <div class="mobile-nav-panel-brand">
                <span class="brand-mark small">
                    @if($siteSettings->logo_url)
                        <img src="{{ $siteSettings->logo_url }}" alt="{{ $siteSettings->site_name }} logo">
                    @else
                        {{ mb_substr($siteSettings->site_name ?: 'S', 0, 1) }}
                    @endif
                </span>
                <strong>{{ $siteSettings->site_name }}</strong>
            </div>

            <div class="navlinks-main">
                @forelse($headerMenuItems as $menuItem)
                    <a class="nav-menu-link" href="{{ $menuItem->public_url }}" @if($menuItem->open_new_tab) target="_blank" rel="noopener noreferrer" @endif>
                        <span class="nav-link-icon" aria-hidden="true">
                            @if($menuItem->icon_url)
                                <img src="{{ $menuItem->icon_url }}" alt="">
                            @else
                                @include('frontend.partials.menu-icon', ['icon' => $menuItem->icon_key])
                            @endif
                        </span>
                        <span>{{ $menuItem->label }}</span>
                    </a>
                @empty
                    <a class="nav-menu-link" href="{{ $home }}#about"><span class="nav-link-icon" aria-hidden="true">@include('frontend.partials.menu-icon', ['icon' => 'user'])</span><span>About</span></a>
                    <a class="nav-menu-link" href="{{ route('biography.index') }}"><span class="nav-link-icon" aria-hidden="true">@include('frontend.partials.menu-icon', ['icon' => 'book'])</span><span>Biography</span></a>
                    <a class="nav-menu-link" href="{{ route('works.index') }}"><span class="nav-link-icon" aria-hidden="true">@include('frontend.partials.menu-icon', ['icon' => 'briefcase'])</span><span>Works</span></a>
                    <a class="nav-menu-link" href="{{ route('works.index', ['category' => 'films']) }}"><span class="nav-link-icon" aria-hidden="true">@include('frontend.partials.menu-icon', ['icon' => 'clapper'])</span><span>Films</span></a>
                    <a class="nav-menu-link" href="{{ route('videos.index') }}"><span class="nav-link-icon" aria-hidden="true">@include('frontend.partials.menu-icon', ['icon' => 'video'])</span><span>Videos</span></a>
                    <a class="nav-menu-link" href="{{ route('gallery.index') }}"><span class="nav-link-icon" aria-hidden="true">@include('frontend.partials.menu-icon', ['icon' => 'image'])</span><span>Gallery</span></a>
                    <a class="nav-menu-link" href="{{ $home }}#contact"><span class="nav-link-icon" aria-hidden="true">@include('frontend.partials.menu-icon', ['icon' => 'mail'])</span><span>Contact</span></a>
                @endforelse
                @foreach($headerCustomPages as $customMenuPage)
                    <a class="nav-menu-link" href="{{ route('pages.show', $customMenuPage) }}">
                        <span class="nav-link-icon" aria-hidden="true">@include('frontend.partials.menu-icon', ['icon' => 'link'])</span>
                        <span>{{ $customMenuPage->name }}</span>
                    </a>
                @endforeach
            </div>

            @if(collect($social)->filter()->isNotEmpty())
                <div class="mobile-nav-follow">
                    <span>Follow</span>
                    <div class="mobile-nav-follow-grid">
                        @include('frontend.partials.social-links', ['compact' => true])
                    </div>
                </div>
            @endif
        </nav>

        <a class="nav-cta" href="{{ $home }}#contact">{{ $siteSettings->media_inquiry_label ?: 'Media Inquiry' }}</a>
    </div>
</header>
