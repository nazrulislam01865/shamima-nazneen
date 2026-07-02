@props(['name', 'label', 'options' => [], 'value' => null, 'required' => false, 'placeholder' => null, 'help' => null])
@php
    $errorKey = str_replace(['][', '[', ']'], ['.', '.', ''], $name);
    $inputId = preg_replace('/[^A-Za-z0-9_-]+/', '_', $errorKey);
    $errorId = $inputId.'_error';
    $hasError = $errors->has($errorKey);
    $resolvedPlaceholder = $placeholder;
@endphp
<div class="form-field {{ $hasError ? 'has-error' : '' }}" data-field-wrapper data-field-name="{{ $errorKey }}">
    <label for="{{ $inputId }}">{{ $label }} @if($required)<span class="required">*</span>@endif</label>
    <select id="{{ $inputId }}" name="{{ $name }}" @if($required) required @endif @if($hasError) aria-invalid="true" aria-describedby="{{ $errorId }}" @endif {{ $attributes }}>
        @if(!is_null($resolvedPlaceholder))<option value=""></option>@endif
        @foreach($options as $optionValue => $optionLabel)
            <option value="{{ $optionValue }}" @selected((string) old($errorKey, $value) === (string) $optionValue)>{{ $optionLabel }}</option>
        @endforeach
    </select>
    @error($errorKey)<small id="{{ $errorId }}" class="field-error">{{ $message }}</small>@enderror
</div>
