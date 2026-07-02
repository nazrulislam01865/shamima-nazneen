    <section id="about">
        <div class="container about-grid">
            <div class="portrait-card">
                <img src="<?php echo e($section->image_url ?: asset('assets/images/template/embedded-2516360e304f.png')); ?>" alt="<?php echo e(\App\Support\MediaLibrary::altTextForPath($section->image_path, $section->title)); ?>" data-fallback-text="<?php echo e(\App\Support\MediaLibrary::fallbackTextForPath($section->image_path, $siteSettings->image_fallback_text)); ?>">
            </div>
            <div class="bio-copy">
                <?php if($section->eyebrow): ?><div class="section-label"><?php echo e($section->eyebrow); ?></div><?php endif; ?>
                <h2><?php echo e($section->title); ?></h2>
                <div class="rich-content"><?php echo $section->description; ?></div>
                <?php if($section->button_label): ?>
                    <a class="btn dark" href="<?php echo e($section->button_url ?: route('biography.index')); ?>"><?php echo e($section->button_label); ?></a>
                <?php endif; ?>
            </div>
        </div>
    </section>
<?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/laravel/shamima-nazneen/resources/views/frontend/home-sections/about.blade.php ENDPATH**/ ?>