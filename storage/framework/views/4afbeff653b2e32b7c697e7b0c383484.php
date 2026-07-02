<?php
    $label = $defaultType === 'video' ? 'Video' : 'Image';
    $context = array_filter([
        'type' => $defaultType,
        'home' => ($defaultShowOnHome ?? false) ? 1 : null,
        'profiles' => ($defaultShowInProfiles ?? false) ? 1 : null,
        'gallery' => request()->boolean('gallery') ? 1 : null,
    ]);
?>
<?php $__env->startSection('title', 'Add '.$label); ?>
<?php $__env->startSection('page_title', $label.' Gallery'); ?>
<?php $__env->startSection('page_context', ($defaultShowInProfiles ?? false) ? 'Home Page' : 'Gallery Page'); ?>
<?php $__env->startSection('content'); ?>
<?php if (isset($component)) { $__componentOriginalcb19cb35a534439097b02b8af91726ee = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalcb19cb35a534439097b02b8af91726ee = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.admin.page-header','data' => ['title' => 'Add '.strtolower($label),'description' => $defaultType === 'video' ? 'Add a YouTube video to the separate Video Gallery.' : 'Upload an image to the separate Image Gallery.']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('admin.page-header'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute('Add '.strtolower($label)),'description' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($defaultType === 'video' ? 'Add a YouTube video to the separate Video Gallery.' : 'Upload an image to the separate Image Gallery.')]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalcb19cb35a534439097b02b8af91726ee)): ?>
<?php $attributes = $__attributesOriginalcb19cb35a534439097b02b8af91726ee; ?>
<?php unset($__attributesOriginalcb19cb35a534439097b02b8af91726ee); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalcb19cb35a534439097b02b8af91726ee)): ?>
<?php $component = $__componentOriginalcb19cb35a534439097b02b8af91726ee; ?>
<?php unset($__componentOriginalcb19cb35a534439097b02b8af91726ee); ?>
<?php endif; ?>
<form class="admin-form" action="<?php echo e(route('admin.media-items.store', $context)); ?>" method="POST" enctype="multipart/form-data" data-disable-on-submit>
    <?php echo csrf_field(); ?>
    <?php if(($defaultShowOnHome ?? false)): ?><input type="hidden" name="home" value="1"><?php endif; ?>
    <?php if(($defaultShowInProfiles ?? false)): ?><input type="hidden" name="profiles" value="1"><?php endif; ?>
    <?php if(request()->boolean('gallery')): ?><input type="hidden" name="gallery" value="1"><?php endif; ?>
    <?php echo $__env->make('admin.media-items._form', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
    <?php if (isset($component)) { $__componentOriginal661c5ca87570cde504c602ae668d3776 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal661c5ca87570cde504c602ae668d3776 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.admin.form-actions','data' => ['cancel' => route('admin.media-items.index', $context),'submit' => 'Create '.$label]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('admin.form-actions'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['cancel' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(route('admin.media-items.index', $context)),'submit' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute('Create '.$label)]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal661c5ca87570cde504c602ae668d3776)): ?>
<?php $attributes = $__attributesOriginal661c5ca87570cde504c602ae668d3776; ?>
<?php unset($__attributesOriginal661c5ca87570cde504c602ae668d3776); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal661c5ca87570cde504c602ae668d3776)): ?>
<?php $component = $__componentOriginal661c5ca87570cde504c602ae668d3776; ?>
<?php unset($__componentOriginal661c5ca87570cde504c602ae668d3776); ?>
<?php endif; ?>
</form>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/laravel/shamima-nazneen/resources/views/admin/media-items/create.blade.php ENDPATH**/ ?>