<?php
    $item = $mediaItem ?? null;
    $currentType = old('type', $item?->type ?? ($defaultType ?? 'image')) === 'video' ? 'video' : 'image';
    $isVideo = $currentType === 'video';
?>
<section class="form-section">
    <div class="form-section-heading"><h2><?php echo e($isVideo ? 'Video gallery item' : 'Image gallery item'); ?></h2></div>
    <input type="hidden" name="type" value="<?php echo e($currentType); ?>">
    <div class="form-grid three">
        <div class="form-field">
            <label>Gallery type</label>
            <div class="readonly-field"><?php echo e($isVideo ? 'Video Gallery' : 'Image Gallery'); ?></div>
        </div>
        <?php if (isset($component)) { $__componentOriginal187e7f8ae725d0d7c586a97e85953c03 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal187e7f8ae725d0d7c586a97e85953c03 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.admin.input','data' => ['name' => 'title','label' => 'Title','value' => $item?->title,'required' => true,'placeholder' => ''.e($isVideo ? 'Enter a clear video title' : 'Enter a clear image title').'']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('admin.input'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'title','label' => 'Title','value' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($item?->title),'required' => true,'placeholder' => ''.e($isVideo ? 'Enter a clear video title' : 'Enter a clear image title').'']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal187e7f8ae725d0d7c586a97e85953c03)): ?>
<?php $attributes = $__attributesOriginal187e7f8ae725d0d7c586a97e85953c03; ?>
<?php unset($__attributesOriginal187e7f8ae725d0d7c586a97e85953c03); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal187e7f8ae725d0d7c586a97e85953c03)): ?>
<?php $component = $__componentOriginal187e7f8ae725d0d7c586a97e85953c03; ?>
<?php unset($__componentOriginal187e7f8ae725d0d7c586a97e85953c03); ?>
<?php endif; ?>
        <?php if (! ($isVideo)): ?>
            <?php if (isset($component)) { $__componentOriginal187e7f8ae725d0d7c586a97e85953c03 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal187e7f8ae725d0d7c586a97e85953c03 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.admin.input','data' => ['name' => 'alt_text','label' => 'Image alternative text','value' => $item?->alt_text,'placeholder' => 'Describe the image for screen readers']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('admin.input'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'alt_text','label' => 'Image alternative text','value' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($item?->alt_text),'placeholder' => 'Describe the image for screen readers']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal187e7f8ae725d0d7c586a97e85953c03)): ?>
<?php $attributes = $__attributesOriginal187e7f8ae725d0d7c586a97e85953c03; ?>
<?php unset($__attributesOriginal187e7f8ae725d0d7c586a97e85953c03); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal187e7f8ae725d0d7c586a97e85953c03)): ?>
<?php $component = $__componentOriginal187e7f8ae725d0d7c586a97e85953c03; ?>
<?php unset($__componentOriginal187e7f8ae725d0d7c586a97e85953c03); ?>
<?php endif; ?>
        <?php else: ?>
            <div></div>
        <?php endif; ?>
        <?php if (isset($component)) { $__componentOriginal187e7f8ae725d0d7c586a97e85953c03 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal187e7f8ae725d0d7c586a97e85953c03 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.admin.input','data' => ['name' => 'category','label' => 'Category / collection','value' => $item?->category,'placeholder' => 'Portrait, Television, Film, Interview']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('admin.input'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'category','label' => 'Category / collection','value' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($item?->category),'placeholder' => 'Portrait, Television, Film, Interview']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal187e7f8ae725d0d7c586a97e85953c03)): ?>
<?php $attributes = $__attributesOriginal187e7f8ae725d0d7c586a97e85953c03; ?>
<?php unset($__attributesOriginal187e7f8ae725d0d7c586a97e85953c03); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal187e7f8ae725d0d7c586a97e85953c03)): ?>
<?php $component = $__componentOriginal187e7f8ae725d0d7c586a97e85953c03; ?>
<?php unset($__componentOriginal187e7f8ae725d0d7c586a97e85953c03); ?>
<?php endif; ?>
        <?php if (isset($component)) { $__componentOriginal187e7f8ae725d0d7c586a97e85953c03 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal187e7f8ae725d0d7c586a97e85953c03 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.admin.input','data' => ['name' => 'year','label' => 'Year','type' => 'number','value' => $item?->year,'min' => '1900','max' => date('Y') + 5,'placeholder' => '2024']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('admin.input'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'year','label' => 'Year','type' => 'number','value' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($item?->year),'min' => '1900','max' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(date('Y') + 5),'placeholder' => '2024']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal187e7f8ae725d0d7c586a97e85953c03)): ?>
<?php $attributes = $__attributesOriginal187e7f8ae725d0d7c586a97e85953c03; ?>
<?php unset($__attributesOriginal187e7f8ae725d0d7c586a97e85953c03); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal187e7f8ae725d0d7c586a97e85953c03)): ?>
<?php $component = $__componentOriginal187e7f8ae725d0d7c586a97e85953c03; ?>
<?php unset($__componentOriginal187e7f8ae725d0d7c586a97e85953c03); ?>
<?php endif; ?>
        <div></div>
        <div class="full"><?php if (isset($component)) { $__componentOriginal476f61439eeae8df707de09aa02d10cc = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal476f61439eeae8df707de09aa02d10cc = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.admin.rich-text','data' => ['name' => 'description','label' => 'Short description','value' => $item?->description,'placeholder' => 'Write a short description for gallery cards or media references...']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('admin.rich-text'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'description','label' => 'Short description','value' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($item?->description),'placeholder' => 'Write a short description for gallery cards or media references...']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal476f61439eeae8df707de09aa02d10cc)): ?>
<?php $attributes = $__attributesOriginal476f61439eeae8df707de09aa02d10cc; ?>
<?php unset($__attributesOriginal476f61439eeae8df707de09aa02d10cc); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal476f61439eeae8df707de09aa02d10cc)): ?>
<?php $component = $__componentOriginal476f61439eeae8df707de09aa02d10cc; ?>
<?php unset($__componentOriginal476f61439eeae8df707de09aa02d10cc); ?>
<?php endif; ?></div>
        <?php if (! ($isVideo)): ?>
            <div class="full"><?php if (isset($component)) { $__componentOriginal187e7f8ae725d0d7c586a97e85953c03 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal187e7f8ae725d0d7c586a97e85953c03 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.admin.input','data' => ['name' => 'fallback_text','label' => 'Message when this image cannot load','value' => $item?->fallback_text,'placeholder' => 'Example: Portrait image is not available.']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('admin.input'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'fallback_text','label' => 'Message when this image cannot load','value' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($item?->fallback_text),'placeholder' => 'Example: Portrait image is not available.']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal187e7f8ae725d0d7c586a97e85953c03)): ?>
<?php $attributes = $__attributesOriginal187e7f8ae725d0d7c586a97e85953c03; ?>
<?php unset($__attributesOriginal187e7f8ae725d0d7c586a97e85953c03); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal187e7f8ae725d0d7c586a97e85953c03)): ?>
<?php $component = $__componentOriginal187e7f8ae725d0d7c586a97e85953c03; ?>
<?php unset($__componentOriginal187e7f8ae725d0d7c586a97e85953c03); ?>
<?php endif; ?></div>
        <?php endif; ?>
    </div>
