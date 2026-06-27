@php
    $inputId = str_replace(['[', ']'], '_', $name);
    $selectedValue = old($name, $selectedId);
    $selectedItem = $items->firstWhere('id', (int) $selectedValue);
    $previewUrl = $selectedItem?->image_url ?: $currentUrl;
    $previewTitle = $selectedItem?->title ?: ($currentUrl ? 'Current uploaded image' : 'No image selected');
    $previewAlt = $selectedItem?->alt_text ?: $previewTitle;
@endphp
<div class="form-field media-picker-field {{ $attributes->get('class') }}" data-media-picker data-current-url="{{ $currentUrl }}" data-current-title="{{ $currentUrl ? 'Current uploaded image' : 'No image selected' }}" data-current-alt="{{ $currentUrl ? 'Current uploaded image' : 'No image selected' }}">
    <label for="{{ $inputId }}">{{ $label }}</label>
    <input id="{{ $inputId }}" type="hidden" name="{{ $name }}" value="{{ $selectedValue }}" data-media-picker-input>

    <div class="media-picker-preview" data-media-picker-preview @class(['has-image' => filled($previewUrl)])>
        @if($previewUrl)
            <img src="{{ $previewUrl }}" alt="{{ $previewAlt }}" data-media-picker-preview-image>
        @else
            <span data-media-picker-empty>No image selected yet.</span>
        @endif
        <div>
            <strong data-media-picker-preview-title>{{ $previewTitle }}</strong>
        </div>
    </div>

    <div class="media-picker-toolbar">
        <button class="admin-button secondary small" type="button" data-media-picker-clear>Do not change / use uploaded image below</button>
    </div>

    @if($items->isNotEmpty())
        <div class="media-picker-grid" role="listbox" aria-label="{{ $label }}">
            @foreach($items as $mediaItem)
                @php
                    $isSelected = (string) $selectedValue === (string) $mediaItem->id;
                    $meta = collect([$mediaItem->category, $mediaItem->year])->filter()->join(' · ');
                @endphp
                <button class="media-picker-card {{ $isSelected ? 'is-selected' : '' }}" type="button" role="option" aria-selected="{{ $isSelected ? 'true' : 'false' }}" data-media-picker-card data-media-id="{{ $mediaItem->id }}" data-media-title="{{ $mediaItem->title }}" data-media-alt="{{ $mediaItem->alt_text ?: $mediaItem->title }}" data-media-url="{{ $mediaItem->image_url }}">
                    <span class="media-picker-thumb">
                        <img src="{{ $mediaItem->image_url }}" alt="{{ $mediaItem->alt_text ?: $mediaItem->title }}" loading="lazy" data-fallback-text="{{ $mediaItem->fallback_text ?: 'Image is not available.' }}">
                    </span>
                    <span class="media-picker-copy">
                        <strong>{{ $mediaItem->title }}</strong>
                        @if($meta)<small>{{ $meta }}</small>@endif
                    </span>
                </button>
            @endforeach
        </div>
    @else
        <div class="media-picker-empty">No gallery images are available yet. Upload a new image below first.</div>
    @endif

    @error($name)<small class="field-error">{{ $message }}</small>@enderror
</div>
