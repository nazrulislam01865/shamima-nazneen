<?php if($filmWorks->isNotEmpty()): ?>
<section id="films">
        <div class="container">
            <div class="section-head">
                <?php if($section->eyebrow): ?><div class="section-label"><?php echo e($section->eyebrow); ?></div><?php endif; ?>
                <h2><?php echo e($section->title); ?></h2>
                <div class="lead rich-content"><?php echo $section->description; ?></div>
            </div>
            <div class="films-wrap">
                <?php $__currentLoopData = $filmWorks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $work): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <article class="film-card">
                        <div class="bg">
                            <?php if($work->image_url): ?>
                                <img src="<?php echo e($work->image_url); ?>" alt="<?php echo e(\App\Support\MediaLibrary::altTextForPath($work->image_path, $work->title)); ?>" data-fallback-text="<?php echo e(\App\Support\MediaLibrary::fallbackTextForPath($work->image_path, $siteSettings->image_fallback_text)); ?>">
                            <?php else: ?>
                                <span class="media-fallback film-background-fallback is-visible"><?php echo e(\App\Support\MediaLibrary::fallbackTextForPath($work->image_path, $siteSettings->image_fallback_text)); ?></span>
                            <?php endif; ?>
                        </div>
                        <div class="film-content">
                            <div class="film-year"><?php echo e($work->year); ?></div>
                            <h3><?php echo e($work->title); ?></h3>
                            <p><?php echo e(\Illuminate\Support\Str::limit(strip_tags($work->short_description), 90)); ?></p>
                            <?php echo $__env->make('frontend.partials.work-detail-button', [
                                'work' => $work,
                                'buttonClass' => 'inline-detail-button',
                                'buttonLabel' => 'View Details',
                            ], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                        </div>
                    </article>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
            <p style="margin-top:28px"><a class="btn dark" href="<?php echo e($section->button_url ?: route('works.index', ['category' => 'films'])); ?>"><?php echo e($section->button_label ?: 'View All Films'); ?></a></p>
        </div>
    </section>
<?php endif; ?>
<?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/laravel/shamima-nazneen/resources/views/frontend/home-sections/films.blade.php ENDPATH**/ ?>