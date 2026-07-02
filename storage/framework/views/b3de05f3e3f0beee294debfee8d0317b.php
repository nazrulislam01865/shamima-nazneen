<?php $__env->startSection('title', $pageConfig ? $pageConfig['label'].' Content' : 'Page Content'); ?>
<?php $__env->startSection('page_title', $pageConfig ? $pageConfig['label'].' Content' : 'Page Content'); ?>
<?php $__env->startSection('page_context', 'Page management'); ?>

<?php $__env->startSection('content'); ?>
<?php if (isset($component)) { $__componentOriginalcb19cb35a534439097b02b8af91726ee = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalcb19cb35a534439097b02b8af91726ee = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.admin.page-header','data' => ['title' => $pageConfig ? $pageConfig['label'].' content' : 'Page content','description' => $pageConfig
        ? 'Edit every heading, description, button, image, visibility setting, and drag-and-drop sequence used on the '.$pageConfig['short_label'].' page.'
        : 'Select a page and edit its headings, descriptions, buttons, images, visibility settings, and sequence.','action' => $pageFilter === 'home' ? route('admin.content-sections.create', ['page' => 'home']) : null,'actionLabel' => 'Add Home Content']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('admin.page-header'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($pageConfig ? $pageConfig['label'].' content' : 'Page content'),'description' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($pageConfig
        ? 'Edit every heading, description, button, image, visibility setting, and drag-and-drop sequence used on the '.$pageConfig['short_label'].' page.'
        : 'Select a page and edit its headings, descriptions, buttons, images, visibility settings, and sequence.'),'action' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($pageFilter === 'home' ? route('admin.content-sections.create', ['page' => 'home']) : null),'action-label' => 'Add Home Content']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalcb19cb35a534439097b02b8af91726ee)): ?>
<?php $attributes = $__attributesOriginalcb19cb35a534439097b02b8af91726ee; ?>
<?php unset($__attributesOriginalcb19cb35a534439097b02b8af91726ee); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalcb19cb35a534439097b02b8af91726ee)): ?>
<?php $component = $__componentOriginalcb19cb35a534439097b02b8af91726ee; ?>
<?php unset($__componentOriginalcb19cb35a534439097b02b8af91726ee); ?>
<?php endif; ?>

<nav class="page-filter-tabs" aria-label="Filter page content">
    <a href="<?php echo e(route('admin.content-sections.index')); ?>" class="<?php echo e($pageFilter === null ? 'active' : ''); ?>">All Pages</a>
    <?php $__currentLoopData = $availablePages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pageKey => $page): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <a href="<?php echo e(route('admin.content-sections.index', ['page' => $pageKey])); ?>" class="<?php echo e($pageFilter === $pageKey ? 'active' : ''); ?>"><?php echo e($page['label']); ?></a>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</nav>

<?php $__empty_1 = true; $__currentLoopData = $sections; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pageName => $pageSections): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
    <section class="page-group">
        <div class="page-group-heading">
            <h2 class="page-group-label"><?php echo e($availablePages[$pageName]['label'] ?? ucfirst($pageName).' Page'); ?></h2>
            <?php if(isset($availablePages[$pageName])): ?>
                <a href="<?php echo e(route('admin.pages.show', ['page' => $pageName])); ?>">Open page overview →</a>
            <?php endif; ?>
        </div>
        <?php if (isset($component)) { $__componentOriginal523ad3281b60e28953c1a1345c510390 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal523ad3281b60e28953c1a1345c510390 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.admin.sortable-help','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('admin.sortable-help'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal523ad3281b60e28953c1a1345c510390)): ?>