</section>

<?php if($isVideo): ?>
    <section class="form-section">
        <div class="form-section-heading"><h2>YouTube video</h2></div>
        <div class="form-grid">
            <div class="full"><?php if (isset($component)) { $__componentOriginal187e7f8ae725d0d7c586a97e85953c03 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal187e7f8ae725d0d7c586a97e85953c03 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.admin.input','data' => ['name' => 'youtube_url','label' => 'YouTube video URL','value' => $item?->youtube_url,'required' => true,'placeholder' => 'https://www.youtube.com/watch?v=...']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('admin.input'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'youtube_url','label' => 'YouTube video URL','value' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($item?->youtube_url),'required' => true,'placeholder' => 'https://www.youtube.com/watch?v=...']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal187e7f8ae725d0d7c586a97e85953c03)): ?>
<?php $attributes = $__attributesOriginal187e7f8ae725d0d7c586a97e85953c03; ?>
<?php unset($__attributesOriginal187e7f8ae725d0d7c586a97e85953c03); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal187e7f8ae725d0d7c586a97e85953c03)): ?>
<?php $component = $__componentOriginal187e7f8ae725d0d7c586a97e85953c03; ?>
<?php unset($__componentOriginal187e7f8ae725d0d7c586a97e85953c03); ?>
<?php endif; ?></div>
        </div>
    </section>
<?php else: ?>
    <section class="form-section">
        <div class="form-section-heading"><h2>Image upload</h2></div>
        <?php if (isset($component)) { $__componentOriginalbcb09694e99f778f583a494749959515 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalbcb09694e99f778f583a494749959515 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.admin.image-upload','data' => ['name' => 'image','label' => 'Gallery image','current' => $item?->type === 'image' ? $item?->image_url : null]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('admin.image-upload'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'image','label' => 'Gallery image','current' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($item?->type === 'image' ? $item?->image_url : null)]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalbcb09694e99f778f583a494749959515)): ?>
<?php $attributes = $__attributesOriginalbcb09694e99f778f583a494749959515; ?>
<?php unset($__attributesOriginalbcb09694e99f778f583a494749959515); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalbcb09694e99f778f583a494749959515)): ?>
<?php $component = $__componentOriginalbcb09694e99f778f583a494749959515; ?>
<?php unset($__componentOriginalbcb09694e99f778f583a494749959515); ?>
<?php endif; ?>
    </section>
