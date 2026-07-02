<?php if($homeImages->isNotEmpty()): ?>
<section id="gallery">
        <div class="container">
            <div class="section-head">
                <?php if($section->eyebrow): ?><div class="section-label"><?php echo e($section->eyebrow); ?></div><?php endif; ?>
                <h2><?php echo e($section->title); ?></h2>
                <div class="lead rich-content"><?php echo $section->description; ?></div>
                <div class="categories">
                    <?php $__currentLoopData = $homeImages->pluck('category')->filter()->unique(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><span><?php echo e($category); ?></span><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
            <div class="gallery-grid">
                <?php $__currentLoopData = $homeImages->take(5); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $image): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <a class="gallery-item <?php echo e($loop->first ? 'large' : ''); ?>" href="<?php echo e(route('gallery.index')); ?>" aria-label="Open <?php echo e($image->title); ?> in gallery">
                        <img src="<?php echo e($image->image_url); ?>" alt="<?php echo e($image->alt_text ?: $image->title); ?>" data-fallback-text="<?php echo e($image->fallback_text ?: $siteSettings->image_fallback_text); ?>">
                        <?php if($image->category): ?><span class="tag"><?php echo e($image->category); ?></span><?php endif; ?>
                    </a>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
            <p style="margin-top:28px"><a class="btn soft" href="<?php echo e($section->button_url ?: route('gallery.index')); ?>"><?php echo e($section->button_label ?: 'View Full Gallery'); ?></a></p>
        </div>
    </section>
<?php endif; ?>
<?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/laravel/shamima-nazneen/resources/views/frontend/home-sections/gallery.blade.php ENDPATH**/ ?>