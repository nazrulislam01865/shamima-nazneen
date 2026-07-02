<?php if($workCategories->isNotEmpty()): ?>
<section class="works" id="works">
    <div class="container">
        <div class="section-head">
            <?php if($section->eyebrow): ?><div class="section-label"><?php echo e($section->eyebrow); ?></div><?php endif; ?>
            <h2><?php echo e($section->title); ?></h2>
            <div class="lead rich-content"><?php echo $section->description; ?></div>
        </div>
        <div class="card-grid">
            <?php $__currentLoopData = $workCategories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <article class="work-card">
                    <div class="work-img <?php echo e($category->home_image_url ? '' : 'work-img-empty'); ?>">
                        <?php if($category->home_image_url): ?>
                            <img src="<?php echo e($category->home_image_url); ?>" alt="<?php echo e(\App\Support\MediaLibrary::altTextForPath($category->home_image_path, $category->home_title ?: $category->name)); ?>" data-fallback-text="<?php echo e(\App\Support\MediaLibrary::fallbackTextForPath($category->home_image_path, $siteSettings->image_fallback_text)); ?>">
                        <?php else: ?>
                            <span class="work-img-placeholder"><?php echo e($siteSettings->image_fallback_text ?: 'Image is not available.'); ?></span>
                        <?php endif; ?>
                    </div>
                    <div class="work-body">
                        <h3><?php echo e($category->home_title ?: $category->name); ?></h3>
                        <p><?php echo e($category->home_description ?: $category->description); ?></p>
                        <div class="work-card-links">
                            <?php $__currentLoopData = $category->resolved_home_links; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $link): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php
                                    $isExternal = \Illuminate\Support\Str::startsWith($link['url'], ['http://', 'https://']);
                                ?>
                                <a class="text-link" href="<?php echo e($link['url']); ?>" <?php if($isExternal): ?> target="_blank" rel="noopener noreferrer" <?php endif; ?>><?php echo e($link['label']); ?></a>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    </div>
                </article>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>
</section>
<?php endif; ?>
<?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/laravel/shamima-nazneen/resources/views/frontend/home-sections/works.blade.php ENDPATH**/ ?>