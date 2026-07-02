<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames((['name' => 'image', 'label' => 'Image', 'current' => null, 'required' => false, 'help' => null, 'removeName' => 'remove_image']));

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

foreach (array_filter((['name' => 'image', 'label' => 'Image', 'current' => null, 'required' => false, 'help' => null, 'removeName' => 'remove_image']), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
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
?>
<div class="form-field image-upload-field <?php echo e($hasError ? 'has-error' : ''); ?>" data-image-upload data-field-wrapper data-field-name="<?php echo e($errorKey); ?>">
    <label for="<?php echo e($inputId); ?>"><?php echo e($label); ?> <?php if($required): ?><span class="required">*</span><?php endif; ?></label>
    <div class="image-upload-box">
        <div class="image-preview <?php echo e($current ? 'has-image' : ''); ?>" data-image-preview>
            <?php if($current): ?><img src="<?php echo e($current); ?>" alt="Current <?php echo e(strtolower($label)); ?>"><?php else: ?><span>No image selected</span><?php endif; ?>
        </div>
        <div class="image-upload-actions">
            <input id="<?php echo e($inputId); ?>" name="<?php echo e($name); ?>" type="file" accept="image/png,image/jpeg,image/webp,image/svg+xml,image/x-icon" data-image-input <?php if($required && !$current): ?> required <?php endif; ?> <?php if($hasError): ?> aria-invalid="true" aria-describedby="<?php echo e($errorId); ?>" <?php endif; ?>>
            <?php if($current): ?>
                <label class="remove-file"><input type="checkbox" name="<?php echo e($removeName); ?>" value="1"> Remove current file</label>
            <?php endif; ?>
        </div>
    </div>
    <?php $__errorArgs = [$errorKey];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><small id="<?php echo e($errorId); ?>" class="field-error"><?php echo e($message); ?></small><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
</div>
<?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/laravel/shamima-nazneen/resources/views/components/admin/image-upload.blade.php ENDPATH**/ ?>