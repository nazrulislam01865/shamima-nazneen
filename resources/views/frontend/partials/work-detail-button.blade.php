@php
    $buttonClass = $buttonClass ?? 'work-link';
    $buttonLabel = $buttonLabel ?? 'View Details';
@endphp
<button class="{{ $buttonClass }} work-detail-trigger"
        type="button"
        data-title="{{ $work->title }}"
        data-year="{{ $work->year }}"
        data-type="{{ $work->category->name }}"
        data-credit="{{ $work->credit }}"
        data-role="{{ $work->role }}"
        data-platform="{{ $work->platform }}"
        data-image="{{ $work->image_url }}"
        data-image-fallback="{{ \App\Support\MediaLibrary::fallbackTextForPath($work->image_path, $siteSettings->image_fallback_text) }}">{{ $buttonLabel }}</button>
<template data-work-description>{!! $work->short_description !!}</template>
<template data-work-links>
    @foreach($work->resolved_external_links as $link)
        @php
            $externalLink = \Illuminate\Support\Str::startsWith($link['url'], ['http://', 'https://']);
        @endphp
        <a href="{{ $link['url'] }}" @if($externalLink) target="_blank" rel="noopener noreferrer" @endif>{{ $link['label'] }}</a>
    @endforeach
</template>
