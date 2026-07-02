<?php

    $homeOnly = request()->boolean('home');

?>
<?php $__env->startSection('title', $homeOnly ? 'Homepage Works' : 'Works & Filmography'); ?>
<?php $__env->startSection('page_title', $homeOnly ? 'Homepage Works' : 'Works & Filmography'); ?>
<?php $__env->startSection('page_context', $homeOnly ? 'Home Page' : 'Works Page'); ?>

<?php $__env->startSection('content'); ?>
<?php if (isset($component)) { $__componentOriginalcb19cb35a534439097b02b8af91726ee = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalcb19cb35a534439097b02b8af91726ee = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.admin.page-header','data' => ['title' => $homeOnly ? 'Homepage works' : 'Works archive','description' => $homeOnly
        ? 'These entries appear in the homepage work sections. Drag them into the exact sequence visitors should see.'
        : 'Add films, television dramas, theatre, digital releases, direction, and other selected work. Drag entries to control their public sequence.','action' => route('admin.works.create', $homeOnly ? ['home' => 1] : []),'actionLabel' => 'Add Work']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('admin.page-header'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($homeOnly ? 'Homepage works' : 'Works archive'),'description' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($homeOnly
        ? 'These entries appear in the homepage work sections. Drag them into the exact sequence visitors should see.'
        : 'Add films, television dramas, theatre, digital releases, direction, and other selected work. Drag entries to control their public sequence.'),'action' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(route('admin.works.create', $homeOnly ? ['home' => 1] : [])),'action-label' => 'Add Work']); ?>
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

<?php if($homeOnly): ?>
    <div class="context-notice">
        <strong>Homepage filter is active.</strong>
        <span>Only work entries with “Show on home page” enabled are listed.</span>
        <a href="<?php echo e(route('admin.works.index')); ?>">View all works</a>
    </div>
<?php endif; ?>

<form class="filters-bar" method="GET" action="<?php echo e(route('admin.works.index')); ?>">
    <?php if($homeOnly): ?><input type="hidden" name="home" value="1"><?php endif; ?>
    <div class="filter-field"><label for="search">Search</label><input id="search" type="search" name="search" value="<?php echo e(request('search')); ?>"></div>
    <div class="filter-field"><label for="category">Category</label><select id="category" name="category"><option value="">Select a category or show all</option><?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><option value="<?php echo e($category->slug); ?>" <?php if(request('category') === $category->slug): echo 'selected'; endif; ?>><?php echo e($category->name); ?></option><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?></select></div>
    <button class="admin-button primary" type="submit">Filter</button>
    <?php if(request()->hasAny(['search','category'])): ?>
        <a class="admin-button secondary" href="<?php echo e(route('admin.works.index', $homeOnly ? ['home' => 1] : [])); ?>">Clear</a>
    <?php endif; ?>
</form>

