<?php if($testimonials->isNotEmpty()): ?>
<section class="audience" id="audience">
        <div class="container love-grid">
            <div>
                <?php if($section->eyebrow): ?><div class="section-label"><?php echo e($section->eyebrow); ?></div><?php endif; ?>
                <h2><?php echo e($section->title); ?></h2>
                <div class="lead rich-content"><?php echo $section->description; ?></div>
                <?php if(filled($social['facebook'] ?? null)): ?>
                    <?php
                        $facebookLinkIsExternal = \Illuminate\Support\Str::startsWith($social['facebook'], ['http://', 'https://']);
                    ?>
                    <a class="btn dark" href="<?php echo e($social['facebook']); ?>" <?php if($facebookLinkIsExternal): ?> target="_blank" rel="noopener noreferrer" <?php endif; ?>>Visit Facebook Page</a>
                <?php endif; ?>
            </div>
            <div class="testimonial-slider" data-testimonial-slider aria-label="Audience testimonials">
                <div class="testimonial-track">
                    <?php $__currentLoopData = $testimonials; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $testimonial): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <article class="quote-card testimonial-slide <?php echo e($loop->first ? 'active' : ''); ?>" data-testimonial-slide aria-hidden="<?php echo e($loop->first ? 'false' : 'true'); ?>">
                            <p>“<?php echo e($testimonial->quote); ?>”</p>
                            <small><?php echo e($testimonial->author ?: $testimonial->source); ?></small>
                        </article>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
                <?php if($testimonials->count() > 1): ?>
                    <div class="testimonial-controls">
                        <button type="button" data-testimonial-prev aria-label="Previous testimonial">←</button>
                        <div class="testimonial-dots" aria-label="Choose testimonial">
                            <?php $__currentLoopData = $testimonials; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $testimonial): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <button type="button" class="<?php echo e($loop->first ? 'active' : ''); ?>" data-testimonial-dot="<?php echo e($loop->index); ?>" aria-label="Show testimonial <?php echo e($loop->iteration); ?>"></button>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                        <button type="button" data-testimonial-next aria-label="Next testimonial">→</button>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </section>
<?php endif; ?>
<?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/laravel/shamima-nazneen/resources/views/frontend/home-sections/audience.blade.php ENDPATH**/ ?>