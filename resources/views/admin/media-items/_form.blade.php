@php
    $item = $mediaItem ?? null;
@endphp
<section class="form-section">
    <div class="form-section-heading"><h2>Media library item</h2></div>
    <div class="form-grid three">
        <x-admin.select name="type" label="Media type" :options="['image' => 'Image', 'video' => 'YouTube video']" :value="$item?->type ?? ($defaultType ?? 'image')" required placeholder="Select media type" data-media-type />
        <x-admin.input name="title" label="Title" :value="$item?->title" required placeholder="Enter a clear image or video title" />
        <x-admin.input name="alt_text" label="Image alternative text" :value="$item?->alt_text" placeholder="Describe the image for screen readers" />
        <x-admin.input name="category" label="Category / collection" :value="$item?->category" placeholder="Portrait, Television, Film, Interview" />
        <x-admin.input name="year" label="Year" type="number" :value="$item?->year" min="1900" :max="date('Y') + 5" placeholder="2024" />
        <div class="full"><x-admin.rich-text name="description" label="Short description" :value="$item?->description" placeholder="Write a short description for cards, gallery details, or profile/media references..." /></div>
        <div class="full"><x-admin.input name="fallback_text" label="Message when this image cannot load" :value="$item?->fallback_text" placeholder="Example: Portrait image is not available." /></div>
    </div>
</section>

<section class="form-section media-type-panel" data-media-panel="image">
    <div class="form-section-heading"><h2>Image upload</h2></div>
    <x-admin.image-upload name="image" label="Media image" :current="$item?->type === 'image' ? $item?->image_url : null" />
</section>

<section class="form-section media-type-panel" data-media-panel="video">
    <div class="form-section-heading"><h2>YouTube video</h2></div>
    <div class="form-grid">
        <div class="full"><x-admin.input name="youtube_url" label="YouTube video URL" :value="$item?->youtube_url" placeholder="https://www.youtube.com/watch?v=..." /></div>
    </div>
</section>

<section class="form-section">
    <div class="form-section-heading"><h2>Card destination</h2></div>
    <div class="form-grid">
        <x-admin.input name="link_name" label="Link name" :value="$item?->link_name" placeholder="Read interview, Open profile, View source" />
        <x-admin.input name="link_url" label="Link URL" :value="$item?->link_url" placeholder="/works?category=films or https://example.com" />
    </div>
</section>

<section class="form-section">
    <div class="form-section-heading"><h2>Choose where to show it</h2></div>
    <div class="checkbox-grid">
        <x-admin.checkbox name="show_in_gallery" label="Show on public Gallery page" :checked="$item?->show_in_gallery ?? ($defaultShowInGallery ?? true)" />
        <x-admin.checkbox name="show_on_home" label="Show in homepage gallery section" :checked="$item?->show_on_home ?? ($defaultShowOnHome ?? false)" />
        <x-admin.checkbox name="show_in_profiles" label="Show as a Profiles & Media card" :checked="$item?->show_in_profiles ?? ($defaultShowInProfiles ?? false)" />
        <x-admin.checkbox name="show_in_biography" label="Show in Biography gallery" :checked="$item?->show_in_biography ?? true" />
        <x-admin.checkbox name="is_featured" label="Featured item" :checked="$item?->is_featured ?? false" />
        <x-admin.checkbox name="is_active" label="Item is active" :checked="$item?->is_active ?? true" />
    </div>
</section>
