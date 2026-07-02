<?php $__env->startSection('title', 'Work Categories'); ?>
<?php $__env->startSection('page_title', 'Work Categories'); ?>
<?php $__env->startSection('page_context', 'Works Page'); ?>
<?php $__env->startSection('content'); ?>
<?php if (isset($component)) { $__componentOriginalcb19cb35a534439097b02b8af91726ee = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalcb19cb35a534439097b02b8af91726ee = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.admin.page-header','data' => ['title' => 'Work categories','description' => 'Control the work filters, homepage work cards, and category sequence used on the public pages.','action' => route('admin.work-categories.create'),'actionLabel' => 'Add Work Category']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('admin.page-header'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'Work categories','description' => 'Control the work filters, homepage work cards, and category sequence used on the public pages.','action' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(route('admin.work-categories.create')),'action-label' => 'Add Work Category']); ?>
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
<section class="admin-card">
<?php if($workCategories->isEmpty()): ?>
    <?php if (isset($component)) { $__componentOriginal4f6d3d43898faeeafb58dda6562a88bf = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal4f6d3d43898faeeafb58dda6562a88bf = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.admin.empty','data' => ['title' => 'No work categories yet','action' => route('admin.work-categories.create'),'actionLabel' => 'Add Work Category']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('admin.empty'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'No work categories yet','action' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(route('admin.work-categories.create')),'action-label' => 'Add Work Category']); ?>
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
<thead><tr><th class="move-column">Move</th><th>Category</th><th>Works</th><th>Home</th><th>Status</th><th></th></tr></thead>
<tbody data-sortable-list data-reorder-url="<?php echo e(route('admin.reorder', ['resource' => 'work-categories'])); ?>"><?php $__currentLoopData = $workCategories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<tr data-sortable-item data-id="<?php echo e($category->id); ?>">
    <td class="move-cell"><?php if (isset($component)) { $__componentOriginalfa49830067f09d77345c1d216db7d34a = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalfa49830067f09d77345c1d216db7d34a = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.admin.sort-handle','data' => ['label' => 'Move category '.$category->name]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('admin.sort-handle'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['label' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute('Move category '.$category->name)]); ?>
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
    <td><div class="table-title"><?php if($category->home_image_url): ?><img src="<?php echo e($category->home_image_url); ?>" alt=""><?php endif; ?><div><strong><?php echo e($category->name); ?></strong><small>/works?category=<?php echo e($category->slug); ?></small></div></div></td>
    <td><?php echo e($category->works_count); ?></td><td><?php if (isset($component)) { $__componentOriginal9383433c9194439a213c031c55720455 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal9383433c9194439a213c031c55720455 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.admin.status','data' => ['active' => $category->show_on_home,'trueLabel' => 'Shown','falseLabel' => 'Not shown']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('admin.status'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['active' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($category->show_on_home),'true-label' => 'Shown','false-label' => 'Not shown']); ?>
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
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.admin.status','data' => ['active' => $category->is_active]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('admin.status'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['active' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($category->is_active)]); ?>
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
    <td><div class="table-actions"><a class="admin-button secondary small" href="<?php echo e(route('admin.work-categories.edit', $category)); ?>">Edit</a><form action="<?php echo e(route('admin.work-categories.destroy', $category)); ?>" method="POST" data-confirm-delete="Delete this category? Categories containing works cannot be deleted."><?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?><button class="admin-button danger small" type="submit">Delete</button></form></div></td>
</tr>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?></tbody>
</table></div>
<?php endif; ?>
</section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/laravel/shamima-nazneen/resources/views/admin/work-categories/index.blade.php ENDPATH**/ ?>