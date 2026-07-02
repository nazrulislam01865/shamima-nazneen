@props(['name', 'label', 'value' => null, 'required' => false, 'help' => null, 'rows' => 5, 'placeholder' => null])
@php
    $errorKey = str_replace(['][', '[', ']'], ['.', '.', ''], $name);
    $inputId = preg_replace('/[^A-Za-z0-9_-]+/', '_', $errorKey);
    $errorId = $inputId.'_error';
    $hasError = $errors->has($errorKey);
@endphp
<div class="form-field {{ $hasError ? 'has-error' : '' }}" data-field-wrapper data-field-name="{{ $errorKey }}">
    <label for="{{ $inputId }}">{{ $label }} @if($required)<span class="required">*</span>@endif</label>
    <textarea id="{{ $inputId }}" name="{{ $name }}" rows="{{ $rows }}" @if($placeholder) placeholder="{{ $placeholder }}" @endif @if($required) required @endif @if($hasError) aria-invalid="true" aria-describedby="{{ $errorId }}" @endif {{ $attributes }}>{{ old($errorKey, $value) }}</textarea>
    @error($errorKey)<small id="{{ $errorId }}" class="field-error">{{ $message }}</small>@enderror
</div>
