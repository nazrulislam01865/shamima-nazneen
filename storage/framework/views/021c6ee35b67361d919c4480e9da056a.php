<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <title><?php echo $__env->yieldContent('title', 'Admin'); ?> | <?php echo e($siteSettings->site_name); ?></title>
    <?php if($siteSettings->favicon_url): ?>
        <link rel="icon" href="<?php echo e($siteSettings->favicon_url); ?>">
    <?php endif; ?>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&family=Playfair+Display:wght@600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo e(asset('assets/css/admin.css')); ?>">
    <?php echo $__env->yieldPushContent('styles'); ?>
</head>
<body class="admin-body" data-image-fallback-text="<?php echo e($siteSettings->image_fallback_text ?: 'Image is not available.'); ?>">
    <div class="admin-shell" data-admin-shell>
        <aside class="admin-sidebar" data-admin-sidebar>
            <a class="admin-brand <?php echo e($siteSettings->logo_url ? 'admin-brand-logo-only' : ''); ?>" href="<?php echo e(route('admin.dashboard')); ?>" aria-label="<?php echo e($siteSettings->site_name); ?> admin dashboard">
                <?php if($siteSettings->logo_url): ?>
                    <img class="admin-site-logo" src="<?php echo e($siteSettings->logo_url); ?>" alt="<?php echo e($siteSettings->site_name); ?> logo">
                <?php else: ?>
                    <span class="admin-brand-mark">SN</span>
                    <span>
                        <strong><?php echo e($siteSettings->site_name); ?></strong>
                        <small>Website administration</small>
                    </span>
                <?php endif; ?>
            </a>

            <nav class="admin-nav" aria-label="Admin navigation">
                <div class="admin-nav-group">
                    <span class="admin-nav-group-title">Overview</span>
                    <a href="<?php echo e(route('admin.dashboard')); ?>" class="admin-nav-link <?php echo e(request()->routeIs('admin.dashboard') ? 'active' : ''); ?>">
                        <span class="nav-icon" aria-hidden="true"><?php echo $__env->make('admin.partials.icon', ['name' => 'grid'], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?></span>
                        <span>Dashboard</span>
                    </a>
                </div>

                <div class="admin-nav-group">
                    <span class="admin-nav-group-title">Website Pages</span>
                    <?php $__currentLoopData = $adminPages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pageKey => $page): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php
                            $pageActive = \App\Support\AdminPageRegistry::isPageActive($page);
                        ?>
                        <details class="admin-nav-section <?php echo e($pageActive ? 'active' : ''); ?>" <?php if($pageActive): ?> open <?php endif; ?>>
                            <summary>
                                <span class="nav-icon" aria-hidden="true"><?php echo $__env->make('admin.partials.icon', ['name' => $page['icon']], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?></span>
                                <span><?php echo e($page['label']); ?></span>
                                <span class="nav-chevron" aria-hidden="true"><?php echo $__env->make('admin.partials.icon', ['name' => 'chevron-down'], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?></span>
                            </summary>
                            <div class="admin-subnav">
                                <?php $__currentLoopData = $page['modules']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $module): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php
                                        $moduleActive = \App\Support\AdminPageRegistry::isModuleActive($module);
                                    ?>
                                    <a href="<?php echo e(route($module['route'], $module['params'] ?? [])); ?>" class="<?php echo e($moduleActive ? 'active' : ''); ?>">
                                        <span class="subnav-dot" aria-hidden="true"></span>
                                        <span><?php echo e($module['label']); ?></span>
                                        <?php if($module['key'] === 'inquiries' && ($adminNewInquiryCount ?? 0) > 0): ?>
                                            <span class="nav-count"><?php echo e($adminNewInquiryCount); ?></span>
                                        <?php endif; ?>
                                    </a>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                        </details>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                    <?php

                        $customPagesActive = request()->routeIs('admin.custom-pages.*');

                    ?>
                    <details class="admin-nav-section <?php echo e($customPagesActive ? 'active' : ''); ?>" <?php if($customPagesActive): ?> open <?php endif; ?>>
                        <summary>
                            <span class="nav-icon" aria-hidden="true"><?php echo $__env->make('admin.partials.icon', ['name' => 'layout'], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?></span>
                            <span>Custom Pages</span>
                            <span class="nav-chevron" aria-hidden="true"><?php echo $__env->make('admin.partials.icon', ['name' => 'chevron-down'], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?></span>
                        </summary>
                        <div class="admin-subnav">
                            <a href="<?php echo e(route('admin.custom-pages.index')); ?>" class="<?php echo e(request()->routeIs('admin.custom-pages.index', 'admin.custom-pages.edit') ? 'active' : ''); ?>">
                                <span class="subnav-dot" aria-hidden="true"></span>
                                <span>All Custom Pages</span>
                            </a>
                            <a href="<?php echo e(route('admin.custom-pages.create')); ?>" class="<?php echo e(request()->routeIs('admin.custom-pages.create') ? 'active' : ''); ?>">
                                <span class="subnav-dot" aria-hidden="true"></span>
                                <span>Add New Page</span>
                            </a>
                        </div>
                    </details>
                </div>

                <div class="admin-nav-group">
                    <span class="admin-nav-group-title">General Settings</span>
                    <a href="<?php echo e(route('admin.settings.edit')); ?>" class="admin-nav-link <?php echo e(request()->routeIs('admin.settings.*') ? 'active' : ''); ?>">
                        <span class="nav-icon" aria-hidden="true"><?php echo $__env->make('admin.partials.icon', ['name' => 'settings'], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?></span>
                        <span>Site Identity & SEO</span>
                    </a>
                    <a href="<?php echo e(route('admin.menu-items.index', ['location' => 'header'])); ?>" class="admin-nav-link <?php echo e(request()->routeIs('admin.menu-items.*') ? 'active' : ''); ?>">
                        <span class="nav-icon" aria-hidden="true"><?php echo $__env->make('admin.partials.icon', ['name' => 'layout'], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?></span>
                        <span>Header & Footer Menus</span>
                    </a>
                    <a href="<?php echo e(route('admin.account.edit')); ?>" class="admin-nav-link <?php echo e(request()->routeIs('admin.account.*') ? 'active' : ''); ?>">
                        <span class="nav-icon" aria-hidden="true"><?php echo $__env->make('admin.partials.icon', ['name' => 'user'], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?></span>
                        <span>Administrator Account</span>
                    </a>
                </div>
            </nav>

            <div class="admin-sidebar-footer">
                <a href="<?php echo e(route('home')); ?>" target="_blank" rel="noopener noreferrer">View public website ↗</a>
            </div>
        </aside>

        <div class="admin-main">
            <header class="admin-topbar">
                <button class="admin-menu-button" type="button" data-sidebar-toggle aria-label="Open navigation">
                    <span></span><span></span><span></span>
                </button>
                <div class="admin-topbar-title">
                    <small><?php echo $__env->yieldContent('page_context', 'Website administration'); ?></small>
                    <strong><?php echo $__env->yieldContent('page_title', 'Dashboard'); ?></strong>
                </div>
                <div class="admin-account">
                    <span class="admin-avatar"><?php echo e(strtoupper(substr(auth()->user()->name, 0, 1))); ?></span>
                    <span class="admin-account-copy"><strong><?php echo e(auth()->user()->name); ?></strong><small>Administrator</small></span>
                    <form method="POST" action="<?php echo e(route('admin.logout')); ?>">
                        <?php echo csrf_field(); ?>
                        <button class="admin-logout" type="submit">Log out</button>
                    </form>
                </div>
            </header>

            <main class="admin-content">
                <?php if(session('success')): ?>
                    <div class="admin-alert success" role="status">
                        <strong>Saved.</strong> <?php echo e(session('success')); ?>

                        <button type="button" data-dismiss-alert aria-label="Dismiss">×</button>
                    </div>
                <?php endif; ?>
                <?php if(session('error')): ?>
                    <div class="admin-alert error" role="alert">
                        <strong>Unable to continue.</strong> <?php echo e(session('error')); ?>

                        <button type="button" data-dismiss-alert aria-label="Dismiss">×</button>
                    </div>
                <?php endif; ?>
                <?php if($errors->any()): ?>
                    <div class="admin-alert error validation-summary" role="alert" data-error-summary>
                        <strong>Please correct the highlighted information.</strong>
                        <p>Click an item below to go directly to the field that needs attention.</p>
                        <ul>
                            <?php $__currentLoopData = $errors->getMessages(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $field => $messages): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php $fieldId = preg_replace('/[^A-Za-z0-9_-]+/', '_', $field); ?>
                                <?php $__currentLoopData = $messages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $message): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <li><a href="#<?php echo e($fieldId); ?>" data-error-link data-error-field="<?php echo e($field); ?>"><?php echo e($message); ?></a></li>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                        <button type="button" data-dismiss-alert aria-label="Dismiss">×</button>
                    </div>
                <?php endif; ?>

                <?php echo $__env->yieldContent('content'); ?>
            </main>
        </div>
        <button class="sidebar-backdrop" type="button" data-sidebar-backdrop aria-label="Close navigation"></button>
    </div>
    <script src="<?php echo e(asset('assets/js/admin.js')); ?>" defer></script>
    <?php echo $__env->yieldPushContent('scripts'); ?>
</body>
</html>
<?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/laravel/shamima-nazneen/resources/views/layouts/admin.blade.php ENDPATH**/ ?>