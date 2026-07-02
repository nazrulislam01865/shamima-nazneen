<?php $__env->startSection('title', (($initialType ?? 'image') === 'video' ? 'Videos' : 'Gallery').' | '.$siteSettings->site_name); ?>
<?php $__env->startSection('meta_description', strip_tags($page->get('hero')?->description ?: $siteSettings->seo_description)); ?>
<?php $__env->startSection('page_css', 'gallery'); ?>

<?php $__env->startSection('content'); ?>
<?php
    $hero = $page->get('hero');
?>
<main id="top" class="gallery-page <?php echo e(($initialType ?? 'image') === 'video' ? 'gallery-page-video' : 'gallery-page-image'); ?>" data-initial-gallery-filter="<?php echo e($initialType ?? ''); ?>">
    <section class="gallery-page-hero">
        <div class="container">
            <div class="gallery-title-wrap">
                <div class="section-label"><?php echo e($hero?->eyebrow ?: 'Gallery'); ?></div>
                <h1><?php echo e(($initialType ?? 'image') === 'video' ? 'Video Gallery' : ($hero?->title ?: 'Image Gallery')); ?></h1>
                <div class="subhead"><?php echo e(($initialType ?? 'image') === 'video' ? 'Selected video appearances, interviews, and features.' : 'Moments from screen, stage, and public life.'); ?></div>
                <div class="rich-content"><?php echo $hero?->description; ?></div>
            </div>
        </div>
    </section>

    <section class="gallery-main">
        <div class="container">
            <?php if($categories->isNotEmpty()): ?>
                <div class="filter-bar" aria-label="Gallery filter options">
                    <button class="filter-btn active" data-filter="all" type="button">All <?php echo e(($initialType ?? 'image') === 'video' ? 'Videos' : 'Images'); ?></button>
                    <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <button class="filter-btn" data-filter="category:<?php echo e($category); ?>" type="button"><?php echo e($category); ?></button>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            <?php endif; ?>

            <div class="image-grid gallery-items-grid <?php echo e(($initialType ?? 'image') === 'video' ? 'gallery-video-grid' : 'gallery-image-grid'); ?>">
                <?php $__empty_1 = true; $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <?php if($item->type === 'image'): ?>
                        <article class="gallery-card image-gallery-card"
                                 data-type="image"
                                 data-category="<?php echo e($item->category); ?>"
                                 tabindex="0"
                                 role="button"
                                 aria-label="Open <?php echo e($item->title); ?>">
                            <img src="<?php echo e($item->image_url); ?>" alt="<?php echo e($item->alt_text ?: $item->title); ?>" data-fallback-text="<?php echo e($item->fallback_text ?: $siteSettings->image_fallback_text); ?>">
                            <div class="gallery-card-content">
                                <span class="label"><?php echo e($item->category ?: 'Image'); ?><?php if($item->year): ?> · <?php echo e($item->year); ?><?php endif; ?></span>
                                <h3><?php echo e($item->title); ?></h3>
                            </div>
                            <?php if($item->description): ?><template class="gallery-description"><?php echo $item->description; ?></template><?php endif; ?>
                        </article>
                    <?php else: ?>
                        <?php
                            $watchUrl = $item->youtube_watch_url;
                            $relatedUrl = trim((string) $item->link_url);
                            $showRelatedLink = filled($relatedUrl) && $relatedUrl !== $watchUrl;
                            $relatedIsExternal = \Illuminate\Support\Str::startsWith($relatedUrl, ['http://', 'https://']);
                        ?>
                        <article class="gallery-card video-gallery-card" data-type="video" data-category="<?php echo e($item->category); ?>">
                            <div class="gallery-video-frame">
                                <?php if($item->embed_url): ?>
                                    <iframe src="<?php echo e($item->embed_url); ?>" title="<?php echo e($item->title); ?>" loading="lazy" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
                                <?php elseif($item->image_url): ?>
                                    <img src="<?php echo e($item->image_url); ?>" alt="<?php echo e($item->alt_text ?: $item->title); ?>" data-fallback-text="<?php echo e($item->fallback_text ?: $siteSettings->image_fallback_text); ?>">
                                <?php endif; ?>
                            </div>
                            <div class="gallery-card-content gallery-video-content">
                                <span class="label"><?php echo e($item->category ?: 'Video'); ?><?php if($item->year): ?> · <?php echo e($item->year); ?><?php endif; ?></span>
                                <h3>
                                    <?php if($item->youtube_watch_url): ?><a href="<?php echo e($item->youtube_watch_url); ?>" target="_blank" rel="noopener noreferrer"><?php echo e($item->title); ?></a><?php else: ?><?php echo e($item->title); ?><?php endif; ?>
                                </h3>
                                <?php if($item->description): ?><p><?php echo e(\Illuminate\Support\Str::limit(strip_tags($item->description), 105)); ?></p><?php endif; ?>
                                <?php if($watchUrl): ?><a class="gallery-youtube-link" href="<?php echo e($watchUrl); ?>" target="_blank" rel="noopener noreferrer">Watch on YouTube →</a><?php endif; ?>
                                <?php if($showRelatedLink): ?><a class="gallery-youtube-link" href="<?php echo e($relatedUrl); ?>" <?php if($relatedIsExternal): ?> target="_blank" rel="noopener noreferrer" <?php endif; ?>><?php echo e($item->link_name ?: 'Open related link'); ?> →</a><?php endif; ?>
                            </div>
                        </article>
                    <?php endif; ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <div class="gallery-empty">No <?php echo e(($initialType ?? 'image') === 'video' ? 'videos' : 'images'); ?> are available yet.</div>
                <?php endif; ?>
            </div>
        </div>
    </section>
</main>

<div class="lightbox" id="lightbox" aria-hidden="true" role="dialog" aria-modal="true" aria-labelledby="lightboxCaption">
    <div class="lightbox-box">
        <img id="lightboxImg" src="" alt="" data-no-fallback>
        <div class="lightbox-caption">
            <div>
                <strong id="lightboxCaption">Gallery image</strong>
                <div id="lightboxDescription" class="lightbox-description"></div>
            </div>
            <button class="close-lightbox" type="button">Close</button>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.frontend', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/laravel/shamima-nazneen/resources/views/frontend/gallery.blade.php ENDPATH**/ ?>