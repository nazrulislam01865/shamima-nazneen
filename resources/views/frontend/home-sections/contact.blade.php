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
            <form class="contact-form" action="{{ route('inquiries.store') }}" method="POST">
                @csrf
                <div class="contact-form-grid">
                    <label><span>Name *</span><input type="text" name="name" value="{{ old('name') }}" required maxlength="160" placeholder="Enter your full name" autocomplete="name"></label>
                    <label><span>Email *</span><input type="email" name="email" value="{{ old('email') }}" required maxlength="160" placeholder="Enter your email address" autocomplete="email"></label>
                    <label><span>Phone</span><input type="text" name="phone" value="{{ old('phone') }}" maxlength="40" placeholder="Enter your phone number" autocomplete="tel"></label>
                    <label><span>Subject</span><input type="text" name="subject" value="{{ old('subject') }}" maxlength="255" placeholder="Enter inquiry subject"></label>
                </div>
                <label><span>Message *</span><textarea name="message" rows="5" required maxlength="5000" placeholder="Write your message here">{{ old('message') }}</textarea></label>
                <div class="captcha-field">
                    <label><span>Captcha Value *</span><input type="text" value="{{ session('contact_captcha_question') }}" readonly tabindex="-1" aria-label="Captcha value" placeholder="Captcha value"></label>
                    <label><span>Captcha Answer *</span><input type="number" name="captcha_answer" value="" required inputmode="numeric" placeholder="Enter captcha answer" autocomplete="off"></label>
                </div>
                <input class="honeypot" type="text" name="website" tabindex="-1" autocomplete="off" aria-hidden="true">
                <button class="btn light" type="submit">Send Inquiry</button>
            </form>
        </div>
    </div>
</section>
