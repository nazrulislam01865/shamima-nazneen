@php
    $social = $siteSettings->social_links ?? [];
@endphp
<footer>
    <div class="container">
        <div class="footer-grid">
            <div>
                <a class="brand" href="{{ route('home') }}">
                    <span class="brand-mark">
                        @if($siteSettings->logo_url)
                            <img src="{{ $siteSettings->logo_url }}" alt="{{ $siteSettings->site_name }} logo">
                        @else
                            {{ mb_substr($siteSettings->site_name ?: 'S', 0, 1) }}
                        @endif
                    </span>
                    <span>{{ $siteSettings->site_name }}</span>
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
                    @include('frontend.partials.social-links')
                </div>
            </div>
        </div>
        <div class="copyright">© {{ now()->year }} {{ $siteSettings->site_name }}. All rights reserved.</div>
    </div>
</footer>
