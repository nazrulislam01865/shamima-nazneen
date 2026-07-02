<?php $__env->startSection('title', $siteSettings->seo_title ?: $siteSettings->site_name); ?>
<?php $__env->startSection('meta_description', $siteSettings->seo_description); ?>
<?php $__env->startSection('page_css', 'home'); ?>

<?php $__env->startSection('content'); ?>
<?php
    $social = $siteSettings->social_links ?? [];
    $homeFollowLinks = collect($siteSettings->profile_card_links ?? [])
        ->filter(fn ($link) => filled($link['title'] ?? null) && filled($link['url'] ?? null))
        ->values();
    $hasHomeFollowLinks = $homeFollowLinks->isNotEmpty() || collect($social)->filter()->isNotEmpty();
?>
<main id="home">
    <section class="hero" aria-label="Hero image slider">
        <div class="slider dynamic-slider" data-slider>
            <?php $__empty_1 = true; $__currentLoopData = $slides; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $slide): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <?php
                    $slideSettings = $slide->settings ?? [];
                    $alignment = $slideSettings['text_alignment'] ?? 'left';
                    $vertical = $slideSettings['vertical_position'] ?? 'bottom';
                    $textColor = $slideSettings['text_color'] ?? '#FFFFFF';
                    $overlayOpacity = max(0, min(80, (int) ($slideSettings['overlay_opacity'] ?? 28))) / 100;
                    $titleSize = max(32, min(110, (int) ($slideSettings['title_size'] ?? 76)));
                    $subtitleSize = max(12, min(36, (int) ($slideSettings['subtitle_size'] ?? 18)));
                ?>
                <div class="slide <?php echo e($loop->first ? 'active' : ''); ?>" data-slide data-safe-background="<?php echo e($slide->image_url); ?>">
                    <span class="media-fallback hero-background-fallback" data-background-fallback><?php echo e(\App\Support\MediaLibrary::fallbackTextForPath($slide->image_path, $siteSettings->image_fallback_text)); ?></span>
                    <span class="hero-slide-overlay" style="background:rgba(0,0,0,<?php echo e($overlayOpacity); ?>)" aria-hidden="true"></span>
                    <?php if($slide->title || $slide->subtitle): ?>
                        <div class="hero-slide-content container align-<?php echo e($alignment); ?> vertical-<?php echo e($vertical); ?>" style="--hero-text-color:<?php echo e($textColor); ?>;--hero-title-size:<?php echo e($titleSize); ?>px;--hero-subtitle-size:<?php echo e($subtitleSize); ?>px">
                            <div class="hero-slide-copy">
                                <?php if($slide->title): ?><h1><?php echo e($slide->title); ?></h1><?php endif; ?>
                                <?php if($slide->subtitle): ?><p><?php echo e($slide->subtitle); ?></p><?php endif; ?>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <div class="slide active" data-slide data-safe-background="<?php echo e(asset('assets/images/template/embedded-bfef7bc6b1de.png')); ?>"><span class="media-fallback hero-background-fallback" data-background-fallback><?php echo e($siteSettings->image_fallback_text); ?></span></div>
            <?php endif; ?>
        </div>
    </section>

    <?php if($hasHomeFollowLinks): ?>
        <div class="social-strip">
            <div class="container social-inner">
                <strong class="social-title">
                    Follow <?php echo e($siteSettings->site_name); ?>

                    <span>Stay connected and follow her journey</span>
                </strong>
                <div class="social-links"><?php echo $__env->make('frontend.partials.social-links', ['links' => $homeFollowLinks], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?></div>
            </div>
        </div>
    <?php endif; ?>

    <?php $__currentLoopData = $sections; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $section): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <?php if(\Illuminate\Support\Str::startsWith($section->section_key, 'custom-')): ?>
            <?php echo $__env->make('frontend.home-sections.custom', ['section' => $section], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
        <?php elseif(view()->exists('frontend.home-sections.'.$section->section_key)): ?>
            <?php echo $__env->make('frontend.home-sections.'.$section->section_key, ['section' => $section], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
        <?php endif; ?>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</main>

<?php echo $__env->make('frontend.partials.work-modal', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.frontend', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/laravel/shamima-nazneen/resources/views/frontend/home.blade.php ENDPATH**/ ?>