<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames((['cancel', 'submit' => 'Save Changes']));

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

foreach (array_filter((['cancel', 'submit' => 'Save Changes']), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars, $__key, $__value); ?>
<div class="form-actions">
    <a class="admin-button secondary" href="<?php echo e($cancel); ?>">Cancel</a>
    <button class="admin-button primary" type="submit" data-submit-button><?php echo e($submit); ?></button>
</div>
<?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/laravel/shamima-nazneen/resources/views/components/admin/form-actions.blade.php ENDPATH**/ ?>