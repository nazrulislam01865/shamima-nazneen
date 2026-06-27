@if($testimonials->isNotEmpty())
<section class="audience" id="audience">
        <div class="container love-grid">
            <div>
                @if($section->eyebrow)<div class="section-label">{{ $section->eyebrow }}</div>@endif
                <h2>{{ $section->title }}</h2>
                <div class="lead rich-content">{!! $section->description !!}</div>
                @if(filled($social['facebook'] ?? null))
                    @php
                        $facebookLinkIsExternal = \Illuminate\Support\Str::startsWith($social['facebook'], ['http://', 'https://']);
                    @endphp
                    <a class="btn dark" href="{{ $social['facebook'] }}" @if($facebookLinkIsExternal) target="_blank" rel="noopener noreferrer" @endif>Visit Facebook Page</a>
                @endif
            </div>
            <div class="testimonial-slider" data-testimonial-slider aria-label="Audience testimonials">
                <div class="testimonial-track">
                    @foreach($testimonials as $testimonial)
                        <article class="quote-card testimonial-slide {{ $loop->first ? 'active' : '' }}" data-testimonial-slide aria-hidden="{{ $loop->first ? 'false' : 'true' }}">
                            <p>“{{ $testimonial->quote }}”</p>
                            <small>{{ $testimonial->author ?: $testimonial->source }}</small>
                        </article>
                    @endforeach
                </div>
                @if($testimonials->count() > 1)
                    <div class="testimonial-controls">
                        <button type="button" data-testimonial-prev aria-label="Previous testimonial">←</button>
                        <div class="testimonial-dots" aria-label="Choose testimonial">
                            @foreach($testimonials as $testimonial)
                                <button type="button" class="{{ $loop->first ? 'active' : '' }}" data-testimonial-dot="{{ $loop->index }}" aria-label="Show testimonial {{ $loop->iteration }}"></button>
                            @endforeach
                        </div>
                        <button type="button" data-testimonial-next aria-label="Next testimonial">→</button>
                    </div>
                @endif
            </div>
        </div>
    </section>
@endif
