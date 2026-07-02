<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <title><?php echo $__env->yieldContent('title', $siteSettings->seo_title ?: $siteSettings->site_name); ?></title>
    <meta name="description" content="<?php echo $__env->yieldContent('meta_description', $siteSettings->seo_description); ?>">
    <?php if($siteSettings->favicon_url): ?>
        <link rel="icon" href="<?php echo e($siteSettings->favicon_url); ?>">
    <?php endif; ?>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@500;600;700&family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo e(asset('assets/css/'.trim($__env->yieldContent('page_css', 'home')).'.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('assets/css/site-overrides.css')); ?>">
    <?php echo $__env->yieldPushContent('styles'); ?>
</head>
<body data-image-fallback-text="<?php echo e($siteSettings->image_fallback_text ?: 'Image is not available.'); ?>">
    <?php echo $__env->make('frontend.partials.header', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

    <?php if(session('success')): ?>
        <div class="site-flash site-flash-success" role="status"><?php echo e(session('success')); ?></div>
    <?php endif; ?>

    <?php if($errors->any()): ?>
        <div class="site-flash site-flash-error validation-summary" role="alert" data-error-summary>
            <strong>Please correct the highlighted information.</strong>
            <p>Click an item below to go directly to the field that needs attention.</p>
            <ul>
                <?php $__currentLoopData = $errors->getMessages(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $field => $messages): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php $fieldId = preg_replace('/[^A-Za-z0-9_-]+/', '_', $field); ?>
                    <?php $__currentLoopData = $messages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $message): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li><a href="#<?php echo e($fieldId); ?>" data-error-link data-error-field="<?php echo e($field); ?>"><?php echo e($message); ?></a></li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
        </div>
    <?php endif; ?>

    <?php echo $__env->yieldContent('content'); ?>

    <?php echo $__env->make('frontend.partials.footer', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

    <script src="<?php echo e(asset('assets/js/site.js')); ?>" defer></script>
    <?php echo $__env->yieldPushContent('scripts'); ?>
</body>
</html>
<?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/laravel/shamima-nazneen/resources/views/layouts/frontend.blade.php ENDPATH**/ ?>