<?php
    $type = ($forcedType ?? request('type')) === 'video' ? 'video' : 'image';
    $homeOnly = request()->boolean('home');
    $profilesOnly = request()->boolean('profiles');
    $galleryOnly = request()->boolean('gallery');
    $typeLabel = $type === 'video' ? 'Videos' : 'Images';
    $pageTitle = $profilesOnly
        ? 'Profiles & Media '.($type === 'video' ? 'Videos' : 'Images')
        : ($homeOnly ? 'Homepage '.$typeLabel : ($type === 'video' ? 'Video Gallery' : 'Image Gallery'));
    $context = array_filter([
        'type' => $type,
        'home' => $homeOnly ? 1 : null,
        'profiles' => $profilesOnly ? 1 : null,
        'gallery' => $galleryOnly ? 1 : null,
    ]);
    $baseListUrl = route('admin.media-items.index', $context);
?>

<?php $__env->startSection('title', $pageTitle); ?>
<?php $__env->startSection('page_title', $pageTitle); ?>
<?php $__env->startSection('page_context', $profilesOnly || $homeOnly ? 'Home Page' : 'Gallery Page'); ?>

<?php $__env->startSection('content'); ?>
<?php if (isset($component)) { $__componentOriginalcb19cb35a534439097b02b8af91726ee = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalcb19cb35a534439097b02b8af91726ee = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.admin.page-header','data' => ['title' => strtolower($pageTitle),'description' => $type === 'video'
        ? 'Manage YouTube videos separately from the image gallery. Only video items appear here.'
        : 'Manage uploaded images separately from the video gallery. Only image items appear here.','action' => route('admin.media-items.create', $context),'actionLabel' => $type === 'video' ? 'Add Video' : 'Add Image']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('admin.page-header'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(strtolower($pageTitle)),'description' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($type === 'video'
        ? 'Manage YouTube videos separately from the image gallery. Only video items appear here.'
        : 'Manage uploaded images separately from the video gallery. Only image items appear here.'),'action' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(route('admin.media-items.create', $context)),'action-label' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($type === 'video' ? 'Add Video' : 'Add Image')]); ?>
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

<?php if($homeOnly || $profilesOnly || $galleryOnly): ?>
    <div class="context-notice">
        <strong>Placement filter is active.</strong>
        <span>
            <?php if($profilesOnly): ?> Only <?php echo e(strtolower($typeLabel)); ?> enabled for Profiles & Media cards are listed.
            <?php elseif($homeOnly): ?> Only <?php echo e(strtolower($typeLabel)); ?> enabled for the matching homepage section are listed.
            <?php else: ?> Only <?php echo e(strtolower($typeLabel)); ?> enabled for the public <?php echo e($type === 'video' ? 'Video' : 'Image'); ?> Gallery page are listed.
            <?php endif; ?>
        </span>
        <a href="<?php echo e(route('admin.media-items.index', ['type' => $type])); ?>">Open complete <?php echo e(strtolower($typeLabel)); ?> library</a>
    </div>
<?php endif; ?>

<nav class="page-filter-tabs" aria-label="Gallery type filters">
    <a href="<?php echo e(route('admin.gallery-media.images')); ?>" class="<?php echo e($type === 'image' && ! $homeOnly && ! $profilesOnly ? 'active' : ''); ?>">Image Gallery</a>
    <a href="<?php echo e(route('admin.gallery-media.videos')); ?>" class="<?php echo e($type === 'video' && ! $homeOnly && ! $profilesOnly ? 'active' : ''); ?>">Video Gallery</a>
</nav>

<form class="filters-bar" method="GET" action="<?php echo e($baseListUrl); ?>">
    <input type="hidden" name="type" value="<?php echo e($type); ?>">
    <?php if($homeOnly): ?><input type="hidden" name="home" value="1"><?php endif; ?>
    <?php if($profilesOnly): ?><input type="hidden" name="profiles" value="1"><?php endif; ?>
    <?php if($galleryOnly): ?><input type="hidden" name="gallery" value="1"><?php endif; ?>
    <div class="filter-field"><label for="search">Search</label><input id="search" type="search" name="search" value="<?php echo e(request('search')); ?>"></div>
    <button class="admin-button primary" type="submit">Filter</button>
    <?php if(request('search')): ?><a class="admin-button secondary" href="<?php echo e($baseListUrl); ?>">Clear</a><?php endif; ?>
</form>

