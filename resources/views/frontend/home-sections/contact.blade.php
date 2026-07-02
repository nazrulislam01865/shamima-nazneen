@php
    // Generate a new captcha on every full page reload.
    // This prevents the same captcha from staying in the session across refreshes.
    $left = random_int(2, 9);
    $right = random_int(1, 9);

    session([
        'contact_captcha_question' => $left.' + '.$right,
        'contact_captcha_answer' => $left + $right,
    ]);
@endphp
<section class="contact-band" id="contact">
    <div class="container">
        <div class="contact-panel contact-panel-with-form">
            <div>
                @if($section->eyebrow)<div class="section-label" style="color:#fff">{{ $section->eyebrow }}</div>@endif
                <h2>{{ $section->title }}</h2>
                <div class="rich-content">{!! $section->description !!}</div>
                @if($siteSettings->email)<p><a class="contact-direct-link" href="mailto:{{ $siteSettings->email }}">{{ $siteSettings->email }}</a></p>@endif
                @if($siteSettings->phone)<p><a class="contact-direct-link" href="tel:{{ preg_replace('/\s+/', '', $siteSettings->phone) }}">{{ $siteSettings->phone }}</a></p>@endif
            </div>
            <form class="contact-form" action="{{ route('inquiries.store') }}" method="POST" data-disable-on-submit>
                @csrf
                <div class="contact-form-grid">
                    <label class="contact-form-field {{ $errors->has('name') ? 'has-error' : '' }}" data-field-wrapper data-field-name="name" for="name">
                        <span>Name *</span>
                        <input id="name" type="text" name="name" value="{{ old('name') }}" required maxlength="160" placeholder="Enter your full name" autocomplete="name" @if($errors->has('name')) aria-invalid="true" aria-describedby="name_error" @endif>
                        @error('name')<small id="name_error" class="field-error">{{ $message }}</small>@enderror
                    </label>
                    <label class="contact-form-field {{ $errors->has('email') ? 'has-error' : '' }}" data-field-wrapper data-field-name="email" for="email">
                        <span>Email *</span>
                        <input id="email" type="email" name="email" value="{{ old('email') }}" required maxlength="160" placeholder="Enter your email address" autocomplete="email" @if($errors->has('email')) aria-invalid="true" aria-describedby="email_error" @endif>
                        @error('email')<small id="email_error" class="field-error">{{ $message }}</small>@enderror
                    </label>
                    <label class="contact-form-field {{ $errors->has('phone') ? 'has-error' : '' }}" data-field-wrapper data-field-name="phone" for="phone">
                        <span>Phone</span>
                        <input id="phone" type="text" name="phone" value="{{ old('phone') }}" maxlength="40" placeholder="Enter your phone number" autocomplete="tel" @if($errors->has('phone')) aria-invalid="true" aria-describedby="phone_error" @endif>
                        @error('phone')<small id="phone_error" class="field-error">{{ $message }}</small>@enderror
                    </label>
                    <label class="contact-form-field {{ $errors->has('subject') ? 'has-error' : '' }}" data-field-wrapper data-field-name="subject" for="subject">
                        <span>Subject</span>
                        <input id="subject" type="text" name="subject" value="{{ old('subject') }}" maxlength="255" placeholder="Enter inquiry subject" @if($errors->has('subject')) aria-invalid="true" aria-describedby="subject_error" @endif>
                        @error('subject')<small id="subject_error" class="field-error">{{ $message }}</small>@enderror
                    </label>
                </div>
                <label class="contact-form-field {{ $errors->has('message') ? 'has-error' : '' }}" data-field-wrapper data-field-name="message" for="message">
                    <span>Message *</span>
                    <textarea id="message" name="message" rows="5" required maxlength="5000" placeholder="Write your message here" @if($errors->has('message')) aria-invalid="true" aria-describedby="message_error" @endif>{{ old('message') }}</textarea>
                    @error('message')<small id="message_error" class="field-error">{{ $message }}</small>@enderror
                </label>
                <div class="captcha-field">
                    <label class="contact-form-field" for="captcha_value"><span>Captcha Value *</span><input id="captcha_value" type="text" value="{{ session('contact_captcha_question') }}" readonly tabindex="-1" aria-label="Captcha value" placeholder="Captcha value"></label>
                    <label class="contact-form-field {{ $errors->has('captcha_answer') ? 'has-error' : '' }}" data-field-wrapper data-field-name="captcha_answer" for="captcha_answer">
                        <span>Captcha Answer *</span>
                        <input id="captcha_answer" type="number" name="captcha_answer" value="" required inputmode="numeric" placeholder="Enter captcha answer" autocomplete="off" @if($errors->has('captcha_answer')) aria-invalid="true" aria-describedby="captcha_answer_error" @endif>
                        @error('captcha_answer')<small id="captcha_answer_error" class="field-error">{{ $message }}</small>@enderror
                    </label>
                </div>
                <input class="honeypot" type="text" name="website" tabindex="-1" autocomplete="off" aria-hidden="true">
                <button class="btn light" type="submit">Send Inquiry</button>
            </form>
        </div>
    </div>
</section>
