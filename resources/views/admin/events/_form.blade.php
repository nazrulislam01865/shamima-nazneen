@php
    $record = $event ?? null;
@endphp
<section class="form-section">
    <div class="form-section-heading"><h2>Event information</h2></div>
    <div class="form-grid">
        <x-admin.input name="title" label="Event / appearance name" :value="$record?->title" required placeholder="Example: Television Interview or Cultural Programme" />
        <x-admin.input name="event_date" label="Event date" type="date" :value="$record?->event_date?->format('Y-m-d')" placeholder="YYYY-MM-DD" help="Choose the event date when it is known." />
        <div class="full"><x-admin.rich-text name="description" label="Description" :value="$record?->description" /></div>
        <div class="full"><x-admin.media-library-select name="library_media_id" label="Choose event image from Image Gallery" :current-path="$record?->image_path" /></div>
        <div class="full"><x-admin.image-upload name="image" label="Or upload a new event image" :current="$record?->image_url" help="A new upload is automatically added to Image Gallery." /></div>
    </div>
</section>
<section class="form-section">
    <div class="form-section-heading"><h2>Card destination</h2><p>Send visitors to a filtered Works page or provide another internal/external link.</p></div>
    <div class="form-grid">
        <x-admin.select name="work_category_id" label="Filtered work category" :options="$categories->pluck('name', 'id')->all()" :value="$record?->work_category_id" placeholder="Select a work category (optional)" help="When selected, clicking the event card opens the Works page filtered to this category." />
        <div></div>
        <x-admin.input name="link_name" label="Custom link name" :value="$record?->link_name" placeholder="Example: Watch interview" help="Used only when no filtered work category is selected." />
        <x-admin.input name="link_url" label="Custom link URL" :value="$record?->link_url" placeholder="Example: /works?category=television or https://example.com" help="Internal paths and complete external URLs are accepted." />
    </div>
</section>
<section class="form-section">
    <div class="form-section-heading"><h2>Display settings</h2></div>
    <div class="checkbox-grid"><x-admin.checkbox name="show_on_home" label="Show on home page" :checked="$record?->show_on_home ?? false" help="Enable this to include the event in the homepage events section." /><x-admin.checkbox name="is_active" label="Publicly visible" :checked="$record?->is_active ?? true" help="Inactive events stay saved but do not appear publicly." /></div>
</section>
