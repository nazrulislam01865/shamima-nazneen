@props([
    'name',
    'label',
    'value' => null,
    'required' => false,
    'help' => null,
    'placeholder' => null,
    'imageUploadUrl' => null,
])
@php
    $editorValue = \App\Support\RichTextSanitizer::clean(old($name, $value)) ?? '';
    $resolvedPlaceholder = $placeholder;
@endphp
<div
    class="form-field rich-text-field {{ $errors->has($name) ? 'has-error' : '' }}"
    data-rich-editor
    data-rich-required="{{ $required ? '1' : '0' }}"
    @if($imageUploadUrl) data-rich-image-upload-url="{{ $imageUploadUrl }}" @endif
>
    <label for="{{ $name }}">{{ $label }} @if($required)<span class="required">*</span>@endif</label>
    <div class="rich-toolbar" role="toolbar" aria-label="Text formatting">
        <button type="button" data-command="bold" title="Bold"><strong>B</strong></button>
        <button type="button" data-command="italic" title="Italic"><em>I</em></button>
        <button type="button" data-command="underline" title="Underline"><u>U</u></button>
        <button type="button" data-command="formatBlock" data-value="p">Paragraph</button>
        <button type="button" data-command="formatBlock" data-value="h3">Heading</button>
        <button type="button" data-command="insertUnorderedList">• List</button>
        <button type="button" data-command="insertOrderedList">1. List</button>
        <button type="button" data-command="createLink">Link</button>
        @if($imageUploadUrl)
            <button type="button" data-rich-image-button title="Upload and insert an image">Image</button>
            <input type="file" accept="image/jpeg,image/png,image/webp" data-rich-image-input hidden>
        @endif
        <button type="button" data-command="removeFormat">Clear</button>
    </div>
    <div class="rich-editor" contenteditable="true" role="textbox" aria-multiline="true" aria-required="{{ $required ? 'true' : 'false' }}" aria-label="{{ $label }}" data-rich-content>{!! $editorValue !!}</div>
    <textarea id="{{ $name }}" name="{{ $name }}" class="rich-hidden">{{ $editorValue }}</textarea>
    @error($name)<small class="field-error">{{ $message }}</small>@enderror
</div>
