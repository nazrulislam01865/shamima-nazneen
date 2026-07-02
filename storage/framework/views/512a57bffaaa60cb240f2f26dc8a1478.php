<?php
    $buttonClass = $buttonClass ?? 'work-link';
    $buttonLabel = $buttonLabel ?? 'View Details';
?>
<button class="<?php echo e($buttonClass); ?> work-detail-trigger"
        type="button"
        data-title="<?php echo e($work->title); ?>"
        data-year="<?php echo e($work->year ?: ''); ?>"
        data-type="<?php echo e($work->category->name); ?>"
        data-credit="<?php echo e($work->credit); ?>"
        data-role="<?php echo e($work->role); ?>"
        data-platform="<?php echo e($work->platform); ?>"
        data-image="<?php echo e($work->image_url); ?>"
        data-image-fallback="<?php echo e(\App\Support\MediaLibrary::fallbackTextForPath($work->image_path, $siteSettings->image_fallback_text)); ?>"><?php echo e($buttonLabel); ?></button>
<template data-work-description><?php echo $work->short_description; ?></template>
<template data-work-links>
    <?php $__currentLoopData = $work->resolved_external_links; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $link): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <?php
            $externalLink = \Illuminate\Support\Str::startsWith($link['url'], ['http://', 'https://']);
        ?>
        <a href="<?php echo e($link['url']); ?>" <?php if($externalLink): ?> target="_blank" rel="noopener noreferrer" <?php endif; ?>><?php echo e($link['label']); ?></a>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</template>
<?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/laravel/shamima-nazneen/resources/views/frontend/partials/work-detail-button.blade.php ENDPATH**/ ?>