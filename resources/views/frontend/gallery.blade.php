@extends('layouts.frontend')

@section('title', 'Gallery | '.$siteSettings->site_name)
@section('meta_description', strip_tags($page->get('hero')?->description ?: $siteSettings->seo_description))
@section('page_css', 'gallery')

@section('content')
@php
    $hero = $page->get('hero');
@endphp
<main id="top" data-initial-gallery-filter="{{ $initialType ?? '' }}">
    <section class="gallery-page-hero">
        <div class="container">
            <div class="gallery-title-wrap">
                <div class="section-label">{{ $hero?->eyebrow ?: 'Gallery' }}</div>
                <h1>{{ $hero?->title ?: 'Image & Video Gallery' }}</h1>
                <div class="subhead">Moments from screen, stage, and public life.</div>
                <div class="rich-content">{!! $hero?->description !!}</div>
            </div>
        </div>
    </section>

    <section class="gallery-main">
        <div class="container">
            <div class="filter-bar" aria-label="Gallery filter options">
                <button class="filter-btn active" data-filter="all" type="button">All</button>
                <button class="filter-btn" data-filter="type:image" type="button">Images</button>
                <button class="filter-btn" data-filter="type:video" type="button">Videos</button>
                @foreach($categories as $category)
                    <button class="filter-btn" data-filter="category:{{ $category }}" type="button">{{ $category }}</button>
                @endforeach
            </div>

            <div class="image-grid">
                @forelse($items as $item)
                    @php
                        $shape = $loop->iteration % 7 === 1 ? 'large' : ($loop->iteration % 5 === 0 ? 'wide' : ($loop->iteration % 3 === 0 ? 'tall' : ''));
                    @endphp
                    @if($item->type === 'image')
                        <article class="gallery-card image-gallery-card {{ $shape }}"
                                 data-type="image"
                                 data-category="{{ $item->category }}"
                                 tabindex="0"
                                 role="button"
                                 aria-label="Open {{ $item->title }}">
                            <img src="{{ $item->image_url }}" alt="{{ $item->alt_text ?: $item->title }}" data-fallback-text="{{ $item->fallback_text ?: $siteSettings->image_fallback_text }}">
                            <div class="gallery-card-content">
                                <span class="label">{{ $item->category ?: 'Image' }}@if($item->year) · {{ $item->year }}@endif</span>
                                <h3>{{ $item->title }}</h3>
                            </div>
                            @if($item->description)<template class="gallery-description">{!! $item->description !!}</template>@endif
                        </article>
                    @else
                        @php
                            $watchUrl = $item->youtube_watch_url;
                            $relatedUrl = trim((string) $item->link_url);
                            $showRelatedLink = filled($relatedUrl) && $relatedUrl !== $watchUrl;
                            $relatedIsExternal = \Illuminate\Support\Str::startsWith($relatedUrl, ['http://', 'https://']);
                        @endphp
                        <article class="gallery-card video-gallery-card {{ $shape }}" data-type="video" data-category="{{ $item->category }}">
                            <div class="gallery-video-frame">
                                @if($item->embed_url)
                                    <iframe src="{{ $item->embed_url }}" title="{{ $item->title }}" loading="lazy" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
                                @elseif($item->image_url)
                                    <img src="{{ $item->image_url }}" alt="{{ $item->alt_text ?: $item->title }}" data-fallback-text="{{ $item->fallback_text ?: $siteSettings->image_fallback_text }}">
                                @endif
                            </div>
                            <div class="gallery-card-content gallery-video-content">
                                <span class="label">{{ $item->category ?: 'Video' }}@if($item->year) · {{ $item->year }}@endif</span>
                                <h3>
                                    @if($item->youtube_watch_url)<a href="{{ $item->youtube_watch_url }}" target="_blank" rel="noopener noreferrer">{{ $item->title }}</a>@else{{ $item->title }}@endif
                                </h3>
                                @if($item->description)<p>{{ \Illuminate\Support\Str::limit(strip_tags($item->description), 105) }}</p>@endif
                                @if($watchUrl)<a class="gallery-youtube-link" href="{{ $watchUrl }}" target="_blank" rel="noopener noreferrer">Watch on YouTube →</a>@endif
                                @if($showRelatedLink)<a class="gallery-youtube-link" href="{{ $relatedUrl }}" @if($relatedIsExternal) target="_blank" rel="noopener noreferrer" @endif>{{ $item->link_name ?: 'Open related link' }} →</a>@endif
                            </div>
                        </article>
                    @endif
                @empty
                    <div class="gallery-empty">No gallery items are available yet.</div>
                @endforelse
            </div>
        </div>
    </section>
</main>

<div class="lightbox" id="lightbox" aria-hidden="true" role="dialog" aria-modal="true" aria-labelledby="lightboxCaption">
    <div class="lightbox-box">
        <img id="lightboxImg" src="" alt="" data-no-fallback>
        <div class="lightbox-caption">
            <div>
                <strong id="lightboxCaption">Gallery image</strong>
                <div id="lightboxDescription" class="lightbox-description"></div>
            </div>
            <button class="close-lightbox" type="button">Close</button>
        </div>
    </div>
</div>
@endsection
