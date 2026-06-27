@props(['name' => 'image', 'label' => 'Image', 'current' => null, 'required' => false, 'help' => null, 'removeName' => 'remove_image'])
<div class="form-field image-upload-field {{ $errors->has($name) ? 'has-error' : '' }}" data-image-upload>
    <label for="{{ $name }}">{{ $label }} @if($required)<span class="required">*</span>@endif</label>
    <div class="image-upload-box">
        <div class="image-preview {{ $current ? 'has-image' : '' }}" data-image-preview>
            @if($current)<img src="{{ $current }}" alt="Current {{ strtolower($label) }}">@else<span>No image selected</span>@endif
        </div>
        <div class="image-upload-actions">
            <input id="{{ $name }}" name="{{ $name }}" type="file" accept="image/png,image/jpeg,image/webp,image/svg+xml,image/x-icon" data-image-input @if($required && !$current) required @endif>
            @if($current)
                <label class="remove-file"><input type="checkbox" name="{{ $removeName }}" value="1"> Remove current file</label>
            @endif
        </div>
    </div>
    @error($name)<small class="field-error">{{ $message }}</small>@enderror
</div>
