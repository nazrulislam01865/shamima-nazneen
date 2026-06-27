@extends('layouts.frontend')

@section('title', $siteSettings->seo_title ?: $siteSettings->site_name)
@section('meta_description', $siteSettings->seo_description)
@section('page_css', 'home')

@section('content')
@php
    $social = $siteSettings->social_links ?? [];
@endphp
<main id="home">
    <section class="hero" aria-label="Hero image slider">
        <div class="slider dynamic-slider" data-slider>
            @forelse($slides as $slide)
                @php
                    $slideSettings = $slide->settings ?? [];
                    $alignment = $slideSettings['text_alignment'] ?? 'left';
                    $vertical = $slideSettings['vertical_position'] ?? 'bottom';
                    $textColor = $slideSettings['text_color'] ?? '#FFFFFF';
                    $overlayOpacity = max(0, min(80, (int) ($slideSettings['overlay_opacity'] ?? 28))) / 100;
                    $titleSize = max(32, min(110, (int) ($slideSettings['title_size'] ?? 76)));
                    $subtitleSize = max(12, min(36, (int) ($slideSettings['subtitle_size'] ?? 18)));
                @endphp
                <div class="slide {{ $loop->first ? 'active' : '' }}" data-slide data-safe-background="{{ $slide->image_url }}">
                    <span class="media-fallback hero-background-fallback" data-background-fallback>{{ \App\Support\MediaLibrary::fallbackTextForPath($slide->image_path, $siteSettings->image_fallback_text) }}</span>
                    <span class="hero-slide-overlay" style="background:rgba(0,0,0,{{ $overlayOpacity }})" aria-hidden="true"></span>
                    @if($slide->title || $slide->subtitle)
                        <div class="hero-slide-content container align-{{ $alignment }} vertical-{{ $vertical }}" style="--hero-text-color:{{ $textColor }};--hero-title-size:{{ $titleSize }}px;--hero-subtitle-size:{{ $subtitleSize }}px">
                            <div class="hero-slide-copy">
                                @if($slide->title)<h1>{{ $slide->title }}</h1>@endif
                                @if($slide->subtitle)<p>{{ $slide->subtitle }}</p>@endif
                            </div>
                        </div>
                    @endif
                </div>
            @empty
                <div class="slide active" data-slide data-safe-background="{{ asset('assets/images/template/embedded-bfef7bc6b1de.png') }}"><span class="media-fallback hero-background-fallback" data-background-fallback>{{ $siteSettings->image_fallback_text }}</span></div>
            @endforelse
        </div>
    </section>

    @if(collect($social)->filter()->isNotEmpty())
        <div class="social-strip">
            <div class="container social-inner">
                <strong class="social-title">
                    Follow {{ $siteSettings->site_name }}
                    <span>Stay connected and follow her journey</span>
                </strong>
                <div class="social-links">@include('frontend.partials.social-links')</div>
            </div>
        </div>
    @endif

    @foreach($sections as $section)
        @if(\Illuminate\Support\Str::startsWith($section->section_key, 'custom-'))
            @include('frontend.home-sections.custom', ['section' => $section])
        @elseif(view()->exists('frontend.home-sections.'.$section->section_key))
            @include('frontend.home-sections.'.$section->section_key, ['section' => $section])
        @endif
    @endforeach
</main>

@include('frontend.partials.work-modal')
@endsection
