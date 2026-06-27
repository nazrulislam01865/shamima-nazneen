@if($homeImages->isNotEmpty())
<section id="gallery">
        <div class="container">
            <div class="section-head">
                @if($section->eyebrow)<div class="section-label">{{ $section->eyebrow }}</div>@endif
                <h2>{{ $section->title }}</h2>
                <div class="lead rich-content">{!! $section->description !!}</div>
                <div class="categories">
                    @foreach($homeImages->pluck('category')->filter()->unique() as $category)<span>{{ $category }}</span>@endforeach
                </div>
            </div>
            <div class="gallery-grid">
                @foreach($homeImages->take(5) as $image)
                    <a class="gallery-item {{ $loop->first ? 'large' : '' }}" href="{{ route('gallery.index') }}" aria-label="Open {{ $image->title }} in gallery">
                        <img src="{{ $image->image_url }}" alt="{{ $image->alt_text ?: $image->title }}" data-fallback-text="{{ $image->fallback_text ?: $siteSettings->image_fallback_text }}">
                        @if($image->category)<span class="tag">{{ $image->category }}</span>@endif
                    </a>
                @endforeach
            </div>
            <p style="margin-top:28px"><a class="btn soft" href="{{ $section->button_url ?: route('gallery.index') }}">{{ $section->button_label ?: 'View Full Gallery' }}</a></p>
        </div>
    </section>
@endif