<?php endif; ?>

<section class="form-section">
    <div class="form-section-heading"><h2>Card destination</h2></div>
    <div class="form-grid">
        <?php if (isset($component)) { $__componentOriginal187e7f8ae725d0d7c586a97e85953c03 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal187e7f8ae725d0d7c586a97e85953c03 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.admin.input','data' => ['name' => 'link_name','label' => 'Link name','value' => $item?->link_name,'placeholder' => 'Read interview, Open profile, View source']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('admin.input'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'link_name','label' => 'Link name','value' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($item?->link_name),'placeholder' => 'Read interview, Open profile, View source']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal187e7f8ae725d0d7c586a97e85953c03)): ?>
<?php $attributes = $__attributesOriginal187e7f8ae725d0d7c586a97e85953c03; ?>
<?php unset($__attributesOriginal187e7f8ae725d0d7c586a97e85953c03); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal187e7f8ae725d0d7c586a97e85953c03)): ?>
<?php $component = $__componentOriginal187e7f8ae725d0d7c586a97e85953c03; ?>
<?php unset($__componentOriginal187e7f8ae725d0d7c586a97e85953c03); ?>
<?php endif; ?>
        <?php if (isset($component)) { $__componentOriginal187e7f8ae725d0d7c586a97e85953c03 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal187e7f8ae725d0d7c586a97e85953c03 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.admin.input','data' => ['name' => 'link_url','label' => 'Link URL','value' => $item?->link_url,'placeholder' => '/works?category=films or https://example.com']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('admin.input'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'link_url','label' => 'Link URL','value' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($item?->link_url),'placeholder' => '/works?category=films or https://example.com']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal187e7f8ae725d0d7c586a97e85953c03)): ?>
<?php $attributes = $__attributesOriginal187e7f8ae725d0d7c586a97e85953c03; ?>
<?php unset($__attributesOriginal187e7f8ae725d0d7c586a97e85953c03); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal187e7f8ae725d0d7c586a97e85953c03)): ?>
<?php $component = $__componentOriginal187e7f8ae725d0d7c586a97e85953c03; ?>
<?php unset($__componentOriginal187e7f8ae725d0d7c586a97e85953c03); ?>
<?php endif; ?>
    </div>
</section>

