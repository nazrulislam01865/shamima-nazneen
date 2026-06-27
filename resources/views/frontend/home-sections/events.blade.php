    <section id="events">
        <div class="container">
            <div class="section-head">
                @if($section->eyebrow)<div class="section-label">{{ $section->eyebrow }}</div>@endif
                <h2>{{ $section->title }}</h2>
                <div class="lead rich-content">{!! $section->description !!}</div>
            </div>
            @if($events->isNotEmpty())
                <div class="events-grid">
                    @foreach($events as $event)
                        @if($event->public_url)
                            @php
                                $eventLinkIsExternal = \Illuminate\Support\Str::startsWith($event->public_url, ['http://', 'https://']);
                            @endphp
                            <a class="event-chip" href="{{ $event->public_url }}" @if($eventLinkIsExternal) target="_blank" rel="noopener noreferrer" @endif>{{ $event->title }}</a>
                        @else
                            <div class="event-chip">{{ $event->title }}</div>
                        @endif
                    @endforeach
                </div>
            @endif
            @if($section->button_label)<p style="margin-top:28px"><a class="btn dark" href="{{ $section->button_url ?: '#contact' }}">{{ $section->button_label }}</a></p>@endif
        </div>
    </section>
