<?php
    $home = route('home');
    $social = $siteSettings->social_links ?? [];
    $headerFollowLinks = collect($siteSettings->profile_card_links ?? [])
        ->filter(fn ($link) => filled($link['title'] ?? null) && filled($link['url'] ?? null))
        ->values();
    $hasFollowLinks = $headerFollowLinks->isNotEmpty() || collect($social)->filter()->isNotEmpty();
    $hasLogo = filled($siteSettings->logo_url);
?>
<header class="topbar">
    <div class="container nav">
        <a class="brand <?php echo e($hasLogo ? 'brand-logo-only' : ''); ?>" href="<?php echo e($home); ?>" aria-label="<?php echo e($siteSettings->site_name); ?> home">
            <?php if($hasLogo): ?>
                <img class="site-logo-img" src="<?php echo e($siteSettings->logo_url); ?>" alt="<?php echo e($siteSettings->site_name); ?> logo">
            <?php else: ?>
                <span class="brand-mark">
                    <?php echo e(mb_substr($siteSettings->site_name ?: 'S', 0, 1)); ?>

                </span>
                <span class="brand-name"><?php echo e($siteSettings->site_name); ?></span>
            <?php endif; ?>
        </a>

        <button class="mobile-nav-toggle" type="button" aria-expanded="false" aria-controls="mainNavigation" aria-label="Open navigation">
            <span></span><span></span><span></span>
        </button>

        <nav id="mainNavigation" class="navlinks" aria-label="Main navigation">
            <div class="mobile-nav-panel-brand" aria-hidden="true">
                <span class="brand-mark small">
                    <?php echo e(mb_substr($siteSettings->site_name ?: 'S', 0, 1)); ?>

                </span>
                <strong><?php echo e($siteSettings->site_name); ?></strong>
            </div>

            <div class="navlinks-main">
                <?php $__empty_1 = true; $__currentLoopData = $headerMenuItems; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $menuItem): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <a class="nav-menu-link" href="<?php echo e($menuItem->public_url); ?>" <?php if($menuItem->open_new_tab): ?> target="_blank" rel="noopener noreferrer" <?php endif; ?>>
                        <span><?php echo e($menuItem->label); ?></span>
                    </a>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <a class="nav-menu-link" href="<?php echo e($home); ?>#about"><span>About</span></a>
                    <a class="nav-menu-link" href="<?php echo e(route('biography.index')); ?>"><span>Biography</span></a>
                    <a class="nav-menu-link" href="<?php echo e(route('works.index')); ?>"><span>Works</span></a>
                    <a class="nav-menu-link" href="<?php echo e(route('works.index', ['category' => 'films'])); ?>"><span>Films</span></a>
                    <a class="nav-menu-link" href="<?php echo e(route('videos.index')); ?>"><span>Videos</span></a>
                    <a class="nav-menu-link" href="<?php echo e(route('gallery.index')); ?>"><span>Gallery</span></a>
                    <a class="nav-menu-link" href="<?php echo e($home); ?>#contact"><span>Contact</span></a>
                <?php endif; ?>
                <?php $__currentLoopData = $headerCustomPages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $customMenuPage): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <a class="nav-menu-link" href="<?php echo e(route('pages.show', $customMenuPage)); ?>">
                        <span><?php echo e($customMenuPage->name); ?></span>
                    </a>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>

            <?php if($hasFollowLinks): ?>
                <div class="mobile-nav-follow">
                    <span>Follow</span>
                    <div class="mobile-nav-follow-grid">
                        <?php echo $__env->make('frontend.partials.social-links', ['links' => $headerFollowLinks, 'compact' => true], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                    </div>
                </div>
            <?php endif; ?>
        </nav>

        <a class="nav-cta" href="<?php echo e($home); ?>#contact"><?php echo e($siteSettings->media_inquiry_label ?: 'Media Inquiry'); ?></a>
    </div>
</header>
<?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/laravel/shamima-nazneen/resources/views/frontend/partials/header.blade.php ENDPATH**/ ?>