@props(['name', 'label', 'value' => null, 'required' => false, 'help' => null, 'rows' => 5, 'placeholder' => null])
@php
    $resolvedPlaceholder = $placeholder;
@endphp
<div class="form-field {{ $errors->has($name) ? 'has-error' : '' }}">
    <label for="{{ $name }}">{{ $label }} @if($required)<span class="required">*</span>@endif</label>
    <textarea id="{{ $name }}" name="{{ $name }}" rows="{{ $rows }}" @if($required) required @endif {{ $attributes }}>{{ old($name, $value) }}</textarea>
    @error($name)<small class="field-error">{{ $message }}</small>@enderror
</div>
