<?php
    $record = $work ?? null;
    $externalLinks = old('external_links', $record?->external_links);
    if (blank($externalLinks)) {
        $externalLinks = [[
            'label' => $record?->link_name,
            'url' => $record?->link_url,
        ]];
    }
?>
<section class="form-section">
    <div class="form-section-heading"><h2>Work information</h2><p>The production year is optional. Add it when the verified year is available.</p></div>
    <div class="form-grid three">
        <?php if (isset($component)) { $__componentOriginalcaa826401539fc57a784dadbb5b3020d = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalcaa826401539fc57a784dadbb5b3020d = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.admin.select','data' => ['name' => 'category_id','label' => 'Work category','options' => $categories->pluck('name','id')->all(),'value' => $record?->category_id,'required' => true]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('admin.select'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'category_id','label' => 'Work category','options' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($categories->pluck('name','id')->all()),'value' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($record?->category_id),'required' => true]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalcaa826401539fc57a784dadbb5b3020d)): ?>
<?php $attributes = $__attributesOriginalcaa826401539fc57a784dadbb5b3020d; ?>
<?php unset($__attributesOriginalcaa826401539fc57a784dadbb5b3020d); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalcaa826401539fc57a784dadbb5b3020d)): ?>
<?php $component = $__componentOriginalcaa826401539fc57a784dadbb5b3020d; ?>
<?php unset($__componentOriginalcaa826401539fc57a784dadbb5b3020d); ?>
<?php endif; ?>
        <?php if (isset($component)) { $__componentOriginal187e7f8ae725d0d7c586a97e85953c03 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal187e7f8ae725d0d7c586a97e85953c03 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.admin.input','data' => ['name' => 'title','label' => 'Work name','value' => $record?->title,'required' => true,'placeholder' => 'Enter the film, drama, theatre, or project name']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('admin.input'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'title','label' => 'Work name','value' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($record?->title),'required' => true,'placeholder' => 'Enter the film, drama, theatre, or project name']); ?>
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
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.admin.input','data' => ['name' => 'year','label' => 'Release / production year','type' => 'number','value' => $record?->year,'min' => '1900','max' => date('Y') + 5,'placeholder' => '2024','help' => 'Optional. Leave it blank if the production year is not confirmed yet.']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('admin.input'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'year','label' => 'Release / production year','type' => 'number','value' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($record?->year),'min' => '1900','max' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(date('Y') + 5),'placeholder' => '2024','help' => 'Optional. Leave it blank if the production year is not confirmed yet.']); ?>
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
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.admin.input','data' => ['name' => 'credit','label' => 'Credit','value' => $record?->credit,'placeholder' => 'Actor, Director, Guest appearance']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('admin.input'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'credit','label' => 'Credit','value' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($record?->credit),'placeholder' => 'Actor, Director, Guest appearance']); ?>
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
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.admin.input','data' => ['name' => 'role','label' => 'Character / role','value' => $record?->role,'placeholder' => 'Example: Lead character, Guest artist']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('admin.input'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'role','label' => 'Character / role','value' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($record?->role),'placeholder' => 'Example: Lead character, Guest artist']); ?>
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
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.admin.input','data' => ['name' => 'platform','label' => 'Channel / platform','value' => $record?->platform,'placeholder' => 'BTV, YouTube, Chorki...']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('admin.input'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'platform','label' => 'Channel / platform','value' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($record?->platform),'placeholder' => 'BTV, YouTube, Chorki...']); ?>
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
        <div class="full"><?php if (isset($component)) { $__componentOriginal476f61439eeae8df707de09aa02d10cc = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal476f61439eeae8df707de09aa02d10cc = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.admin.rich-text','data' => ['name' => 'short_description','label' => 'Short description shown in View Details','value' => $record?->short_description,'required' => true,'help' => 'This rich-text content appears inside the public popup after a visitor clicks View Details.']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('admin.rich-text'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'short_description','label' => 'Short description shown in View Details','value' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($record?->short_description),'required' => true,'help' => 'This rich-text content appears inside the public popup after a visitor clicks View Details.']); ?>
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
        <div class="full"><?php if (isset($component)) { $__componentOriginalb8b08ac0decf1f19f62a9c23517ed2bd = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalb8b08ac0decf1f19f62a9c23517ed2bd = $attributes; } ?>
<?php $component = App\View\Components\Admin\MediaLibrarySelect::resolve(['name' => 'library_media_id','label' => 'Choose poster from Image Gallery','currentPath' => $record?->image_path] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
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
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.admin.image-upload','data' => ['name' => 'image','label' => 'Or upload a new poster / work image','current' => $record?->image_url,'help' => 'A new upload is automatically added to Image Gallery.']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('admin.image-upload'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'image','label' => 'Or upload a new poster / work image','current' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($record?->image_url),'help' => 'A new upload is automatically added to Image Gallery.']); ?>
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
    <div class="form-section-heading">
        <h2>Optional external links</h2>
        <p>Add one or more named links. They appear inside the View Details popup and beside the work where the layout supports it.</p>
    </div>
    <div class="repeatable-list" data-repeatable-links data-repeatable-name="external_links" data-next-index="<?php echo e(count($externalLinks)); ?>">
        <div class="repeatable-list-rows" data-repeatable-rows>
            <?php $__currentLoopData = $externalLinks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $link): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php
                    $labelErrorKey = "external_links.$index.label";
                    $urlErrorKey = "external_links.$index.url";
                ?>
                <div class="repeatable-link-row" data-repeatable-row>
                    <div class="form-field <?php echo e($errors->has($labelErrorKey) ? 'has-error' : ''); ?>" data-field-wrapper data-field-name="<?php echo e($labelErrorKey); ?>">
                        <label for="external_links_<?php echo e($index); ?>_label">Link name</label>
                        <input id="external_links_<?php echo e($index); ?>_label" name="external_links[<?php echo e($index); ?>][label]" type="text" value="<?php echo e($link['label'] ?? ''); ?>" maxlength="120" <?php if($errors->has($labelErrorKey)): ?> aria-invalid="true" aria-describedby="external_links_<?php echo e($index); ?>_label_error" <?php endif; ?>>
                        <?php $__errorArgs = [$labelErrorKey];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><small id="external_links_<?php echo e($index); ?>_label_error" class="field-error"><?php echo e($message); ?></small><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                    <div class="form-field <?php echo e($errors->has($urlErrorKey) ? 'has-error' : ''); ?>" data-field-wrapper data-field-name="<?php echo e($urlErrorKey); ?>">
                        <label for="external_links_<?php echo e($index); ?>_url">Link URL</label>
                        <input id="external_links_<?php echo e($index); ?>_url" name="external_links[<?php echo e($index); ?>][url]" type="text" value="<?php echo e($link['url'] ?? ''); ?>" maxlength="500" <?php if($errors->has($urlErrorKey)): ?> aria-invalid="true" aria-describedby="external_links_<?php echo e($index); ?>_url_error" <?php endif; ?>>
                        <?php $__errorArgs = [$urlErrorKey];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><small id="external_links_<?php echo e($index); ?>_url_error" class="field-error"><?php echo e($message); ?></small><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                    <button class="admin-button danger small repeatable-remove" type="button" data-repeatable-remove>Remove</button>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
        <button class="admin-button secondary" type="button" data-repeatable-add>Add Another Link</button>
        <template data-repeatable-template>
            <div class="repeatable-link-row" data-repeatable-row>
                <div class="form-field">
                    <label>Link name</label>
                    <input data-field="label" type="text" maxlength="120">
                </div>
                <div class="form-field">
                    <label>Link URL</label>
                    <input data-field="url" type="text" maxlength="500">
                </div>
                <button class="admin-button danger small repeatable-remove" type="button" data-repeatable-remove>Remove</button>
            </div>
        </template>
    </div>
</section>
<section class="form-section">
    <div class="form-section-heading"><h2>Display settings</h2></div>
    <div class="checkbox-grid">
        <?php if (isset($component)) { $__componentOriginal87c6c077c3035a937a4bff0b0fef35b1 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal87c6c077c3035a937a4bff0b0fef35b1 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.admin.checkbox','data' => ['name' => 'is_featured','label' => 'Featured work','checked' => $record?->is_featured ?? false,'help' => 'Prioritizes this entry where the design supports featured work.']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('admin.checkbox'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'is_featured','label' => 'Featured work','checked' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($record?->is_featured ?? false),'help' => 'Prioritizes this entry where the design supports featured work.']); ?>
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
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.admin.checkbox','data' => ['name' => 'show_on_home','label' => 'Show on home page','checked' => $record?->show_on_home ?? ($defaultShowOnHome ?? false),'help' => 'Displays it in the matching home-page work section.']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('admin.checkbox'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'show_on_home','label' => 'Show on home page','checked' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($record?->show_on_home ?? ($defaultShowOnHome ?? false)),'help' => 'Displays it in the matching home-page work section.']); ?>
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
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.admin.checkbox','data' => ['name' => 'is_active','label' => 'Publicly visible','checked' => $record?->is_active ?? true,'help' => 'Inactive entries stay saved but disappear from the website.']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('admin.checkbox'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'is_active','label' => 'Publicly visible','checked' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($record?->is_active ?? true),'help' => 'Inactive entries stay saved but disappear from the website.']); ?>
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
<?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/laravel/shamima-nazneen/resources/views/admin/works/_form.blade.php ENDPATH**/ ?>