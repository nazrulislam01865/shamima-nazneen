@php
    $layout = $section->settings['layout'] ?? 'image-right';
    $hasImage = filled($section->image_url) && $layout !== 'text-only';
@endphp
<section class="custom-home-section" id="{{ $section->section_key }}">
    <div class="container">
        <div class="custom-home-grid {{ $hasImage ? 'has-image layout-'.$layout : 'text-only' }}">
            @if($hasImage && $layout === 'image-left')
                <div class="custom-home-image"><img src="{{ $section->image_url }}" alt="{{ \App\Support\MediaLibrary::altTextForPath($section->image_path, $section->title) }}" data-fallback-text="{{ \App\Support\MediaLibrary::fallbackTextForPath($section->image_path, $siteSettings->image_fallback_text) }}"></div>
            @endif
            <div class="custom-home-copy">
                @if($section->eyebrow)<div class="section-label">{{ $section->eyebrow }}</div>@endif
                @if($section->title)<h2>{{ $section->title }}</h2>@endif
                @if($section->description)<div class="lead rich-content">{!! $section->description !!}</div>@endif
                @if($section->secondary_text)<div class="rich-content secondary-copy">{!! $section->secondary_text !!}</div>@endif
                @if($section->button_label && $section->button_url)<a class="btn dark" href="{{ $section->button_url }}">{{ $section->button_label }}</a>@endif
            </div>
            @if($hasImage && $layout === 'image-right')
                <div class="custom-home-image"><img src="{{ $section->image_url }}" alt="{{ \App\Support\MediaLibrary::altTextForPath($section->image_path, $section->title) }}" data-fallback-text="{{ \App\Support\MediaLibrary::fallbackTextForPath($section->image_path, $siteSettings->image_fallback_text) }}"></div>
            @endif
        </div>
    </div>
</section>