<section class="form-section">
    <div class="form-section-heading"><h2>Choose where to show it</h2></div>
    <div class="checkbox-grid">
        <?php if (isset($component)) { $__componentOriginal87c6c077c3035a937a4bff0b0fef35b1 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal87c6c077c3035a937a4bff0b0fef35b1 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.admin.checkbox','data' => ['name' => 'show_in_gallery','label' => 'Show on public '.e($isVideo ? 'Video Gallery' : 'Image Gallery').' page','checked' => $item?->show_in_gallery ?? ($defaultShowInGallery ?? true)]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('admin.checkbox'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'show_in_gallery','label' => 'Show on public '.e($isVideo ? 'Video Gallery' : 'Image Gallery').' page','checked' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($item?->show_in_gallery ?? ($defaultShowInGallery ?? true))]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal87c6c077c3035a937a4bff0b0fef35b1)): ?>
<?php $attributes = $__attributesOriginal87c6c077c3035a937a4bff0b0fef35b1; ?>
<?php unset($__attributesOriginal87c6c077c3035a937a4bff0b0fef35b1); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal87c6c077c3035a937a4bff0b0fef35b1)): ?>
<?php $component = $__componentOriginal87c6c077c3035a937a4bff0b0fef35b1; ?>
<?php unset($__componentOriginal87c6c077c3035a937a4bff0b0fef35b1); ?>
<?php endif; ?>
        <?php if (isset($component)) { $__componentOriginal87c6c077c3035a937a4bff0b0fef35b1 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal87c6c077c3035a937a4bff0b0fef35b1 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.admin.checkbox','data' => ['name' => 'show_on_home','label' => 'Show in homepage '.e($isVideo ? 'video' : 'image').' gallery section','checked' => $item?->show_on_home ?? ($defaultShowOnHome ?? false)]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('admin.checkbox'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'show_on_home','label' => 'Show in homepage '.e($isVideo ? 'video' : 'image').' gallery section','checked' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($item?->show_on_home ?? ($defaultShowOnHome ?? false))]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal87c6c077c3035a937a4bff0b0fef35b1)): ?>
<?php $attributes = $__attributesOriginal87c6c077c3035a937a4bff0b0fef35b1; ?>
<?php unset($__attributesOriginal87c6c077c3035a937a4bff0b0fef35b1); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal87c6c077c3035a937a4bff0b0fef35b1)): ?>
<?php $component = $__componentOriginal87c6c077c3035a937a4bff0b0fef35b1; ?>
<?php unset($__componentOriginal87c6c077c3035a937a4bff0b0fef35b1); ?>
<?php endif; ?>
        <?php if (isset($component)) { $__componentOriginal87c6c077c3035a937a4bff0b0fef35b1 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal87c6c077c3035a937a4bff0b0fef35b1 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.admin.checkbox','data' => ['name' => 'show_in_profiles','label' => 'Show as a Profiles & Media card','checked' => $item?->show_in_profiles ?? ($defaultShowInProfiles ?? false)]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('admin.checkbox'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'show_in_profiles','label' => 'Show as a Profiles & Media card','checked' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($item?->show_in_profiles ?? ($defaultShowInProfiles ?? false))]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal87c6c077c3035a937a4bff0b0fef35b1)): ?>
<?php $attributes = $__attributesOriginal87c6c077c3035a937a4bff0b0fef35b1; ?>
<?php unset($__attributesOriginal87c6c077c3035a937a4bff0b0fef35b1); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal87c6c077c3035a937a4bff0b0fef35b1)): ?>
<?php $component = $__componentOriginal87c6c077c3035a937a4bff0b0fef35b1; ?>
<?php unset($__componentOriginal87c6c077c3035a937a4bff0b0fef35b1); ?>
<?php endif; ?>
        <?php if (isset($component)) { $__componentOriginal87c6c077c3035a937a4bff0b0fef35b1 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal87c6c077c3035a937a4bff0b0fef35b1 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.admin.checkbox','data' => ['name' => 'show_in_biography','label' => 'Show in Biography '.e($isVideo ? 'videos' : 'gallery').'','checked' => $item?->show_in_biography ?? true]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('admin.checkbox'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'show_in_biography','label' => 'Show in Biography '.e($isVideo ? 'videos' : 'gallery').'','checked' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($item?->show_in_biography ?? true)]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal87c6c077c3035a937a4bff0b0fef35b1)): ?>
<?php $attributes = $__attributesOriginal87c6c077c3035a937a4bff0b0fef35b1; ?>
<?php unset($__attributesOriginal87c6c077c3035a937a4bff0b0fef35b1); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal87c6c077c3035a937a4bff0b0fef35b1)): ?>
<?php $component = $__componentOriginal87c6c077c3035a937a4bff0b0fef35b1; ?>
<?php unset($__componentOriginal87c6c077c3035a937a4bff0b0fef35b1); ?>
<?php endif; ?>
        <?php if (isset($component)) { $__componentOriginal87c6c077c3035a937a4bff0b0fef35b1 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal87c6c077c3035a937a4bff0b0fef35b1 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.admin.checkbox','data' => ['name' => 'is_featured','label' => 'Featured item','checked' => $item?->is_featured ?? false]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('admin.checkbox'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'is_featured','label' => 'Featured item','checked' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($item?->is_featured ?? false)]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal87c6c077c3035a937a4bff0b0fef35b1)): ?>
<?php $attributes = $__attributesOriginal87c6c077c3035a937a4bff0b0fef35b1; ?>
<?php unset($__attributesOriginal87c6c077c3035a937a4bff0b0fef35b1); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal87c6c077c3035a937a4bff0b0fef35b1)): ?>
<?php $component = $__componentOriginal87c6c077c3035a937a4bff0b0fef35b1; ?>
<?php unset($__componentOriginal87c6c077c3035a937a4bff0b0fef35b1); ?>
<?php endif; ?>
        <?php if (isset($component)) { $__componentOriginal87c6c077c3035a937a4bff0b0fef35b1 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal87c6c077c3035a937a4bff0b0fef35b1 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.admin.checkbox','data' => ['name' => 'is_active','label' => 'Item is active','checked' => $item?->is_active ?? true]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('admin.checkbox'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'is_active','label' => 'Item is active','checked' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($item?->is_active ?? true)]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal87c6c077c3035a937a4bff0b0fef35b1)): ?>
<?php $attributes = $__attributesOriginal87c6c077c3035a937a4bff0b0fef35b1; ?>
<?php unset($__attributesOriginal87c6c077c3035a937a4bff0b0fef35b1); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal87c6c077c3035a937a4bff0b0fef35b1)): ?>
<?php $component = $__componentOriginal87c6c077c3035a937a4bff0b0fef35b1; ?>
<?php unset($__componentOriginal87c6c077c3035a937a4bff0b0fef35b1); ?>
<?php endif; ?>
    </div>
</section>
<?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/laravel/shamima-nazneen/resources/views/admin/media-items/_form.blade.php ENDPATH**/ ?>