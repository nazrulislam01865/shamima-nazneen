@if($workCategories->isNotEmpty())
<section class="works" id="works">
    <div class="container">
        <div class="section-head">
            @if($section->eyebrow)<div class="section-label">{{ $section->eyebrow }}</div>@endif
            <h2>{{ $section->title }}</h2>
            <div class="lead rich-content">{!! $section->description !!}</div>
        </div>
        <div class="card-grid">
            @foreach($workCategories as $category)
                <article class="work-card">
                    <div class="work-img">
                        <img src="{{ $category->home_image_url }}" alt="{{ \App\Support\MediaLibrary::altTextForPath($category->home_image_path, $category->home_title ?: $category->name) }}" data-fallback-text="{{ \App\Support\MediaLibrary::fallbackTextForPath($category->home_image_path, $siteSettings->image_fallback_text) }}">
                    </div>
                    <div class="work-body">
                        <h3>{{ $category->home_title ?: $category->name }}</h3>
                        <p>{{ $category->home_description ?: $category->description }}</p>
                        <div class="work-card-links">
                            @foreach($category->resolved_home_links as $link)
                                @php
                                    $isExternal = \Illuminate\Support\Str::startsWith($link['url'], ['http://', 'https://']);
                                @endphp
                                <a class="text-link" href="{{ $link['url'] }}" @if($isExternal) target="_blank" rel="noopener noreferrer" @endif>{{ $link['label'] }}</a>
                            @endforeach
                        </div>
                    </div>
                </article>
            @endforeach
        </div>
    </div>
</section>
@endif
