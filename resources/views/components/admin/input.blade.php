@props(['name', 'label', 'type' => 'text', 'value' => null, 'required' => false, 'help' => null, 'placeholder' => null, 'min' => null, 'max' => null, 'step' => null])
@php
    $supportsPlaceholder = in_array($type, ['text', 'email', 'url', 'tel', 'number', 'password', 'search', 'date'], true);
    $resolvedPlaceholder = $placeholder;
@endphp
<div class="form-field {{ $errors->has($name) ? 'has-error' : '' }}">
    <label for="{{ $name }}">{{ $label }} @if($required)<span class="required">*</span>@endif</label>
    <input id="{{ $name }}" name="{{ $name }}" type="{{ $type }}" value="{{ old($name, $value) }}" @if($required) required @endif @if(!is_null($min)) min="{{ $min }}" @endif @if(!is_null($max)) max="{{ $max }}" @endif @if(!is_null($step)) step="{{ $step }}" @endif {{ $attributes }}>
    @error($name)<small class="field-error">{{ $message }}</small>@enderror
</div>
