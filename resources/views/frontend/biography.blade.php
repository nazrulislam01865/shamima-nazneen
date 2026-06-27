@extends('layouts.frontend')

@section('title', 'Biography | '.$siteSettings->site_name)
@section('meta_description', strip_tags($page->get('hero')?->description ?: $siteSettings->seo_description))
@section('page_css', 'biography')

@section('content')
@php
    $hero = $page->get('hero');
    $gallerySection = $page->get('gallery');
@endphp
<main id="top">
    <section class="bio-page-hero">
        <div class="container bio-hero-grid">
            <div class="bio-hero-text">
                <div class="bio-kicker">{{ $hero?->eyebrow ?: 'Biography' }}</div>
                <h1>{{ $hero?->title ?: $siteSettings->site_name }}</h1>
                <div class="bio-designation">{{ $siteSettings->tagline }}</div>
                <div class="rich-content">{!! $hero?->description !!}</div>
            </div>
            <div class="bio-hero-image">
                <img src="{{ $hero?->image_url ?: asset('assets/images/template/embedded-92827328aada.png') }}" alt="{{ \App\Support\MediaLibrary::altTextForPath($hero?->image_path, $siteSettings->site_name.' biography portrait') }}" data-fallback-text="{{ \App\Support\MediaLibrary::fallbackTextForPath($hero?->image_path, $siteSettings->image_fallback_text) }}">
            </div>
        </div>
    </section>

    <section class="bio-content-wrap">
        <div class="container bio-layout">
            <aside class="bio-side" aria-label="Biography page navigation">
                <strong>On this page</strong>
                @foreach($sections as $section)
                    <a href="#{{ $section->slug }}">{{ $section->title }}</a>
                @endforeach
                <a href="#photo-video-gallery">Photos & Videos</a>
            </aside>

            <article class="bio-article">
                @foreach($sections as $section)
                    <section class="bio-block" id="{{ $section->slug }}">
                        @if($section->year_label)<div class="bio-section-year">{{ $section->year_label }}</div>@endif
                        <h2>{{ $section->title }}</h2>
                        <div class="rich-content">{!! $section->content !!}</div>
                        @if($section->image_url)
                            <figure class="bio-inline-image"><img src="{{ $section->image_url }}" alt="{{ \App\Support\MediaLibrary::altTextForPath($section->image_path, $section->title) }}" data-fallback-text="{{ \App\Support\MediaLibrary::fallbackTextForPath($section->image_path, $siteSettings->image_fallback_text) }}"></figure>
                        @endif
                    </section>
                @endforeach
            </article>
        </div>
    </section>

    @if($gallerySection && ($images->isNotEmpty() || $videos->isNotEmpty()))
        <section class="media-section" id="photo-video-gallery">
            <div class="container">
                <div class="section-head">
                    <div class="section-label">{{ $gallerySection->eyebrow }}</div>
                    <h2>{{ $gallerySection->title }}</h2>
                    <div class="lead rich-content">{!! $gallerySection->description !!}</div>
                </div>

                <div class="media-tabs">
                    @if($images->isNotEmpty())<button class="media-tab active" data-tab="images" type="button">Images</button>@endif
                    @if($videos->isNotEmpty())<button class="media-tab {{ $images->isEmpty() ? 'active' : '' }}" data-tab="videos" type="button">Videos</button>@endif
                </div>

                @if($images->isNotEmpty())
                    <div class="media-panel active" id="images">
                        <div class="gallery-preview">
                            @foreach($images->take(5) as $image)
                                <a class="media-card {{ $loop->first ? 'large' : '' }}" href="{{ route('gallery.index') }}" aria-label="View {{ $image->title }} in gallery">
                                    <img src="{{ $image->image_url }}" alt="{{ $image->alt_text ?: $image->title }}" data-fallback-text="{{ $image->fallback_text ?: $siteSettings->image_fallback_text }}">
                                    <span class="media-caption">{{ $image->category ?: $image->title }}</span>
                                </a>
                            @endforeach
                        </div>
                        <p style="margin-top:28px"><a class="btn dark" href="{{ route('gallery.index') }}">View Full Gallery</a></p>
                    </div>
                @endif

                @if($videos->isNotEmpty())
                    <div class="media-panel {{ $images->isEmpty() ? 'active' : '' }}" id="videos">
                        <div class="video-preview">
                            @foreach($videos->take(5) as $video)
                                @php
                                    $watchUrl = $video->youtube_watch_url;
                                    $relatedUrl = $video->link_url;
                                    $showRelatedLink = filled($relatedUrl) && $relatedUrl !== $watchUrl;
                                @endphp
                                <article class="bio-video-card">
                                    <div class="bio-video-thumb embedded-video-wrap">
                                        <iframe src="{{ $video->embed_url }}" title="{{ $video->title }}" loading="lazy" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
                                    </div>
                                    <div class="bio-video-content">
                                        <h3><a href="{{ $video->youtube_watch_url }}" target="_blank" rel="noopener noreferrer">{{ $video->title }}</a></h3>
                                        <p>{{ \Illuminate\Support\Str::limit(strip_tags($video->description), 125) }}</p>
                                        @if($watchUrl)<a class="video-youtube-link" href="{{ $watchUrl }}" target="_blank" rel="noopener noreferrer">Watch on YouTube →</a>@endif
                                        @if($showRelatedLink)<a class="video-youtube-link" href="{{ $relatedUrl }}" target="_blank" rel="noopener noreferrer">{{ $video->link_name ?: 'Open related link' }} →</a>@endif
                                    </div>
                                </article>
                            @endforeach
                        </div>
                        <p style="margin-top:28px"><a class="btn dark" href="{{ route('videos.index') }}">View All Videos</a></p>
                    </div>
                @endif
            </div>
        </section>
    @endif
</main>
@endsection
