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
    $errorKey = str_replace(['][', '[', ']'], ['.', '.', ''], $name);
    $inputId = preg_replace('/[^A-Za-z0-9_-]+/', '_', $errorKey);
    $errorId = $inputId.'_error';
    $hasError = $errors->has($errorKey);
    $editorValue = \App\Support\RichTextSanitizer::clean(old($errorKey, $value)) ?? '';
@endphp
<div
    class="form-field rich-text-field {{ $hasError ? 'has-error' : '' }}"
    data-rich-editor
    data-field-wrapper
    data-field-name="{{ $errorKey }}"
    data-rich-required="{{ $required ? '1' : '0' }}"
    @if($imageUploadUrl) data-rich-image-upload-url="{{ $imageUploadUrl }}" @endif
>
    <label for="{{ $inputId }}">{{ $label }} @if($required)<span class="required">*</span>@endif</label>
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
    <div class="rich-editor" contenteditable="true" role="textbox" aria-multiline="true" aria-required="{{ $required ? 'true' : 'false' }}" aria-label="{{ $label }}" data-rich-content @if($hasError) aria-invalid="true" aria-describedby="{{ $errorId }}" @endif>{!! $editorValue !!}</div>
    <textarea id="{{ $inputId }}" name="{{ $name }}" class="rich-hidden">{{ $editorValue }}</textarea>
    @error($errorKey)<small id="{{ $errorId }}" class="field-error">{{ $message }}</small>@enderror
</div>
