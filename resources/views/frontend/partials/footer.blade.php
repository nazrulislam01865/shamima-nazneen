@php
    $social = $siteSettings->social_links ?? [];
    $footerFollowLinks = collect($siteSettings->profile_card_links ?? [])
        ->filter(fn ($link) => filled($link['title'] ?? null) && filled($link['url'] ?? null))
        ->values();
    $hasLogo = filled($siteSettings->logo_url);
@endphp
<footer>
    <div class="container">
        <div class="footer-grid">
            <div>
                <a class="brand footer-brand {{ $hasLogo ? 'brand-logo-only' : '' }}" href="{{ route('home') }}" aria-label="{{ $siteSettings->site_name }} home">
                    @if($hasLogo)
                        <img class="site-logo-img footer-logo-img" src="{{ $siteSettings->logo_url }}" alt="{{ $siteSettings->site_name }} logo">
                    @else
                        <span class="brand-mark">
                            {{ mb_substr($siteSettings->site_name ?: 'S', 0, 1) }}
                        </span>
                        <span class="brand-name">{{ $siteSettings->site_name }}</span>
                    @endif
                </a>
                <p>{{ $siteSettings->footer_text ?: $siteSettings->tagline }}</p>
            </div>
            <div>
                <strong>Quick Links</strong>
                <div class="footer-links" style="margin-top:12px">
                    @forelse($footerMenuItems as $menuItem)
                        <a href="{{ $menuItem->public_url }}" @if($menuItem->open_new_tab) target="_blank" rel="noopener noreferrer" @endif>{{ $menuItem->label }}</a>
                    @empty
                        <a href="{{ route('home') }}#about">About</a>
                        <a href="{{ route('biography.index') }}">Biography</a>
                        <a href="{{ route('works.index') }}">Works</a>
                        <a href="{{ route('videos.index') }}">Videos</a>
                        <a href="{{ route('gallery.index') }}">Gallery</a>
                    @endforelse
                    @foreach($footerCustomPages as $customMenuPage)
                        <a href="{{ route('pages.show', $customMenuPage) }}">{{ $customMenuPage->name }}</a>
                    @endforeach
                </div>
            </div>
            <div>
                <strong>Social Links</strong>
                <div class="footer-social-icons">
                    @include('frontend.partials.social-links', ['links' => $footerFollowLinks])
                </div>
            </div>
        </div>
        <div class="copyright">© {{ now()->year }} {{ $siteSettings->site_name }}. All rights reserved.</div>
    </div>
</footer>
