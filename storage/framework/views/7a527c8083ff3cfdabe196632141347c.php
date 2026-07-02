    <section id="biography">
        <div class="container">
            <div class="section-head">
                <?php if($section->eyebrow): ?><div class="section-label"><?php echo e($section->eyebrow); ?></div><?php endif; ?>
                <h2><?php echo e($section->title); ?></h2>
                <div class="lead rich-content"><?php echo $section->description; ?></div>
            </div>
            <div class="chapters">
                <div class="chapter-image" aria-label="Biography image">
                    <img src="<?php echo e($section->image_url ?: asset('assets/images/template/embedded-92827328aada.png')); ?>" alt="<?php echo e(\App\Support\MediaLibrary::altTextForPath($section->image_path, $section->title)); ?>" data-fallback-text="<?php echo e(\App\Support\MediaLibrary::fallbackTextForPath($section->image_path, $siteSettings->image_fallback_text)); ?>">
                </div>
                <div class="chapter-list">
                    <?php $__currentLoopData = $homeBiographySections; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $chapter): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <article class="chapter">
                            <div class="num"><?php echo e(str_pad((string) $loop->iteration, 2, '0', STR_PAD_LEFT)); ?></div>
                            <div>
                                <h3><?php echo e($chapter->title); ?></h3>
                                <p><?php echo e(\Illuminate\Support\Str::limit(strip_tags($chapter->content), 145)); ?></p>
                            </div>
                        </article>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php if($section->button_label): ?>
                        <a class="btn soft" href="<?php echo e($section->button_url ?: route('biography.index')); ?>"><?php echo e($section->button_label); ?></a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </section>
<?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/laravel/shamima-nazneen/resources/views/frontend/home-sections/biography.blade.php ENDPATH**/ ?>