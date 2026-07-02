    <section id="events">
        <div class="container">
            <div class="section-head">
                <?php if($section->eyebrow): ?><div class="section-label"><?php echo e($section->eyebrow); ?></div><?php endif; ?>
                <h2><?php echo e($section->title); ?></h2>
                <div class="lead rich-content"><?php echo $section->description; ?></div>
            </div>
            <?php if($events->isNotEmpty()): ?>
                <div class="events-grid">
                    <?php $__currentLoopData = $events; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $event): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php if($event->public_url): ?>
                            <?php
                                $eventLinkIsExternal = \Illuminate\Support\Str::startsWith($event->public_url, ['http://', 'https://']);
                            ?>
                            <a class="event-chip" href="<?php echo e($event->public_url); ?>" <?php if($eventLinkIsExternal): ?> target="_blank" rel="noopener noreferrer" <?php endif; ?>><?php echo e($event->title); ?></a>
                        <?php else: ?>
                            <div class="event-chip"><?php echo e($event->title); ?></div>
                        <?php endif; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            <?php endif; ?>
            <?php if($section->button_label): ?><p style="margin-top:28px"><a class="btn dark" href="<?php echo e($section->button_url ?: '#contact'); ?>"><?php echo e($section->button_label); ?></a></p><?php endif; ?>
        </div>
    </section>
<?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/laravel/shamima-nazneen/resources/views/frontend/home-sections/events.blade.php ENDPATH**/ ?>