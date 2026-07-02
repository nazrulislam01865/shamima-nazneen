<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames((['name', 'label', 'options' => [], 'value' => null, 'required' => false, 'placeholder' => null, 'help' => null]));

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

foreach (array_filter((['name', 'label', 'options' => [], 'value' => null, 'required' => false, 'placeholder' => null, 'help' => null]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
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
    $resolvedPlaceholder = $placeholder;
?>
<div class="form-field <?php echo e($hasError ? 'has-error' : ''); ?>" data-field-wrapper data-field-name="<?php echo e($errorKey); ?>">
    <label for="<?php echo e($inputId); ?>"><?php echo e($label); ?> <?php if($required): ?><span class="required">*</span><?php endif; ?></label>
    <select id="<?php echo e($inputId); ?>" name="<?php echo e($name); ?>" <?php if($required): ?> required <?php endif; ?> <?php if($hasError): ?> aria-invalid="true" aria-describedby="<?php echo e($errorId); ?>" <?php endif; ?> <?php echo e($attributes); ?>>
        <?php if(!is_null($resolvedPlaceholder)): ?><option value=""></option><?php endif; ?>
        <?php $__currentLoopData = $options; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $optionValue => $optionLabel): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <option value="<?php echo e($optionValue); ?>" <?php if((string) old($errorKey, $value) === (string) $optionValue): echo 'selected'; endif; ?>><?php echo e($optionLabel); ?></option>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </select>
    <?php $__errorArgs = [$errorKey];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><small id="<?php echo e($errorId); ?>" class="field-error"><?php echo e($message); ?></small><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
</div>
<?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/laravel/shamima-nazneen/resources/views/components/admin/select.blade.php ENDPATH**/ ?>