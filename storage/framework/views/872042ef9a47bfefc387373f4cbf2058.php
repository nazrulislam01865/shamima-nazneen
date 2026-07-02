<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames(([
    'name',
    'label',
    'value' => null,
    'required' => false,
    'help' => null,
    'placeholder' => null,
    'imageUploadUrl' => null,
]));

foreach ($attributes->all() as $__key => $__value) {
    if (in_array($__key, $__propNames)) {
        $$__key = $$__key ?? $__value;
    } else {
        $__newAttributes[$__key] = $__value;
    }
}

$attributes = new \Illuminate\View\ComponentAttributeBag($__newAttributes);

unset($__propNames);
unset($__newAttributes);

foreach (array_filter(([
    'name',
    'label',
    'value' => null,
    'required' => false,
    'help' => null,
    'placeholder' => null,
    'imageUploadUrl' => null,
]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars, $__key, $__value); ?>
<?php
    $errorKey = str_replace(['][', '[', ']'], ['.', '.', ''], $name);
    $inputId = preg_replace('/[^A-Za-z0-9_-]+/', '_', $errorKey);
    $errorId = $inputId.'_error';
    $hasError = $errors->has($errorKey);
    $editorValue = \App\Support\RichTextSanitizer::clean(old($errorKey, $value)) ?? '';
?>
<div
    class="form-field rich-text-field <?php echo e($hasError ? 'has-error' : ''); ?>"
    data-rich-editor
    data-field-wrapper
    data-field-name="<?php echo e($errorKey); ?>"
    data-rich-required="<?php echo e($required ? '1' : '0'); ?>"
    <?php if($imageUploadUrl): ?> data-rich-image-upload-url="<?php echo e($imageUploadUrl); ?>" <?php endif; ?>
>
    <label for="<?php echo e($inputId); ?>"><?php echo e($label); ?> <?php if($required): ?><span class="required">*</span><?php endif; ?></label>
    <div class="rich-toolbar" role="toolbar" aria-label="Text formatting">
        <button type="button" data-command="bold" title="Bold"><strong>B</strong></button>
        <button type="button" data-command="italic" title="Italic"><em>I</em></button>
        <button type="button" data-command="underline" title="Underline"><u>U</u></button>
        <button type="button" data-command="formatBlock" data-value="p">Paragraph</button>
        <button type="button" data-command="formatBlock" data-value="h3">Heading</button>
        <button type="button" data-command="insertUnorderedList">• List</button>
        <button type="button" data-command="insertOrderedList">1. List</button>
        <button type="button" data-command="createLink">Link</button>
        <?php if($imageUploadUrl): ?>
            <button type="button" data-rich-image-button title="Upload and insert an image">Image</button>
            <input type="file" accept="image/jpeg,image/png,image/webp" data-rich-image-input hidden>
        <?php endif; ?>
        <button type="button" data-command="removeFormat">Clear</button>
    </div>
    <div class="rich-editor" contenteditable="true" role="textbox" aria-multiline="true" aria-required="<?php echo e($required ? 'true' : 'false'); ?>" aria-label="<?php echo e($label); ?>" data-rich-content <?php if($hasError): ?> aria-invalid="true" aria-describedby="<?php echo e($errorId); ?>" <?php endif; ?>><?php echo $editorValue; ?></div>
    <textarea id="<?php echo e($inputId); ?>" name="<?php echo e($name); ?>" class="rich-hidden"><?php echo e($editorValue); ?></textarea>
    <?php $__errorArgs = [$errorKey];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><small id="<?php echo e($errorId); ?>" class="field-error"><?php echo e($message); ?></small><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
</div>
<?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/laravel/shamima-nazneen/resources/views/components/admin/rich-text.blade.php ENDPATH**/ ?>