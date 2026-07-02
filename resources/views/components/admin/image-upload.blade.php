@props(['name' => 'image', 'label' => 'Image', 'current' => null, 'required' => false, 'help' => null, 'removeName' => 'remove_image'])
@php
    $errorKey = str_replace(['][', '[', ']'], ['.', '.', ''], $name);
    $inputId = preg_replace('/[^A-Za-z0-9_-]+/', '_', $errorKey);
    $errorId = $inputId.'_error';
    $hasError = $errors->has($errorKey);
@endphp
<div class="form-field image-upload-field {{ $hasError ? 'has-error' : '' }}" data-image-upload data-field-wrapper data-field-name="{{ $errorKey }}">
    <label for="{{ $inputId }}">{{ $label }} @if($required)<span class="required">*</span>@endif</label>
    <div class="image-upload-box">
        <div class="image-preview {{ $current ? 'has-image' : '' }}" data-image-preview>
            @if($current)<img src="{{ $current }}" alt="Current {{ strtolower($label) }}">@else<span>No image selected</span>@endif
        </div>
        <div class="image-upload-actions">
            <input id="{{ $inputId }}" name="{{ $name }}" type="file" accept="image/png,image/jpeg,image/webp,image/svg+xml,image/x-icon" data-image-input @if($required && !$current) required @endif @if($hasError) aria-invalid="true" aria-describedby="{{ $errorId }}" @endif>
            @if($current)
                <label class="remove-file"><input type="checkbox" name="{{ $removeName }}" value="1"> Remove current file</label>
            @endif
        </div>
    </div>
    @error($errorKey)<small id="{{ $errorId }}" class="field-error">{{ $message }}</small>@enderror
</div>
