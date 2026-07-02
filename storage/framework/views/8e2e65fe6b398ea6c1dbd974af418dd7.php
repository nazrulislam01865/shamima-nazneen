<?php
    $social = $siteSettings->social_links ?? [];
    $footerFollowLinks = collect($siteSettings->profile_card_links ?? [])
        ->filter(fn ($link) => filled($link['title'] ?? null) && filled($link['url'] ?? null))
        ->values();
    $hasLogo = filled($siteSettings->logo_url);
?>
<footer>
    <div class="container">
        <div class="footer-grid">
            <div>
                <a class="brand footer-brand <?php echo e($hasLogo ? 'brand-logo-only' : ''); ?>" href="<?php echo e(route('home')); ?>" aria-label="<?php echo e($siteSettings->site_name); ?> home">
                    <?php if($hasLogo): ?>
                        <img class="site-logo-img footer-logo-img" src="<?php echo e($siteSettings->logo_url); ?>" alt="<?php echo e($siteSettings->site_name); ?> logo">
                    <?php else: ?>
                        <span class="brand-mark">
                            <?php echo e(mb_substr($siteSettings->site_name ?: 'S', 0, 1)); ?>

                        </span>
                        <span class="brand-name"><?php echo e($siteSettings->site_name); ?></span>
                    <?php endif; ?>
                </a>
                <p><?php echo e($siteSettings->footer_text ?: $siteSettings->tagline); ?></p>
            </div>
            <div>
                <strong>Quick Links</strong>
                <div class="footer-links" style="margin-top:12px">
                    <?php $__empty_1 = true; $__currentLoopData = $footerMenuItems; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $menuItem): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <a href="<?php echo e($menuItem->public_url); ?>" <?php if($menuItem->open_new_tab): ?> target="_blank" rel="noopener noreferrer" <?php endif; ?>><?php echo e($menuItem->label); ?></a>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <a href="<?php echo e(route('home')); ?>#about">About</a>
                        <a href="<?php echo e(route('biography.index')); ?>">Biography</a>
                        <a href="<?php echo e(route('works.index')); ?>">Works</a>
                        <a href="<?php echo e(route('videos.index')); ?>">Videos</a>
                        <a href="<?php echo e(route('gallery.index')); ?>">Gallery</a>
                    <?php endif; ?>
                    <?php $__currentLoopData = $footerCustomPages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $customMenuPage): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <a href="<?php echo e(route('pages.show', $customMenuPage)); ?>"><?php echo e($customMenuPage->name); ?></a>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
            <div>
                <strong>Social Links</strong>
                <div class="footer-social-icons">
                    <?php echo $__env->make('frontend.partials.social-links', ['links' => $footerFollowLinks], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                </div>
            </div>
        </div>
        <div class="copyright">© <?php echo e(now()->year); ?> <?php echo e($siteSettings->site_name); ?>. All rights reserved.</div>
    </div>
</footer>
<?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/laravel/shamima-nazneen/resources/views/frontend/partials/footer.blade.php ENDPATH**/ ?>