<section class="admin-card">
<?php if($works->isEmpty()): ?>
    <?php if (isset($component)) { $__componentOriginal4f6d3d43898faeeafb58dda6562a88bf = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal4f6d3d43898faeeafb58dda6562a88bf = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.admin.empty','data' => ['title' => $homeOnly ? 'No works are selected for the homepage' : 'No matching works','description' => $homeOnly ? 'Edit an existing work and enable Show on home page, or add a new work.' : 'Add a work or clear the current filters.','action' => route('admin.works.create', $homeOnly ? ['home' => 1] : []),'actionLabel' => 'Add Work']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('admin.empty'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($homeOnly ? 'No works are selected for the homepage' : 'No matching works'),'description' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($homeOnly ? 'Edit an existing work and enable Show on home page, or add a new work.' : 'Add a work or clear the current filters.'),'action' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(route('admin.works.create', $homeOnly ? ['home' => 1] : [])),'action-label' => 'Add Work']); ?>
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
<?php else: ?>
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
<div class="table-wrap"><table class="admin-table">
<thead><tr><th class="move-column">Move</th><th>Work</th><th>Category</th><th>Year</th><th>Home</th><th>Status</th><th></th></tr></thead>
<tbody data-sortable-list data-reorder-url="<?php echo e(route('admin.reorder', ['resource' => 'works'])); ?>"><?php $__currentLoopData = $works; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $work): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<tr data-sortable-item data-id="<?php echo e($work->id); ?>">
    <td class="move-cell"><?php if (isset($component)) { $__componentOriginalfa49830067f09d77345c1d216db7d34a = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalfa49830067f09d77345c1d216db7d34a = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.admin.sort-handle','data' => ['label' => 'Move work '.$work->title]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('admin.sort-handle'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['label' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute('Move work '.$work->title)]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalfa49830067f09d77345c1d216db7d34a)): ?>
<?php $attributes = $__attributesOriginalfa49830067f09d77345c1d216db7d34a; ?>
<?php unset($__attributesOriginalfa49830067f09d77345c1d216db7d34a); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalfa49830067f09d77345c1d216db7d34a)): ?>
<?php $component = $__componentOriginalfa49830067f09d77345c1d216db7d34a; ?>
<?php unset($__componentOriginalfa49830067f09d77345c1d216db7d34a); ?>
<?php endif; ?></td>
    <td><div class="table-title"><?php if($work->image_url): ?><img src="<?php echo e($work->image_url); ?>" alt=""><?php endif; ?><div><strong><?php echo e($work->title); ?></strong><small><?php echo e($work->role ?: $work->credit ?: \Illuminate\Support\Str::limit(strip_tags($work->short_description), 55)); ?></small></div></div></td>
    <td><?php echo e($work->category?->name); ?></td><td><strong><?php echo e($work->year ?: '—'); ?></strong></td><td><?php if (isset($component)) { $__componentOriginal9383433c9194439a213c031c55720455 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal9383433c9194439a213c031c55720455 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.admin.status','data' => ['active' => $work->show_on_home,'trueLabel' => 'Shown','falseLabel' => 'Not shown']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('admin.status'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['active' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($work->show_on_home),'true-label' => 'Shown','false-label' => 'Not shown']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal9383433c9194439a213c031c55720455)): ?>
<?php $attributes = $__attributesOriginal9383433c9194439a213c031c55720455; ?>
<?php unset($__attributesOriginal9383433c9194439a213c031c55720455); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal9383433c9194439a213c031c55720455)): ?>
<?php $component = $__componentOriginal9383433c9194439a213c031c55720455; ?>
<?php unset($__componentOriginal9383433c9194439a213c031c55720455); ?>
<?php endif; ?></td><td><?php if (isset($component)) { $__componentOriginal9383433c9194439a213c031c55720455 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal9383433c9194439a213c031c55720455 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.admin.status','data' => ['active' => $work->is_active]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('admin.status'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['active' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($work->is_active)]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal9383433c9194439a213c031c55720455)): ?>
<?php $attributes = $__attributesOriginal9383433c9194439a213c031c55720455; ?>
<?php unset($__attributesOriginal9383433c9194439a213c031c55720455); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal9383433c9194439a213c031c55720455)): ?>
<?php $component = $__componentOriginal9383433c9194439a213c031c55720455; ?>
<?php unset($__componentOriginal9383433c9194439a213c031c55720455); ?>
<?php endif; ?></td>
    <td><div class="table-actions"><a class="admin-button secondary small" href="<?php echo e(route('admin.works.edit', array_filter(['work' => $work, 'home' => $homeOnly ? 1 : null]))); ?>">Edit</a><form action="<?php echo e(route('admin.works.destroy', $work)); ?>" method="POST" data-confirm-delete="Delete this work permanently?"><?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?><button class="admin-button danger small" type="submit">Delete</button></form></div></td>
</tr>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?></tbody>
</table></div>
<?php endif; ?>
</section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/laravel/shamima-nazneen/resources/views/admin/works/index.blade.php ENDPATH**/ ?>