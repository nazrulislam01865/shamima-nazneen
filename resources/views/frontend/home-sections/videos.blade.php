@if($homeVideos->isNotEmpty())
<section class="videos" id="videos">
        <div class="container">
            <div class="section-head">
                @if($section->eyebrow)<div class="section-label">{{ $section->eyebrow }}</div>@endif
                <h2>{{ $section->title }}</h2>
                <div class="lead rich-content">{!! $section->description !!}</div>
            </div>
            <div class="video-grid">
                @foreach($homeVideos as $video)
                    @php
                        $watchUrl = $video->youtube_watch_url;
                        $relatedUrl = $video->link_url;
                        $showRelatedLink = filled($relatedUrl) && $relatedUrl !== $watchUrl;
                    @endphp
                    <article class="video-card {{ $loop->first || $video->is_featured ? 'feature' : '' }}">
                        <div class="video-thumb embedded-video-wrap">
                            <iframe src="{{ $video->embed_url }}" title="{{ $video->title }}" loading="lazy" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
                        </div>
                        <div class="video-info">
                            <h3><a href="{{ $video->youtube_watch_url }}" target="_blank" rel="noopener noreferrer">{{ $video->title }}</a></h3>
                            <p>{{ \Illuminate\Support\Str::limit(strip_tags($video->description), 120) }}</p>
                            @if($watchUrl)<a class="video-youtube-link" href="{{ $watchUrl }}" target="_blank" rel="noopener noreferrer">Watch on YouTube →</a>@endif
                            @if($showRelatedLink)<a class="video-youtube-link" href="{{ $relatedUrl }}" target="_blank" rel="noopener noreferrer">{{ $video->link_name ?: 'Open related link' }} →</a>@endif
                        </div>
                    </article>
                @endforeach
            </div>
            <p style="margin-top:28px"><a class="btn light" href="{{ $section->button_url ?: route('videos.index') }}">{{ $section->button_label ?: 'View More Videos' }}</a></p>
        </div>
    </section>
@endif
