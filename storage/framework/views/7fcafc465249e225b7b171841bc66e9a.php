<?php
    $errorKey = str_replace(['][', '[', ']'], ['.', '.', ''], $name);
    $inputId = preg_replace('/[^A-Za-z0-9_-]+/', '_', $errorKey);
    $errorId = $inputId.'_error';
    $hasError = $errors->has($errorKey);
    $selectedValue = old($errorKey, $selectedId);
    $selectedItem = $items->firstWhere('id', (int) $selectedValue);
    $previewUrl = $selectedItem?->image_url ?: $currentUrl;
    $previewTitle = $selectedItem?->title ?: ($currentUrl ? 'Current uploaded image' : 'No '.($typeLabel ?? 'image').' selected');
    $previewAlt = $selectedItem?->alt_text ?: $previewTitle;
?>
<div class="form-field media-picker-field <?php echo e($hasError ? 'has-error' : ''); ?> <?php echo e($attributes->get('class')); ?>" data-media-picker data-media-kind="<?php echo e($typeLabel ?? 'image'); ?>" data-field-wrapper data-field-name="<?php echo e($errorKey); ?>" data-current-url="<?php echo e($currentUrl); ?>" data-current-title="<?php echo e($currentUrl ? 'Current uploaded image' : 'No '.($typeLabel ?? 'image').' selected'); ?>" data-current-alt="<?php echo e($currentUrl ? 'Current uploaded image' : 'No '.($typeLabel ?? 'image').' selected'); ?>">
    <label for="<?php echo e($inputId); ?>"><?php echo e($label); ?></label>
    <input id="<?php echo e($inputId); ?>" type="hidden" name="<?php echo e($name); ?>" value="<?php echo e($selectedValue); ?>" data-media-picker-input <?php if($hasError): ?> aria-invalid="true" aria-describedby="<?php echo e($errorId); ?>" <?php endif; ?>>

    <div class="media-picker-preview" data-media-picker-preview class="<?php echo \Illuminate\Support\Arr::toCssClasses(['has-image' => filled($previewUrl)]); ?>">
        <?php if($previewUrl): ?>
            <img src="<?php echo e($previewUrl); ?>" alt="<?php echo e($previewAlt); ?>" data-media-picker-preview-image>
        <?php else: ?>
            <span data-media-picker-empty>No <?php echo e($typeLabel ?? 'image'); ?> selected yet.</span>
        <?php endif; ?>
        <div>
            <strong data-media-picker-preview-title><?php echo e($previewTitle); ?></strong>
        </div>
    </div>

    <div class="media-picker-toolbar">
        <button class="admin-button secondary small" type="button" data-media-picker-clear>Do not change / use uploaded file below</button>
    </div>

    <?php if($items->isNotEmpty()): ?>
        <div class="media-picker-grid" role="listbox" aria-label="<?php echo e($label); ?>">
            <?php $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $mediaItem): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php
                    $isSelected = (string) $selectedValue === (string) $mediaItem->id;
                    $meta = collect([$mediaItem->category, $mediaItem->year])->filter()->join(' · ');
                    $thumb = $mediaItem->image_url;
                    $cardAlt = $mediaItem->alt_text ?: $mediaItem->title;
                ?>
                <button class="media-picker-card <?php echo e($isSelected ? 'is-selected' : ''); ?>" type="button" role="option" aria-selected="<?php echo e($isSelected ? 'true' : 'false'); ?>" data-media-picker-card data-media-id="<?php echo e($mediaItem->id); ?>" data-media-title="<?php echo e($mediaItem->title); ?>" data-media-alt="<?php echo e($cardAlt); ?>" data-media-url="<?php echo e($thumb); ?>">
                    <span class="media-picker-thumb">
                        <?php if($thumb): ?>
                            <img src="<?php echo e($thumb); ?>" alt="<?php echo e($cardAlt); ?>" loading="lazy" data-fallback-text="<?php echo e($mediaItem->fallback_text ?: 'Preview is not available.'); ?>">
                        <?php else: ?>
                            <span class="media-picker-thumb-empty">No preview</span>
                        <?php endif; ?>
                    </span>
                    <span class="media-picker-copy">
                        <strong><?php echo e($mediaItem->title); ?></strong>
                        <?php if($meta): ?><small><?php echo e($meta); ?></small><?php endif; ?>
                    </span>
                </button>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    <?php else: ?>
        <div class="media-picker-empty"><?php echo e($emptyMessage); ?></div>
    <?php endif; ?>

    <?php $__errorArgs = [$errorKey];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><small id="<?php echo e($errorId); ?>" class="field-error"><?php echo e($message); ?></small><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
</div>
<?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/laravel/shamima-nazneen/resources/views/components/admin/media-library-select.blade.php ENDPATH**/ ?>