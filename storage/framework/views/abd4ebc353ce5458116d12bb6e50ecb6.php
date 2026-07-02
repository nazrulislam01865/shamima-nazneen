<?php $__env->startSection('title', 'Dashboard'); ?>
<?php $__env->startSection('page_title', 'Dashboard'); ?>
<?php $__env->startSection('page_context', 'Overview'); ?>

<?php $__env->startSection('content'); ?>
<?php if (isset($component)) { $__componentOriginalcb19cb35a534439097b02b8af91726ee = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalcb19cb35a534439097b02b8af91726ee = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.admin.page-header','data' => ['title' => 'Website overview','description' => 'Manage every public section from one secure administration area. Changes are reflected on the website after saving.']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('admin.page-header'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'Website overview','description' => 'Manage every public section from one secure administration area. Changes are reflected on the website after saving.']); ?>
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

<div class="stats-grid">
    <article class="stat-card"><span>Total works</span><strong><?php echo e($stats['works']); ?></strong><a href="<?php echo e(route('admin.works.index')); ?>">Manage works →</a></article>
    <article class="stat-card"><span>Image gallery</span><strong><?php echo e($stats['images']); ?></strong><a href="<?php echo e(route('admin.gallery-media.images')); ?>">Manage images →</a></article>
    <article class="stat-card"><span>YouTube videos</span><strong><?php echo e($stats['videos']); ?></strong><a href="<?php echo e(route('admin.gallery-media.videos')); ?>">Manage videos →</a></article>
    <article class="stat-card"><span>Events</span><strong><?php echo e($stats['events']); ?></strong><a href="<?php echo e(route('admin.events.index')); ?>">Manage events →</a></article>
    <article class="stat-card"><span>Custom pages</span><strong><?php echo e($stats['custom_pages']); ?></strong><a href="<?php echo e(route('admin.custom-pages.index')); ?>">Manage pages →</a></article>
    <article class="stat-card"><span>New inquiries</span><strong><?php echo e($stats['new_inquiries']); ?></strong><a href="<?php echo e(route('admin.inquiries.index', ['status' => 'new'])); ?>">Review inquiries →</a></article>
</div>

<div class="dashboard-grid">
    <section class="admin-card">
        <div class="admin-card-header">
            <div><h2>Recent inquiries</h2><p>Latest booking, media, and professional messages.</p></div>
            <a class="admin-button secondary small" href="<?php echo e(route('admin.inquiries.index')); ?>">View all</a>
        </div>
        <?php if($recentInquiries->isEmpty()): ?>
            <?php if (isset($component)) { $__componentOriginal4f6d3d43898faeeafb58dda6562a88bf = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal4f6d3d43898faeeafb58dda6562a88bf = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.admin.empty','data' => ['title' => 'No inquiries received','description' => 'New messages submitted through the public contact form will appear here.']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('admin.empty'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'No inquiries received','description' => 'New messages submitted through the public contact form will appear here.']); ?>
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
            <div class="table-wrap">
                <table class="admin-table">
                    <thead><tr><th>Sender</th><th>Subject</th><th>Status</th><th>Received</th><th></th></tr></thead>
                    <tbody>
                    <?php $__currentLoopData = $recentInquiries; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $inquiry): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td><div class="table-title"><div><strong><?php echo e($inquiry->name); ?></strong><small><?php echo e($inquiry->email); ?></small></div></div></td>
                            <td><?php echo e(\Illuminate\Support\Str::limit($inquiry->subject ?: $inquiry->message, 45)); ?></td>
                            <td><span class="status-badge <?php echo e($inquiry->status); ?>"><?php echo e(ucfirst($inquiry->status)); ?></span></td>
                            <td><?php echo e($inquiry->created_at->diffForHumans()); ?></td>
                            <td><a class="admin-button secondary small" href="<?php echo e(route('admin.inquiries.show', $inquiry)); ?>">Open</a></td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>
        <?php endif; ?>
    </section>

    <section class="admin-card">
        <div class="admin-card-header">
            <div><h2>Recently added works</h2><p>Quick access to current work entries.</p></div>
            <a class="admin-button secondary small" href="<?php echo e(route('admin.works.create')); ?>">Add work</a>
        </div>
        <?php if($recentWorks->isEmpty()): ?>
            <?php if (isset($component)) { $__componentOriginal4f6d3d43898faeeafb58dda6562a88bf = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal4f6d3d43898faeeafb58dda6562a88bf = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.admin.empty','data' => ['title' => 'No works added','action' => route('admin.works.create'),'actionLabel' => 'Add first work']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('admin.empty'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'No works added','action' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(route('admin.works.create')),'action-label' => 'Add first work']); ?>
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
            <div class="admin-card-body" style="display:grid;gap:12px">
                <?php $__currentLoopData = $recentWorks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $work): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <a href="<?php echo e(route('admin.works.edit', $work)); ?>" style="display:flex;gap:12px;align-items:center;text-decoration:none;padding-bottom:12px;border-bottom:1px solid #eeeae2">
                        <?php if($work->image_url): ?><img src="<?php echo e($work->image_url); ?>" alt="" style="width:62px;height:46px;object-fit:cover;border-radius:8px"><?php endif; ?>
                        <span><strong style="display:block;font-size:13px"><?php echo e($work->title); ?></strong><small style="color:#71736b"><?php echo e($work->category?->name); ?> · <?php echo e($work->year); ?></small></span>
                    </a>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        <?php endif; ?>
    </section>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/laravel/shamima-nazneen/resources/views/admin/dashboard.blade.php ENDPATH**/ ?>