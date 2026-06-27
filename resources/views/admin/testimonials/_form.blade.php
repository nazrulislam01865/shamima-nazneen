@php
    $record = $testimonial ?? null;
@endphp
<section class="form-section">
    <div class="form-section-heading"><h2>Quote details</h2></div>
    <div class="form-grid">
        <div class="full"><x-admin.textarea name="quote" label="Audience quote" :value="$record?->quote" required rows="6" placeholder="Write the audience response exactly as it should appear on the website..." /></div>
        <x-admin.input name="author" label="Author / attribution" :value="$record?->author" placeholder="Example: Audience member or publication name" />
        <x-admin.input name="source" label="Source" :value="$record?->source" placeholder="Facebook, YouTube, online viewers" />
        <x-admin.input name="source_url" label="Optional source URL" type="url" :value="$record?->source_url" placeholder="https://example.com/original-post" />
    </div>
</section>
<section class="form-section"><div class="checkbox-grid"><x-admin.checkbox name="is_active" label="Show this quote" :checked="$record?->is_active ?? true" help="Only active quotes are available to the public home page." /></div></section>