<section class="admin-card">
<?php if($mediaItems->isEmpty()): ?>
    <?php if (isset($component)) { $__componentOriginal4f6d3d43898faeeafb58dda6562a88bf = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal4f6d3d43898faeeafb58dda6562a88bf = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.admin.empty','data' => ['title' => $type === 'video' ? 'No videos found' : 'No images found','description' => $type === 'video' ? 'Add a YouTube video, then choose where it should appear.' : 'Upload an image, then choose where it should appear.','action' => route('admin.media-items.create', $context),'actionLabel' => $type === 'video' ? 'Add Video' : 'Add Image']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('admin.empty'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($type === 'video' ? 'No videos found' : 'No images found'),'description' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($type === 'video' ? 'Add a YouTube video, then choose where it should appear.' : 'Upload an image, then choose where it should appear.'),'action' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(route('admin.media-items.create', $context)),'action-label' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($type === 'video' ? 'Add Video' : 'Add Image')]); ?>
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
<thead><tr><th class="move-column">Move</th><th><?php echo e($type === 'video' ? 'Video item' : 'Image item'); ?></th><th>Public <?php echo e($type === 'video' ? 'Video' : 'Image'); ?> Gallery</th><th>Homepage</th><th>Profiles</th><th>Status</th><th></th></tr></thead>
<tbody data-sortable-list data-reorder-url="<?php echo e(route('admin.reorder', ['resource' => 'media-items'])); ?>"><?php $__currentLoopData = $mediaItems; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<tr data-sortable-item data-id="<?php echo e($item->id); ?>">
    <td class="move-cell"><?php if (isset($component)) { $__componentOriginalfa49830067f09d77345c1d216db7d34a = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalfa49830067f09d77345c1d216db7d34a = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.admin.sort-handle','data' => ['label' => 'Move gallery item '.$item->title]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('admin.sort-handle'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['label' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute('Move gallery item '.$item->title)]); ?>
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
    <td><div class="table-title"><?php if($item->image_url): ?><img src="<?php echo e($item->image_url); ?>" alt="" data-fallback-text="<?php echo e($item->fallback_text ?: 'Preview unavailable'); ?>"><?php endif; ?><div><strong><?php echo e($item->title); ?></strong><small><?php echo e($item->category ?: 'Uncategorized'); ?><?php echo e($item->year ? ' · '.$item->year : ''); ?></small></div></div></td>
    <td><?php if (isset($component)) { $__componentOriginal9383433c9194439a213c031c55720455 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal9383433c9194439a213c031c55720455 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.admin.status','data' => ['active' => $item->show_in_gallery,'trueLabel' => 'Shown','falseLabel' => 'Hidden']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('admin.status'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['active' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($item->show_in_gallery),'true-label' => 'Shown','false-label' => 'Hidden']); ?>
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
    <td><?php if (isset($component)) { $__componentOriginal9383433c9194439a213c031c55720455 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal9383433c9194439a213c031c55720455 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.admin.status','data' => ['active' => $item->show_on_home,'trueLabel' => 'Shown','falseLabel' => 'Hidden']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('admin.status'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['active' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($item->show_on_home),'true-label' => 'Shown','false-label' => 'Hidden']); ?>
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
    <td><?php if (isset($component)) { $__componentOriginal9383433c9194439a213c031c55720455 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal9383433c9194439a213c031c55720455 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.admin.status','data' => ['active' => $item->show_in_profiles,'trueLabel' => 'Shown','falseLabel' => 'Hidden']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('admin.status'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['active' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($item->show_in_profiles),'true-label' => 'Shown','false-label' => 'Hidden']); ?>
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
    <td><?php if (isset($component)) { $__componentOriginal9383433c9194439a213c031c55720455 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal9383433c9194439a213c031c55720455 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.admin.status','data' => ['active' => $item->is_active]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('admin.status'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['active' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($item->is_active)]); ?>
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
    <td><div class="table-actions"><a class="admin-button secondary small" href="<?php echo e(route('admin.media-items.edit', array_merge(['media_item' => $item], $context))); ?>">Edit</a><form action="<?php echo e(route('admin.media-items.destroy', $item)); ?>" method="POST" data-confirm-delete="Delete this <?php echo e($type === 'video' ? 'video' : 'image'); ?> gallery item? Files currently reused by another section will remain protected."><?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?><button class="admin-button danger small" type="submit">Delete</button></form></div></td>
</tr>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?></tbody>
</table></div>
<?php endif; ?>
</section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/laravel/shamima-nazneen/resources/views/admin/media-items/index.blade.php ENDPATH**/ ?>