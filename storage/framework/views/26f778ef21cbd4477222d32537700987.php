<?php
    // Generate a new captcha on every full page reload.
    // This prevents the same captcha from staying in the session across refreshes.
    $left = random_int(2, 9);
    $right = random_int(1, 9);

    session([
        'contact_captcha_question' => $left.' + '.$right,
        'contact_captcha_answer' => $left + $right,
    ]);
?>
<section class="contact-band" id="contact">
    <div class="container">
        <div class="contact-panel contact-panel-with-form">
            <div>
                <?php if($section->eyebrow): ?><div class="section-label" style="color:#fff"><?php echo e($section->eyebrow); ?></div><?php endif; ?>
                <h2><?php echo e($section->title); ?></h2>
                <div class="rich-content"><?php echo $section->description; ?></div>
                <?php if($siteSettings->email): ?><p><a class="contact-direct-link" href="mailto:<?php echo e($siteSettings->email); ?>"><?php echo e($siteSettings->email); ?></a></p><?php endif; ?>
                <?php if($siteSettings->phone): ?><p><a class="contact-direct-link" href="tel:<?php echo e(preg_replace('/\s+/', '', $siteSettings->phone)); ?>"><?php echo e($siteSettings->phone); ?></a></p><?php endif; ?>
            </div>
            <form class="contact-form" action="<?php echo e(route('inquiries.store')); ?>" method="POST" data-disable-on-submit>
                <?php echo csrf_field(); ?>
                <div class="contact-form-grid">
                    <label class="contact-form-field <?php echo e($errors->has('name') ? 'has-error' : ''); ?>" data-field-wrapper data-field-name="name" for="name">
                        <span>Name *</span>
                        <input id="name" type="text" name="name" value="<?php echo e(old('name')); ?>" required maxlength="160" placeholder="Enter your full name" autocomplete="name" <?php if($errors->has('name')): ?> aria-invalid="true" aria-describedby="name_error" <?php endif; ?>>
                        <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><small id="name_error" class="field-error"><?php echo e($message); ?></small><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </label>
                    <label class="contact-form-field <?php echo e($errors->has('email') ? 'has-error' : ''); ?>" data-field-wrapper data-field-name="email" for="email">
                        <span>Email *</span>
                        <input id="email" type="email" name="email" value="<?php echo e(old('email')); ?>" required maxlength="160" placeholder="Enter your email address" autocomplete="email" <?php if($errors->has('email')): ?> aria-invalid="true" aria-describedby="email_error" <?php endif; ?>>
                        <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><small id="email_error" class="field-error"><?php echo e($message); ?></small><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </label>
                    <label class="contact-form-field <?php echo e($errors->has('phone') ? 'has-error' : ''); ?>" data-field-wrapper data-field-name="phone" for="phone">
                        <span>Phone</span>
                        <input id="phone" type="text" name="phone" value="<?php echo e(old('phone')); ?>" maxlength="40" placeholder="Enter your phone number" autocomplete="tel" <?php if($errors->has('phone')): ?> aria-invalid="true" aria-describedby="phone_error" <?php endif; ?>>
                        <?php $__errorArgs = ['phone'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><small id="phone_error" class="field-error"><?php echo e($message); ?></small><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </label>
                    <label class="contact-form-field <?php echo e($errors->has('subject') ? 'has-error' : ''); ?>" data-field-wrapper data-field-name="subject" for="subject">
                        <span>Subject</span>
                        <input id="subject" type="text" name="subject" value="<?php echo e(old('subject')); ?>" maxlength="255" placeholder="Enter inquiry subject" <?php if($errors->has('subject')): ?> aria-invalid="true" aria-describedby="subject_error" <?php endif; ?>>
                        <?php $__errorArgs = ['subject'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><small id="subject_error" class="field-error"><?php echo e($message); ?></small><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </label>
                </div>
                <label class="contact-form-field <?php echo e($errors->has('message') ? 'has-error' : ''); ?>" data-field-wrapper data-field-name="message" for="message">
                    <span>Message *</span>
                    <textarea id="message" name="message" rows="5" required maxlength="5000" placeholder="Write your message here" <?php if($errors->has('message')): ?> aria-invalid="true" aria-describedby="message_error" <?php endif; ?>><?php echo e(old('message')); ?></textarea>
                    <?php $__errorArgs = ['message'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><small id="message_error" class="field-error"><?php echo e($message); ?></small><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </label>
                <div class="captcha-field">
                    <label class="contact-form-field" for="captcha_value"><span>Captcha Value *</span><input id="captcha_value" type="text" value="<?php echo e(session('contact_captcha_question')); ?>" readonly tabindex="-1" aria-label="Captcha value" placeholder="Captcha value"></label>
                    <label class="contact-form-field <?php echo e($errors->has('captcha_answer') ? 'has-error' : ''); ?>" data-field-wrapper data-field-name="captcha_answer" for="captcha_answer">
                        <span>Captcha Answer *</span>
                        <input id="captcha_answer" type="number" name="captcha_answer" value="" required inputmode="numeric" placeholder="Enter captcha answer" autocomplete="off" <?php if($errors->has('captcha_answer')): ?> aria-invalid="true" aria-describedby="captcha_answer_error" <?php endif; ?>>
                        <?php $__errorArgs = ['captcha_answer'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><small id="captcha_answer_error" class="field-error"><?php echo e($message); ?></small><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </label>
                </div>
                <input class="honeypot" type="text" name="website" tabindex="-1" autocomplete="off" aria-hidden="true">
                <button class="btn light" type="submit">Send Inquiry</button>
            </form>
        </div>
    </div>
</section>
<?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/laravel/shamima-nazneen/resources/views/frontend/home-sections/contact.blade.php ENDPATH**/ ?>