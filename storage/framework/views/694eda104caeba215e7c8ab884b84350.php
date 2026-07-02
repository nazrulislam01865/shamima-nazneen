<?php $__env->startSection('title', 'Site Identity & SEO'); ?>
<?php $__env->startSection('page_title', 'Site Identity & SEO'); ?>
<?php $__env->startSection('page_context', 'General Settings'); ?>

<?php $__env->startSection('content'); ?>
<?php if (isset($component)) { $__componentOriginalcb19cb35a534439097b02b8af91726ee = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalcb19cb35a534439097b02b8af91726ee = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.admin.page-header','data' => ['title' => 'Site Identity & SEO','description' => 'Control the website identity, logo, favicon, contact details, Profiles & Media card links, footer, and search metadata.']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('admin.page-header'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'Site Identity & SEO','description' => 'Control the website identity, logo, favicon, contact details, Profiles & Media card links, footer, and search metadata.']); ?>
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

<form class="admin-form" action="<?php echo e(route('admin.settings.update')); ?>" method="POST" enctype="multipart/form-data" data-disable-on-submit>
    <?php echo csrf_field(); ?>
    <?php echo method_field('PUT'); ?>

    <section class="form-section">
        <div class="form-section-heading"><h2>Brand identity</h2><p>Upload the official logo and browser favicon. Both can be replaced at any time.</p></div>
        <div class="form-grid">
            <?php if (isset($component)) { $__componentOriginal187e7f8ae725d0d7c586a97e85953c03 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal187e7f8ae725d0d7c586a97e85953c03 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.admin.input','data' => ['name' => 'site_name','label' => 'Website name','value' => $settings->site_name,'required' => true,'placeholder' => 'Example: Shamima Nazneen']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('admin.input'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'site_name','label' => 'Website name','value' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($settings->site_name),'required' => true,'placeholder' => 'Example: Shamima Nazneen']); ?>
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
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.admin.input','data' => ['name' => 'tagline','label' => 'Professional tagline','value' => $settings->tagline,'placeholder' => 'Example: Actress, director, and theatre personality']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('admin.input'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'tagline','label' => 'Professional tagline','value' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($settings->tagline),'placeholder' => 'Example: Actress, director, and theatre personality']); ?>
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
            <div class="full"><?php if (isset($component)) { $__componentOriginalb8b08ac0decf1f19f62a9c23517ed2bd = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalb8b08ac0decf1f19f62a9c23517ed2bd = $attributes; } ?>
<?php $component = App\View\Components\Admin\MediaLibrarySelect::resolve(['name' => 'logo_media_id','label' => 'Choose logo from Image Gallery','currentPath' => $settings->logo_path] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('admin.media-library-select'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\Admin\MediaLibrarySelect::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalb8b08ac0decf1f19f62a9c23517ed2bd)): ?>
<?php $attributes = $__attributesOriginalb8b08ac0decf1f19f62a9c23517ed2bd; ?>
<?php unset($__attributesOriginalb8b08ac0decf1f19f62a9c23517ed2bd); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalb8b08ac0decf1f19f62a9c23517ed2bd)): ?>
<?php $component = $__componentOriginalb8b08ac0decf1f19f62a9c23517ed2bd; ?>
<?php unset($__componentOriginalb8b08ac0decf1f19f62a9c23517ed2bd); ?>
<?php endif; ?></div>
            <div class="full"><?php if (isset($component)) { $__componentOriginalbcb09694e99f778f583a494749959515 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalbcb09694e99f778f583a494749959515 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.admin.image-upload','data' => ['name' => 'logo','label' => 'Or upload a new website logo','current' => $settings->logo_url,'removeName' => 'remove_logo','help' => 'PNG, JPG, or WEBP. A new upload is automatically added to Image Gallery.']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('admin.image-upload'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'logo','label' => 'Or upload a new website logo','current' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($settings->logo_url),'remove-name' => 'remove_logo','help' => 'PNG, JPG, or WEBP. A new upload is automatically added to Image Gallery.']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalbcb09694e99f778f583a494749959515)): ?>
<?php $attributes = $__attributesOriginalbcb09694e99f778f583a494749959515; ?>
<?php unset($__attributesOriginalbcb09694e99f778f583a494749959515); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalbcb09694e99f778f583a494749959515)): ?>
<?php $component = $__componentOriginalbcb09694e99f778f583a494749959515; ?>
<?php unset($__componentOriginalbcb09694e99f778f583a494749959515); ?>
<?php endif; ?></div>
            <div class="full"><?php if (isset($component)) { $__componentOriginalb8b08ac0decf1f19f62a9c23517ed2bd = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalb8b08ac0decf1f19f62a9c23517ed2bd = $attributes; } ?>
