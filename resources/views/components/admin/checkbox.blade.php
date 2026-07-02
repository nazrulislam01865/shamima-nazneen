@props(['name', 'label', 'checked' => false, 'help' => null])
@php
    $errorKey = str_replace(['][', '[', ']'], ['.', '.', ''], $name);
    $inputId = preg_replace('/[^A-Za-z0-9_-]+/', '_', $errorKey);
    $errorId = $inputId.'_error';
    $hasError = $errors->has($errorKey);
@endphp
<div class="checkbox-field {{ $hasError ? 'has-error' : '' }}" data-field-wrapper data-field-name="{{ $errorKey }}">
    <label class="checkbox-card" for="{{ $inputId }}">
        <input type="hidden" name="{{ $name }}" value="0">
        <input id="{{ $inputId }}" type="checkbox" name="{{ $name }}" value="1" @checked((bool) old($errorKey, $checked)) @if($hasError) aria-invalid="true" aria-describedby="{{ $errorId }}" @endif {{ $attributes }}>
        <span class="checkbox-ui" aria-hidden="true"></span>
        <span><strong>{{ $label }}</strong></span>
    </label>
    @error($errorKey)<small id="{{ $errorId }}" class="field-error">{{ $message }}</small>@enderror
</div>
