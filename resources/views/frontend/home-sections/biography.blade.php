    <section id="biography">
        <div class="container">
            <div class="section-head">
                @if($section->eyebrow)<div class="section-label">{{ $section->eyebrow }}</div>@endif
                <h2>{{ $section->title }}</h2>
                <div class="lead rich-content">{!! $section->description !!}</div>
            </div>
            <div class="chapters">
                <div class="chapter-image" aria-label="Biography image">
                    <img src="{{ $section->image_url ?: asset('assets/images/template/embedded-92827328aada.png') }}" alt="{{ \App\Support\MediaLibrary::altTextForPath($section->image_path, $section->title) }}" data-fallback-text="{{ \App\Support\MediaLibrary::fallbackTextForPath($section->image_path, $siteSettings->image_fallback_text) }}">
                </div>
                <div class="chapter-list">
                    @foreach($homeBiographySections as $chapter)
                        <article class="chapter">
                            <div class="num">{{ str_pad((string) $loop->iteration, 2, '0', STR_PAD_LEFT) }}</div>
                            <div>
                                <h3>{{ $chapter->title }}</h3>
                                <p>{{ \Illuminate\Support\Str::limit(strip_tags($chapter->content), 145) }}</p>
                            </div>
                        </article>
                    @endforeach
                    @if($section->button_label)
                        <a class="btn soft" href="{{ $section->button_url ?: route('biography.index') }}">{{ $section->button_label }}</a>
                    @endif
                </div>
            </div>
        </div>
    </section>
