<?php if($homeVideos->isNotEmpty()): ?>
<section class="videos" id="videos">
        <div class="container">
            <div class="section-head">
                <?php if($section->eyebrow): ?><div class="section-label"><?php echo e($section->eyebrow); ?></div><?php endif; ?>
                <h2><?php echo e($section->title); ?></h2>
                <div class="lead rich-content"><?php echo $section->description; ?></div>
            </div>
            <div class="video-grid">
                <?php $__currentLoopData = $homeVideos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $video): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php
                        $watchUrl = $video->youtube_watch_url;
                        $relatedUrl = $video->link_url;
                        $showRelatedLink = filled($relatedUrl) && $relatedUrl !== $watchUrl;
                    ?>
                    <article class="video-card <?php echo e($loop->first || $video->is_featured ? 'feature' : ''); ?>">
                        <div class="video-thumb embedded-video-wrap">
                            <iframe src="<?php echo e($video->embed_url); ?>" title="<?php echo e($video->title); ?>" loading="lazy" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
                        </div>
                        <div class="video-info">
                            <h3><a href="<?php echo e($video->youtube_watch_url); ?>" target="_blank" rel="noopener noreferrer"><?php echo e($video->title); ?></a></h3>
                            <p><?php echo e(\Illuminate\Support\Str::limit(strip_tags($video->description), 120)); ?></p>
                            <?php if($watchUrl): ?><a class="video-youtube-link" href="<?php echo e($watchUrl); ?>" target="_blank" rel="noopener noreferrer">Watch on YouTube →</a><?php endif; ?>
                            <?php if($showRelatedLink): ?><a class="video-youtube-link" href="<?php echo e($relatedUrl); ?>" target="_blank" rel="noopener noreferrer"><?php echo e($video->link_name ?: 'Open related link'); ?> →</a><?php endif; ?>
                        </div>
                    </article>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
            <p style="margin-top:28px"><a class="btn light" href="<?php echo e($section->button_url ?: route('videos.index')); ?>"><?php echo e($section->button_label ?: 'View More Videos'); ?></a></p>
        </div>
    </section>
<?php endif; ?>
<?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/laravel/shamima-nazneen/resources/views/frontend/home-sections/videos.blade.php ENDPATH**/ ?>