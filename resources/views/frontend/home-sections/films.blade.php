@if($filmWorks->isNotEmpty())
<section id="films">
        <div class="container">
            <div class="section-head">
                @if($section->eyebrow)<div class="section-label">{{ $section->eyebrow }}</div>@endif
                <h2>{{ $section->title }}</h2>
                <div class="lead rich-content">{!! $section->description !!}</div>
            </div>
            <div class="films-wrap">
                @foreach($filmWorks as $work)
                    <article class="film-card">
                        <div class="bg">
                            @if($work->image_url)
                                <img src="{{ $work->image_url }}" alt="{{ \App\Support\MediaLibrary::altTextForPath($work->image_path, $work->title) }}" data-fallback-text="{{ \App\Support\MediaLibrary::fallbackTextForPath($work->image_path, $siteSettings->image_fallback_text) }}">
                            @else
                                <span class="media-fallback film-background-fallback is-visible">{{ \App\Support\MediaLibrary::fallbackTextForPath($work->image_path, $siteSettings->image_fallback_text) }}</span>
                            @endif
                        </div>
                        <div class="film-content">
                            <div class="film-year">{{ $work->year }}</div>
                            <h3>{{ $work->title }}</h3>
                            <p>{{ \Illuminate\Support\Str::limit(strip_tags($work->short_description), 90) }}</p>
                            @include('frontend.partials.work-detail-button', [
                                'work' => $work,
                                'buttonClass' => 'inline-detail-button',
                                'buttonLabel' => 'View Details',
                            ])
                        </div>
                    </article>
                @endforeach
            </div>
            <p style="margin-top:28px"><a class="btn dark" href="{{ $section->button_url ?: route('works.index', ['category' => 'films']) }}">{{ $section->button_label ?: 'View All Films' }}</a></p>
        </div>
    </section>
@endif
