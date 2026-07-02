@extends('layouts.frontend')

@section('title', 'Works | '.$siteSettings->site_name)
@section('meta_description', strip_tags($page->get('hero')?->description ?: $siteSettings->seo_description))
@section('page_css', 'works')

@section('content')
@php
    $hero = $page->get('hero');
    $contact = $page->get('contact');
    $featuredWorks = $works->where('is_featured', true);
@endphp
<main id="top" data-initial-category="{{ $activeCategory }}">
    <section class="works-page-hero">
        <div class="container">
            <div class="works-title-wrap">
                <div class="section-label">{{ $hero?->eyebrow ?: 'Works' }}</div>
                <h1>{{ $hero?->title ?: 'Works' }}</h1>
                <div class="subhead">Filmography, television work, theatre, and digital appearances.</div>
                <div class="rich-content">{!! $hero?->description !!}</div>
            </div>
        </div>
    </section>

    <section class="works-main">
        <div class="container">
            <div class="works-control-panel">
                <div class="control-field">
                    <label for="workSearch">Search</label>
                    <input id="workSearch" type="search">
                </div>
                <div class="control-field">
                    <label for="yearFilter">Filter by Year</label>
                    <select id="yearFilter">
                        <option value="All Years">All Years</option>
                        @foreach($decades as $decade)<option value="{{ $decade }}">{{ $decade }}</option>@endforeach
                    </select>
                </div>
                <div class="control-field">
                    <label for="sortBy">Sort By</label>
                    <select id="sortBy">
                        <option value="latest">Latest First</option>
                        <option value="oldest">Oldest First</option>
                        <option value="az">A–Z</option>
                        <option value="category">Category</option>
                    </select>
                </div>
            </div>

            <div class="type-filters" aria-label="Filter by type">
                <button class="type-filter {{ $activeCategory ? '' : 'active' }}" data-type="All" data-slug="" type="button">All</button>
                @foreach($categories as $category)
                    <button class="type-filter {{ $activeCategory === $category->slug ? 'active' : '' }}" data-type="{{ $category->name }}" data-slug="{{ $category->slug }}" type="button">{{ $category->name }}</button>
                @endforeach
            </div>

            @if($featuredWorks->isNotEmpty())
                <section class="featured-strip">
                    <div class="works-section-title">
                        <h2>Featured Works</h2>
                        <div class="works-count">A selected view of notable works from her screen journey.</div>
                    </div>
                    <div class="featured-grid">
                        @foreach($featuredWorks as $work)
                            @php
                                $decade = $work->year ? ((int) floor($work->year / 10) * 10).'s' : '';
                            @endphp
                            <article class="featured-work"
                                     data-type="{{ $work->category->name }}"
                                     data-category-slug="{{ $work->category->slug }}"
                                     data-decade="{{ $decade }}"
                                     data-year="{{ $work->year }}"
                                     data-title="{{ mb_strtolower($work->title) }}"
                                     data-credit="{{ mb_strtolower($work->credit ?? '') }}"
                                     data-platform="{{ mb_strtolower($work->platform ?? '') }}">
                                <div class="featured-poster">
                                    @if($work->image_url)
                                        <img src="{{ $work->image_url }}" alt="{{ \App\Support\MediaLibrary::altTextForPath($work->image_path, $work->title) }}" data-fallback-text="{{ \App\Support\MediaLibrary::fallbackTextForPath($work->image_path, $siteSettings->image_fallback_text) }}">
                                    @else
                                        <span class="media-fallback film-background-fallback is-visible">{{ \App\Support\MediaLibrary::fallbackTextForPath($work->image_path, $siteSettings->image_fallback_text) }}</span>
                                    @endif
                                </div>
                                <div class="featured-body">
                                    <div class="work-meta"><span class="badge dark">{{ $work->category->name }}</span>@if($work->year)<span class="badge">{{ $work->year }}</span>@endif</div>
                                    <h3>{{ $work->title }}</h3>
                                    @if($work->credit)<p><strong>Credit:</strong> {{ $work->credit }}</p>@endif
                                    <p>{{ \Illuminate\Support\Str::limit(strip_tags($work->short_description), 145) }}</p>
                                    <div class="work-links">
                                        @include('frontend.partials.work-detail-button', ['work' => $work])
                                        @foreach($work->resolved_external_links as $link)
                                            @php
                                                $externalLink = \Illuminate\Support\Str::startsWith($link['url'], ['http://', 'https://']);
                                            @endphp
                                            <a class="work-external-link" href="{{ $link['url'] }}" @if($externalLink) target="_blank" rel="noopener noreferrer" @endif>{{ $link['label'] }}</a>
                                        @endforeach
                                    </div>
                                </div>
                            </article>
                        @endforeach
                    </div>
                </section>
            @endif

            <div class="credits-wrap">
                @foreach($categories as $category)
                    @php
                        $categoryWorks = $works->where('category_id', $category->id);
                    @endphp
                    @if($categoryWorks->isNotEmpty())
                        <section class="credit-section" id="{{ $category->slug }}-section" data-section="{{ $category->name }}">
                            <div class="credit-section-head">
                                <div>
                                    <div class="section-label">{{ $category->name }}</div>
                                    <h2>{{ $category->name }}</h2>
                                </div>
                                <div class="works-count">{{ $categoryWorks->count() }} {{ \Illuminate\Support\Str::plural('credit', $categoryWorks->count()) }}</div>
                            </div>
                            <div class="credit-list">
                                @foreach($categoryWorks as $work)
                                    @php
                                        $decade = $work->year ? ((int) floor($work->year / 10) * 10).'s' : '';
                                    @endphp
                                    <div class="credit-row"
                                         data-type="{{ $category->name }}"
                                         data-category-slug="{{ $category->slug }}"
                                         data-decade="{{ $decade }}"
                                         data-year="{{ $work->year }}"
                                         data-title="{{ mb_strtolower($work->title) }}"
                                         data-credit="{{ mb_strtolower($work->credit ?? '') }}"
                                         data-platform="{{ mb_strtolower($work->platform ?? '') }}">
                                        <div class="credit-year">{{ $work->year ?: '—' }}</div>
                                        <div class="credit-title">
                                            <h3>{{ $work->title }}</h3>
                                            <p>{{ \Illuminate\Support\Str::limit(strip_tags($work->short_description), 135) }}</p>
                                        </div>
                                        <div class="credit-info"><span>Credit / Role</span>{{ $work->credit ?: $work->role ?: '—' }}</div>
                                        <div class="credit-actions">
                                            @include('frontend.partials.work-detail-button', ['work' => $work])
                                            @foreach($work->resolved_external_links as $link)
                                            @php
                                                $externalLink = \Illuminate\Support\Str::startsWith($link['url'], ['http://', 'https://']);
                                            @endphp
                                            <a class="work-external-link" href="{{ $link['url'] }}" @if($externalLink) target="_blank" rel="noopener noreferrer" @endif>{{ $link['label'] }}</a>
                                        @endforeach
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </section>
                    @endif
                @endforeach
            </div>

            <div class="no-results" id="noResults">No works matched your filter. Try another category, year, or search term.</div>

            @if($contact)
                <div class="bottom-cta">
                    <div>
                        <h2>{{ $contact->title }}</h2>
                        <div class="rich-content">{!! $contact->description !!}</div>
                    </div>
                    <div class="hero-actions bottom-cta-actions" style="margin:0">
                        <a class="btn light bottom-cta-inquiry" href="{{ $contact->button_url ?: route('home').'#contact' }}">{{ $contact->button_label ?: 'Send Inquiry' }}</a>
                        <a class="btn outline bottom-cta-biography" href="{{ route('biography.index') }}">View Biography</a>
                        <a class="btn outline bottom-cta-videos" href="{{ route('videos.index') }}">Watch Videos</a>
                    </div>
                </div>
            @endif
        </div>
    </section>
</main>

@include('frontend.partials.work-modal')
@endsection