<?php $attributes = $__attributesOriginal523ad3281b60e28953c1a1345c510390; ?>
<?php unset($__attributesOriginal523ad3281b60e28953c1a1345c510390); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal523ad3281b60e28953c1a1345c510390)): ?>
<?php $component = $__componentOriginal523ad3281b60e28953c1a1345c510390; ?>
<?php unset($__componentOriginal523ad3281b60e28953c1a1345c510390); ?>
<?php endif; ?>
        <div class="section-list" data-sortable-list data-reorder-url="<?php echo e(route('admin.reorder', ['resource' => 'content-sections'])); ?>">
            <?php $__currentLoopData = $pageSections; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $section): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <article class="section-row" data-sortable-item data-id="<?php echo e($section->id); ?>">
                    <?php if (isset($component)) { $__componentOriginalfa49830067f09d77345c1d216db7d34a = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalfa49830067f09d77345c1d216db7d34a = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.admin.sort-handle','data' => ['label' => 'Move '.($section->title ?: \Illuminate\Support\Str::headline($section->section_key)).' section']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('admin.sort-handle'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['label' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute('Move '.($section->title ?: \Illuminate\Support\Str::headline($section->section_key)).' section')]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalfa49830067f09d77345c1d216db7d34a)): ?>
<?php $attributes = $__attributesOriginalfa49830067f09d77345c1d216db7d34a; ?>
<?php unset($__attributesOriginalfa49830067f09d77345c1d216db7d34a); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalfa49830067f09d77345c1d216db7d34a)): ?>
<?php $component = $__componentOriginalfa49830067f09d77345c1d216db7d34a; ?>
<?php unset($__componentOriginalfa49830067f09d77345c1d216db7d34a); ?>
<?php endif; ?>
                    <div>
                        <h3><?php echo e($section->title ?: \Illuminate\Support\Str::headline($section->section_key)); ?></h3>
                        <p><?php echo e(\Illuminate\Support\Str::headline($section->section_key)); ?> section · <?php echo e($section->eyebrow ?: 'No eyebrow label'); ?></p>
                    </div>
                    <?php if (isset($component)) { $__componentOriginal9383433c9194439a213c031c55720455 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal9383433c9194439a213c031c55720455 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.admin.status','data' => ['active' => $section->is_active]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('admin.status'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['active' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($section->is_active)]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal9383433c9194439a213c031c55720455)): ?>
<?php $attributes = $__attributesOriginal9383433c9194439a213c031c55720455; ?>
<?php unset($__attributesOriginal9383433c9194439a213c031c55720455); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal9383433c9194439a213c031c55720455)): ?>
<?php $component = $__componentOriginal9383433c9194439a213c031c55720455; ?>
<?php unset($__componentOriginal9383433c9194439a213c031c55720455); ?>
<?php endif; ?>
                    <div class="table-actions">
                        <a class="admin-button secondary small" href="<?php echo e(route('admin.content-sections.edit', $section)); ?>">Edit section</a>
                        <?php if($section->page === 'home' && \Illuminate\Support\Str::startsWith($section->section_key, 'custom-')): ?>
                            <form action="<?php echo e(route('admin.content-sections.destroy', $section)); ?>" method="POST" data-confirm-delete="Delete this custom home-page section?">
                                <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                                <button class="admin-button danger small" type="submit">Delete</button>
                            </form>
                        <?php endif; ?>
                    </div>
                </article>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </section>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
    <?php if (isset($component)) { $__componentOriginal4f6d3d43898faeeafb58dda6562a88bf = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal4f6d3d43898faeeafb58dda6562a88bf = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.admin.empty','data' => ['title' => 'No page sections found','description' => 'No editable content sections exist for this page.']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('admin.empty'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'No page sections found','description' => 'No editable content sections exist for this page.']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal4f6d3d43898faeeafb58dda6562a88bf)): ?>
<?php $attributes = $__attributesOriginal4f6d3d43898faeeafb58dda6562a88bf; ?>
<?php unset($__attributesOriginal4f6d3d43898faeeafb58dda6562a88bf); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal4f6d3d43898faeeafb58dda6562a88bf)): ?>
<?php $component = $__componentOriginal4f6d3d43898faeeafb58dda6562a88bf; ?>
<?php unset($__componentOriginal4f6d3d43898faeeafb58dda6562a88bf); ?>
<?php endif; ?>
<?php endif; ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/laravel/shamima-nazneen/resources/views/admin/content-sections/index.blade.php ENDPATH**/ ?>