<?php $component = App\View\Components\Admin\MediaLibrarySelect::resolve(['name' => 'favicon_media_id','label' => 'Choose favicon from Image Gallery','currentPath' => $settings->favicon_path] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('admin.media-library-select'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\Admin\MediaLibrarySelect::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalb8b08ac0decf1f19f62a9c23517ed2bd)): ?>
<?php $attributes = $__attributesOriginalb8b08ac0decf1f19f62a9c23517ed2bd; ?>
<?php unset($__attributesOriginalb8b08ac0decf1f19f62a9c23517ed2bd); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalb8b08ac0decf1f19f62a9c23517ed2bd)): ?>
<?php $component = $__componentOriginalb8b08ac0decf1f19f62a9c23517ed2bd; ?>
<?php unset($__componentOriginalb8b08ac0decf1f19f62a9c23517ed2bd); ?>
<?php endif; ?></div>
            <div class="full"><?php if (isset($component)) { $__componentOriginalbcb09694e99f778f583a494749959515 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalbcb09694e99f778f583a494749959515 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.admin.image-upload','data' => ['name' => 'favicon','label' => 'Or upload a new browser favicon','current' => $settings->favicon_url,'removeName' => 'remove_favicon','help' => 'PNG, ICO, WEBP, or JPG. A new upload is automatically added to Image Gallery.']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('admin.image-upload'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'favicon','label' => 'Or upload a new browser favicon','current' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($settings->favicon_url),'remove-name' => 'remove_favicon','help' => 'PNG, ICO, WEBP, or JPG. A new upload is automatically added to Image Gallery.']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalbcb09694e99f778f583a494749959515)): ?>
<?php $attributes = $__attributesOriginalbcb09694e99f778f583a494749959515; ?>
<?php unset($__attributesOriginalbcb09694e99f778f583a494749959515); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalbcb09694e99f778f583a494749959515)): ?>
<?php $component = $__componentOriginalbcb09694e99f778f583a494749959515; ?>
<?php unset($__componentOriginalbcb09694e99f778f583a494749959515); ?>
<?php endif; ?></div>
        </div>
    </section>

    <section class="form-section">
        <div class="form-section-heading"><h2>Official contact information</h2><p>These details appear in the public contact area and footer where applicable.</p></div>
        <div class="form-grid">
            <?php if (isset($component)) { $__componentOriginal187e7f8ae725d0d7c586a97e85953c03 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal187e7f8ae725d0d7c586a97e85953c03 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.admin.input','data' => ['name' => 'email','label' => 'Official email','type' => 'email','value' => $settings->email,'placeholder' => 'Example: contact@example.com']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('admin.input'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'email','label' => 'Official email','type' => 'email','value' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($settings->email),'placeholder' => 'Example: contact@example.com']); ?>
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
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.admin.input','data' => ['name' => 'phone','label' => 'Phone number','value' => $settings->phone,'placeholder' => 'Example: +880 1XXXXXXXXX']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('admin.input'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'phone','label' => 'Phone number','value' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($settings->phone),'placeholder' => 'Example: +880 1XXXXXXXXX']); ?>
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
            <div class="full"><?php if (isset($component)) { $__componentOriginal694712473b787cd740db4e46be9da3f9 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal694712473b787cd740db4e46be9da3f9 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.admin.textarea','data' => ['name' => 'address','label' => 'Address','value' => $settings->address,'rows' => '3','placeholder' => 'Write the official office or contact address']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('admin.textarea'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'address','label' => 'Address','value' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($settings->address),'rows' => '3','placeholder' => 'Write the official office or contact address']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal694712473b787cd740db4e46be9da3f9)): ?>
<?php $attributes = $__attributesOriginal694712473b787cd740db4e46be9da3f9; ?>
<?php unset($__attributesOriginal694712473b787cd740db4e46be9da3f9); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal694712473b787cd740db4e46be9da3f9)): ?>
<?php $component = $__componentOriginal694712473b787cd740db4e46be9da3f9; ?>
<?php unset($__componentOriginal694712473b787cd740db4e46be9da3f9); ?>
<?php endif; ?></div>
            <?php if (isset($component)) { $__componentOriginal187e7f8ae725d0d7c586a97e85953c03 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal187e7f8ae725d0d7c586a97e85953c03 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.admin.input','data' => ['name' => 'media_inquiry_label','label' => 'Media inquiry label','value' => $settings->media_inquiry_label,'required' => true,'placeholder' => 'Example: Media & Professional Inquiries','help' => 'Used as the label for media and professional contact links.']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('admin.input'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'media_inquiry_label','label' => 'Media inquiry label','value' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($settings->media_inquiry_label),'required' => true,'placeholder' => 'Example: Media & Professional Inquiries','help' => 'Used as the label for media and professional contact links.']); ?>
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
            <div class="full"><?php if (isset($component)) { $__componentOriginal694712473b787cd740db4e46be9da3f9 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal694712473b787cd740db4e46be9da3f9 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.admin.textarea','data' => ['name' => 'footer_text','label' => 'Footer description','value' => $settings->footer_text,'rows' => '4','placeholder' => 'Write a short description to display in the website footer']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('admin.textarea'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'footer_text','label' => 'Footer description','value' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($settings->footer_text),'rows' => '4','placeholder' => 'Write a short description to display in the website footer']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal694712473b787cd740db4e46be9da3f9)): ?>
<?php $attributes = $__attributesOriginal694712473b787cd740db4e46be9da3f9; ?>
<?php unset($__attributesOriginal694712473b787cd740db4e46be9da3f9); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal694712473b787cd740db4e46be9da3f9)): ?>
<?php $component = $__componentOriginal694712473b787cd740db4e46be9da3f9; ?>
<?php unset($__componentOriginal694712473b787cd740db4e46be9da3f9); ?>
<?php endif; ?></div>
            <div class="full"><?php if (isset($component)) { $__componentOriginal187e7f8ae725d0d7c586a97e85953c03 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal187e7f8ae725d0d7c586a97e85953c03 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.admin.input','data' => ['name' => 'image_fallback_text','label' => 'Missing image message','value' => $settings->image_fallback_text ?: 'Image is not available.','required' => true,'placeholder' => 'Example: Image is not available right now.','help' => 'This text replaces the broken-image icon anywhere an image cannot be loaded.']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('admin.input'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'image_fallback_text','label' => 'Missing image message','value' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($settings->image_fallback_text ?: 'Image is not available.'),'required' => true,'placeholder' => 'Example: Image is not available right now.','help' => 'This text replaces the broken-image icon anywhere an image cannot be loaded.']); ?>
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

    <?php
        $profileCardLinks = old('profile_card_links', $settings->profile_card_links ?? []);
        if (blank($profileCardLinks)) {
            $profileCardLinks = [['title' => '', 'url' => '', 'description' => '', 'icon_path' => '']];
        }
        $profileCardNextIndex = collect(array_keys((array) $profileCardLinks))
            ->filter(fn ($key) => is_numeric($key))
            ->map(fn ($key) => (int) $key)
            ->max();
        $profileCardNextIndex = is_null($profileCardNextIndex) ? count($profileCardLinks) : $profileCardNextIndex + 1;
    ?>
    <section class="form-section" id="profiles-media-links">
        <div class="form-section-heading">
            <h2>Profiles and media card links</h2>
            <p>Add as many homepage profile or media links as needed. Upload a custom logo for each link, or leave it empty to use the automatic logo.</p>
        </div>

        <div class="repeatable-list" data-repeatable-links data-repeatable-name="profile_card_links" data-next-index="<?php echo e($profileCardNextIndex); ?>">
            <div class="repeatable-list-rows" data-repeatable-rows>
                <?php $__currentLoopData = $profileCardLinks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $profileLink): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php
                        $iconPath = $profileLink['icon_path'] ?? $profileLink['current_icon_path'] ?? null;
                        $iconUrl = \App\Support\Media::url($iconPath);
                        $titleErrorKey = "profile_card_links.$index.title";
                        $urlErrorKey = "profile_card_links.$index.url";
                        $iconErrorKey = "profile_card_links.$index.icon";
                        $currentIconErrorKey = "profile_card_links.$index.current_icon_path";
                        $descriptionErrorKey = "profile_card_links.$index.description";
                    ?>
                    <div class="repeatable-link-row profile-card-link-row" data-repeatable-row>
                        <div class="form-field <?php echo e($errors->has($titleErrorKey) ? 'has-error' : ''); ?>" data-field-wrapper data-field-name="<?php echo e($titleErrorKey); ?>">
                            <label for="profile_card_links_<?php echo e($index); ?>_title">Card name</label>
                            <input id="profile_card_links_<?php echo e($index); ?>_title" name="profile_card_links[<?php echo e($index); ?>][title]" type="text" value="<?php echo e($profileLink['title'] ?? ''); ?>" maxlength="120" <?php if($errors->has($titleErrorKey)): ?> aria-invalid="true" aria-describedby="profile_card_links_<?php echo e($index); ?>_title_error" <?php endif; ?>>
                            <?php $__errorArgs = [$titleErrorKey];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><small id="profile_card_links_<?php echo e($index); ?>_title_error" class="field-error"><?php echo e($message); ?></small><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>
                        <div class="form-field <?php echo e($errors->has($urlErrorKey) ? 'has-error' : ''); ?>" data-field-wrapper data-field-name="<?php echo e($urlErrorKey); ?>">
                            <label for="profile_card_links_<?php echo e($index); ?>_url">Link URL</label>
                            <input id="profile_card_links_<?php echo e($index); ?>_url" name="profile_card_links[<?php echo e($index); ?>][url]" type="text" value="<?php echo e($profileLink['url'] ?? ''); ?>" maxlength="500" <?php if($errors->has($urlErrorKey)): ?> aria-invalid="true" aria-describedby="profile_card_links_<?php echo e($index); ?>_url_error" <?php endif; ?>>
                            <?php $__errorArgs = [$urlErrorKey];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><small id="profile_card_links_<?php echo e($index); ?>_url_error" class="field-error"><?php echo e($message); ?></small><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>
                        <div class="form-field profile-card-logo-field <?php echo e(($errors->has($iconErrorKey) || $errors->has($currentIconErrorKey)) ? 'has-error' : ''); ?>" data-image-upload data-field-wrapper data-field-name="<?php echo e($iconErrorKey); ?>">
                            <label for="profile_card_links_<?php echo e($index); ?>_icon">Logo image</label>
                            <input type="hidden" name="profile_card_links[<?php echo e($index); ?>][current_icon_path]" value="<?php echo e($iconPath); ?>">
                            <div class="profile-card-logo-upload">
                                <div class="profile-card-logo-preview <?php echo e($iconUrl ? 'has-image' : ''); ?>" data-image-preview>
                                    <?php if($iconUrl): ?>
                                        <img src="<?php echo e($iconUrl); ?>" alt="<?php echo e(($profileLink['title'] ?? 'Profile')); ?> logo" data-fallback-text="Profile logo is not available.">
                                    <?php else: ?>
                                        <span>Auto logo will be used</span>
                                    <?php endif; ?>
                                </div>
                                <div class="profile-card-logo-actions">
                                    <input id="profile_card_links_<?php echo e($index); ?>_icon" name="profile_card_links[<?php echo e($index); ?>][icon]" type="file" accept="image/png,image/jpeg,image/webp" data-image-input <?php if($errors->has($iconErrorKey) || $errors->has($currentIconErrorKey)): ?> aria-invalid="true" aria-describedby="profile_card_links_<?php echo e($index); ?>_icon_error" <?php endif; ?>>
                                    <?php if($iconPath): ?>
                                        <label class="remove-file"><input type="checkbox" name="profile_card_links[<?php echo e($index); ?>][remove_icon]" value="1"> Remove custom logo and use auto logo</label>
                                    <?php endif; ?>
                                    <small>Optional. Upload a square PNG, JPG, or WEBP logo. If empty, the website will use the automatic logo.</small>
                                    <?php $__errorArgs = [$iconErrorKey];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><small id="profile_card_links_<?php echo e($index); ?>_icon_error" class="field-error"><?php echo e($message); ?></small><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                    <?php $__errorArgs = [$currentIconErrorKey];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><small class="field-error"><?php echo e($message); ?></small><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>
                            </div>
                        </div>
                        <div class="form-field profile-card-description-field <?php echo e($errors->has($descriptionErrorKey) ? 'has-error' : ''); ?>" data-field-wrapper data-field-name="<?php echo e($descriptionErrorKey); ?>">
                            <label for="profile_card_links_<?php echo e($index); ?>_description">Card description</label>
                            <textarea id="profile_card_links_<?php echo e($index); ?>_description" name="profile_card_links[<?php echo e($index); ?>][description]" rows="3" maxlength="500" <?php if($errors->has($descriptionErrorKey)): ?> aria-invalid="true" aria-describedby="profile_card_links_<?php echo e($index); ?>_description_error" <?php endif; ?>><?php echo e($profileLink['description'] ?? ''); ?></textarea>
                            <?php $__errorArgs = [$descriptionErrorKey];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><small id="profile_card_links_<?php echo e($index); ?>_description_error" class="field-error"><?php echo e($message); ?></small><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>
                        <button class="admin-button danger small repeatable-remove" type="button" data-repeatable-remove>Remove</button>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>

            <button class="admin-button secondary" type="button" data-repeatable-add>Add Another Profile or Media Link</button>

            <template data-repeatable-template>
                <div class="repeatable-link-row profile-card-link-row" data-repeatable-row>
                    <div class="form-field">
                        <label>Card name</label>
                        <input data-field="title" type="text" maxlength="120">
                    </div>
                    <div class="form-field">
                        <label>Link URL</label>
                        <input data-field="url" type="text" maxlength="500">
                    </div>
                    <div class="form-field profile-card-logo-field" data-image-upload>
                        <label>Logo image</label>
                        <input data-field="current_icon_path" type="hidden" value="">
                        <div class="profile-card-logo-upload">
                            <div class="profile-card-logo-preview" data-image-preview><span>Auto logo will be used</span></div>
                            <div class="profile-card-logo-actions">
                                <input data-field="icon" type="file" accept="image/png,image/jpeg,image/webp" data-image-input>
                                <small>Optional. Upload a square PNG, JPG, or WEBP logo. If empty, the website will use the automatic logo.</small>
                            </div>
                        </div>
                    </div>
                    <div class="form-field profile-card-description-field">
                        <label>Card description</label>
                        <textarea data-field="description" rows="3" maxlength="500"></textarea>
                    </div>
                    <button class="admin-button danger small repeatable-remove" type="button" data-repeatable-remove>Remove</button>
                </div>
            </template>
        </div>
    </section>

    <section class="form-section">
        <div class="form-section-heading"><h2>Search engine information</h2><p>Used for the browser title and search-engine preview.</p></div>
        <div class="form-grid">
            <div class="full"><?php if (isset($component)) { $__componentOriginal187e7f8ae725d0d7c586a97e85953c03 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal187e7f8ae725d0d7c586a97e85953c03 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.admin.input','data' => ['name' => 'seo_title','label' => 'SEO title','value' => $settings->seo_title,'maxlength' => '255','placeholder' => 'Example: Shamima Nazneen | Actress, Director & Theatre Personality']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('admin.input'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'seo_title','label' => 'SEO title','value' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($settings->seo_title),'maxlength' => '255','placeholder' => 'Example: Shamima Nazneen | Actress, Director & Theatre Personality']); ?>
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
            <div class="full"><?php if (isset($component)) { $__componentOriginal694712473b787cd740db4e46be9da3f9 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal694712473b787cd740db4e46be9da3f9 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.admin.textarea','data' => ['name' => 'seo_description','label' => 'SEO description','value' => $settings->seo_description,'rows' => '4','maxlength' => '500','placeholder' => 'Write a clear summary for search engines and social sharing previews']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('admin.textarea'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'seo_description','label' => 'SEO description','value' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($settings->seo_description),'rows' => '4','maxlength' => '500','placeholder' => 'Write a clear summary for search engines and social sharing previews']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal694712473b787cd740db4e46be9da3f9)): ?>
<?php $attributes = $__attributesOriginal694712473b787cd740db4e46be9da3f9; ?>
<?php unset($__attributesOriginal694712473b787cd740db4e46be9da3f9); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal694712473b787cd740db4e46be9da3f9)): ?>
<?php $component = $__componentOriginal694712473b787cd740db4e46be9da3f9; ?>
<?php unset($__componentOriginal694712473b787cd740db4e46be9da3f9); ?>
<?php endif; ?></div>
        </div>
    </section>

    <?php if (isset($component)) { $__componentOriginal661c5ca87570cde504c602ae668d3776 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal661c5ca87570cde504c602ae668d3776 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.admin.form-actions','data' => ['cancel' => route('admin.dashboard'),'submit' => 'Save Site Settings']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('admin.form-actions'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['cancel' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(route('admin.dashboard')),'submit' => 'Save Site Settings']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal661c5ca87570cde504c602ae668d3776)): ?>
<?php $attributes = $__attributesOriginal661c5ca87570cde504c602ae668d3776; ?>
<?php unset($__attributesOriginal661c5ca87570cde504c602ae668d3776); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal661c5ca87570cde504c602ae668d3776)): ?>
<?php $component = $__componentOriginal661c5ca87570cde504c602ae668d3776; ?>
<?php unset($__componentOriginal661c5ca87570cde504c602ae668d3776); ?>
<?php endif; ?>
</form>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/laravel/shamima-nazneen/resources/views/admin/settings/edit.blade.php ENDPATH**/ ?>