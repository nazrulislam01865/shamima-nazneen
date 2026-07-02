<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames((['title' => 'Nothing here yet', 'description' => null, 'action' => null, 'actionLabel' => 'Add New']));

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

foreach (array_filter((['title' => 'Nothing here yet', 'description' => null, 'action' => null, 'actionLabel' => 'Add New']), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars, $__key, $__value); ?>
<div class="admin-empty">
    <div class="admin-empty-icon">＋</div>
    <h3><?php echo e($title); ?></h3>
    <?php if($description): ?><p><?php echo e($description); ?></p><?php endif; ?>
    <?php if($action): ?><a class="admin-button primary" href="<?php echo e($action); ?>"><?php echo e($actionLabel); ?></a><?php endif; ?>
</div>
<?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/laravel/shamima-nazneen/resources/views/components/admin/empty.blade.php ENDPATH**/ ?>