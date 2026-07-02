@php
    $errorKey = str_replace(['][', '[', ']'], ['.', '.', ''], $name);
    $inputId = preg_replace('/[^A-Za-z0-9_-]+/', '_', $errorKey);
    $errorId = $inputId.'_error';
    $hasError = $errors->has($errorKey);
    $selectedValue = old($errorKey, $selectedId);
    $selectedItem = $items->firstWhere('id', (int) $selectedValue);
    $previewUrl = $selectedItem?->image_url ?: $currentUrl;
    $previewTitle = $selectedItem?->title ?: ($currentUrl ? 'Current uploaded image' : 'No '.($typeLabel ?? 'image').' selected');
    $previewAlt = $selectedItem?->alt_text ?: $previewTitle;
@endphp
<div class="form-field media-picker-field {{ $hasError ? 'has-error' : '' }} {{ $attributes->get('class') }}" data-media-picker data-media-kind="{{ $typeLabel ?? 'image' }}" data-field-wrapper data-field-name="{{ $errorKey }}" data-current-url="{{ $currentUrl }}" data-current-title="{{ $currentUrl ? 'Current uploaded image' : 'No '.($typeLabel ?? 'image').' selected' }}" data-current-alt="{{ $currentUrl ? 'Current uploaded image' : 'No '.($typeLabel ?? 'image').' selected' }}">
    <label for="{{ $inputId }}">{{ $label }}</label>
    <input id="{{ $inputId }}" type="hidden" name="{{ $name }}" value="{{ $selectedValue }}" data-media-picker-input @if($hasError) aria-invalid="true" aria-describedby="{{ $errorId }}" @endif>

    <div class="media-picker-preview" data-media-picker-preview @class(['has-image' => filled($previewUrl)])>
        @if($previewUrl)
            <img src="{{ $previewUrl }}" alt="{{ $previewAlt }}" data-media-picker-preview-image>
        @else
            <span data-media-picker-empty>No {{ $typeLabel ?? 'image' }} selected yet.</span>
        @endif
        <div>
            <strong data-media-picker-preview-title>{{ $previewTitle }}</strong>
        </div>
    </div>

    <div class="media-picker-toolbar">
        <button class="admin-button secondary small" type="button" data-media-picker-clear>Do not change / use uploaded file below</button>
    </div>

    @if($items->isNotEmpty())
        <div class="media-picker-grid" role="listbox" aria-label="{{ $label }}">
            @foreach($items as $mediaItem)
                @php
                    $isSelected = (string) $selectedValue === (string) $mediaItem->id;
                    $meta = collect([$mediaItem->category, $mediaItem->year])->filter()->join(' · ');
                    $thumb = $mediaItem->image_url;
                    $cardAlt = $mediaItem->alt_text ?: $mediaItem->title;
                @endphp
                <button class="media-picker-card {{ $isSelected ? 'is-selected' : '' }}" type="button" role="option" aria-selected="{{ $isSelected ? 'true' : 'false' }}" data-media-picker-card data-media-id="{{ $mediaItem->id }}" data-media-title="{{ $mediaItem->title }}" data-media-alt="{{ $cardAlt }}" data-media-url="{{ $thumb }}">
                    <span class="media-picker-thumb">
                        @if($thumb)
                            <img src="{{ $thumb }}" alt="{{ $cardAlt }}" loading="lazy" data-fallback-text="{{ $mediaItem->fallback_text ?: 'Preview is not available.' }}">
                        @else
                            <span class="media-picker-thumb-empty">No preview</span>
                        @endif
                    </span>
                    <span class="media-picker-copy">
                        <strong>{{ $mediaItem->title }}</strong>
                        @if($meta)<small>{{ $meta }}</small>@endif
                    </span>
                </button>
            @endforeach
        </div>
    @else
        <div class="media-picker-empty">{{ $emptyMessage }}</div>
    @endif

    @error($errorKey)<small id="{{ $errorId }}" class="field-error">{{ $message }}</small>@enderror
</div>
