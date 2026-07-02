@php
    $profileCardLinks = collect($siteSettings->profile_card_links ?? [])
        ->filter(fn ($link) => filled($link['title'] ?? null) && filled($link['url'] ?? null))
        ->values();

    if ($profileCardLinks->isEmpty()) {
        $legacyDefinitions = [
            'chorki' => ['title' => 'Chorki', 'description' => 'Explore the public Chorki cast and platform profile.'],
            'imdb' => ['title' => 'IMDb', 'description' => 'View screen credits and the public IMDb profile.'],
            'wikipedia' => ['title' => 'Wikipedia', 'description' => 'Open the public Wikipedia profile and biography reference.'],
            'youtube' => ['title' => 'YouTube', 'description' => 'Watch public interviews, appearances, and video features.'],
            'facebook' => ['title' => 'Facebook', 'description' => 'Visit the official Facebook page and public features.'],
        ];

        $profileCardLinks = collect($legacyDefinitions)
            ->map(fn ($definition, $key) => filled($social[$key] ?? null) ? [
                'title' => $definition['title'],
                'url' => $social[$key],
                'description' => $definition['description'],
                'icon_path' => null,
            ] : null)
            ->filter()
            ->values();
    }

    $profileMarkFor = function (?string $title, ?string $url = null): array {
        $normalized = strtolower(trim(($title ?? '').' '.($url ?? '')));
        return match (true) {
            str_contains($normalized, 'chorki') => ['mark' => 'C', 'class' => 'chorki'],
            str_contains($normalized, 'imdb') => ['mark' => 'IMDb', 'class' => 'imdb'],
            str_contains($normalized, 'wiki') => ['mark' => 'W', 'class' => 'wikipedia'],
            str_contains($normalized, 'youtube') || str_contains($normalized, 'youtu.be') => ['mark' => '▶', 'class' => 'youtube'],
            str_contains($normalized, 'facebook') || str_contains($normalized, 'fb.com') => ['mark' => 'f', 'class' => 'facebook'],
            str_contains($normalized, 'instagram') => ['mark' => '◎', 'class' => 'instagram'],
            str_contains($normalized, 'linkedin') => ['mark' => 'in', 'class' => 'linkedin'],
            str_contains($normalized, 'x.com') || str_contains($normalized, 'twitter') => ['mark' => '𝕏', 'class' => 'x'],
            default => ['mark' => mb_strtoupper(mb_substr(trim((string) $title), 0, 1)) ?: '↗', 'class' => 'default'],
        };
    };
@endphp

@if($profileMedia->isNotEmpty() || $profileCardLinks->isNotEmpty())
<section class="works media-profiles-section" id="media">
    <div class="container">
        <div class="section-head media-section-head">
            @if($section->eyebrow)<div class="section-label">{{ $section->eyebrow }}</div>@endif
            <h2>{{ $section->title }}</h2>
            <div class="lead rich-content">{!! $section->description !!}</div>
        </div>

        @if($profileCardLinks->isNotEmpty())
            <div class="profile-follow-panel">
                <h3><span aria-hidden="true">✦</span> Follow {{ $siteSettings->site_name }} <span aria-hidden="true">✦</span></h3>
                <div class="profile-follow-grid">
                    @foreach($profileCardLinks as $profileLink)
                        @php
                            $profileUrl = $profileLink['url'];
                            $profileIsExternal = \Illuminate\Support\Str::startsWith($profileUrl, ['http://', 'https://']);
                            $profileTitle = $profileLink['title'];
                            $icon = $profileMarkFor($profileTitle, $profileUrl);
                            $profileIconUrl = \App\Support\Media::url($profileLink['icon_path'] ?? null);
                        @endphp
                        <a class="profile-follow-card profile-follow-card-{{ $icon['class'] }}" href="{{ $profileUrl }}" @if($profileIsExternal) target="_blank" rel="noopener noreferrer" @endif>
                            <span class="profile-follow-icon {{ $profileIconUrl ? 'has-custom-icon' : '' }}" aria-hidden="true">
                                @if($profileIconUrl)
                                    <img src="{{ $profileIconUrl }}" alt="" loading="lazy" data-fallback-text="Profile logo is not available.">
                                @else
                                    {{ $icon['mark'] }}
                                @endif
                            </span>
                            <span class="profile-follow-copy">
                                <strong>{{ $profileTitle }}</strong>
                                @if(filled($profileLink['description'] ?? null))<small>{{ $profileLink['description'] }}</small>@endif
                            </span>
                            <span class="profile-follow-arrow" aria-hidden="true">›</span>
                        </a>
                    @endforeach
                </div>
            </div>
        @endif

        @if($profileMedia->isNotEmpty())
            <div class="press-grid media-library-grid">
                @foreach($profileMedia as $profileItem)
                    @php
                        $profileUrl = $profileItem->link_url ?: ($profileItem->type === 'video' ? $profileItem->youtube_watch_url : route('gallery.index'));
                        $profileIsExternal = \Illuminate\Support\Str::startsWith($profileUrl, ['http://', 'https://']);
                    @endphp
                    <a class="press-card press-card-link media-library-press-card" href="{{ $profileUrl }}" @if($profileIsExternal) target="_blank" rel="noopener noreferrer" @endif>
                        <div class="press-card-media">
                            @if($profileItem->image_url)
                                <img src="{{ $profileItem->image_url }}" alt="{{ $profileItem->alt_text ?: $profileItem->title }}" data-fallback-text="{{ $profileItem->fallback_text ?: $siteSettings->image_fallback_text }}">
                            @else
                                <span class="media-fallback is-visible">{{ $profileItem->fallback_text ?: $siteSettings->image_fallback_text }}</span>
                            @endif
                            @if($profileItem->type === 'video')<span class="press-play" aria-hidden="true">▶</span>@endif
                        </div>
                        <h3>{{ $profileItem->title }}</h3>
                        <p>{{ \Illuminate\Support\Str::limit(strip_tags($profileItem->description ?: $profileItem->link_label ?: 'Open this profile or media feature.'), 120) }}</p>
                        <span class="text-link">{{ $profileItem->link_label ?: 'Open link' }}</span>
                    </a>
                @endforeach
            </div>
        @endif
    </div>
</section>
@endif
