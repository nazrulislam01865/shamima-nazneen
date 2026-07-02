@props(['name', 'label', 'type' => 'text', 'value' => null, 'required' => false, 'help' => null, 'placeholder' => null, 'min' => null, 'max' => null, 'step' => null])
@php
    $errorKey = str_replace(['][', '[', ']'], ['.', '.', ''], $name);
    $inputId = preg_replace('/[^A-Za-z0-9_-]+/', '_', $errorKey);
    $errorId = $inputId.'_error';
    $hasError = $errors->has($errorKey);
@endphp
<div class="form-field {{ $hasError ? 'has-error' : '' }}" data-field-wrapper data-field-name="{{ $errorKey }}">
    <label for="{{ $inputId }}">{{ $label }} @if($required)<span class="required">*</span>@endif</label>
    <input
        id="{{ $inputId }}"
        name="{{ $name }}"
        type="{{ $type }}"
        value="{{ old($errorKey, $value) }}"
        @if($placeholder) placeholder="{{ $placeholder }}" @endif
        @if($required) required @endif
        @if(!is_null($min)) min="{{ $min }}" @endif
        @if(!is_null($max)) max="{{ $max }}" @endif
        @if(!is_null($step)) step="{{ $step }}" @endif
        @if($hasError) aria-invalid="true" aria-describedby="{{ $errorId }}" @endif
        {{ $attributes }}
    >
    @error($errorKey)<small id="{{ $errorId }}" class="field-error">{{ $message }}</small>@enderror
</div>
