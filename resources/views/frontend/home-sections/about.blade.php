    <section id="about">
        <div class="container about-grid">
            <div class="portrait-card">
                <img src="{{ $section->image_url ?: asset('assets/images/template/embedded-2516360e304f.png') }}" alt="{{ \App\Support\MediaLibrary::altTextForPath($section->image_path, $section->title) }}" data-fallback-text="{{ \App\Support\MediaLibrary::fallbackTextForPath($section->image_path, $siteSettings->image_fallback_text) }}">
            </div>
            <div class="bio-copy">
                @if($section->eyebrow)<div class="section-label">{{ $section->eyebrow }}</div>@endif
                <h2>{{ $section->title }}</h2>
                <div class="rich-content">{!! $section->description !!}</div>
                @if($section->button_label)
                    <a class="btn dark" href="{{ $section->button_url ?: route('biography.index') }}">{{ $section->button_label }}</a>
                @endif
            </div>
        </div>
    </section>
