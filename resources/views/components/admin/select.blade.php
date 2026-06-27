@props(['name', 'label', 'options' => [], 'value' => null, 'required' => false, 'placeholder' => null, 'help' => null])
@php
    $resolvedPlaceholder = $placeholder;
@endphp
<div class="form-field {{ $errors->has($name) ? 'has-error' : '' }}">
    <label for="{{ $name }}">{{ $label }} @if($required)<span class="required">*</span>@endif</label>
    <select id="{{ $name }}" name="{{ $name }}" @if($required) required @endif {{ $attributes }}>
        @if(!is_null($resolvedPlaceholder))<option value=""></option>@endif
        @foreach($options as $optionValue => $optionLabel)
            <option value="{{ $optionValue }}" @selected((string) old($name, $value) === (string) $optionValue)>{{ $optionLabel }}</option>
        @endforeach
    </select>
    @error($name)<small class="field-error">{{ $message }}</small>@enderror
</div>
