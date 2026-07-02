@php
    $item = $mediaItem ?? null;
    $currentType = old('type', $item?->type ?? ($defaultType ?? 'image')) === 'video' ? 'video' : 'image';
    $isVideo = $currentType === 'video';
@endphp
<section class="form-section">
    <div class="form-section-heading"><h2>{{ $isVideo ? 'Video gallery item' : 'Image gallery item' }}</h2></div>
    <input type="hidden" name="type" value="{{ $currentType }}">
    <div class="form-grid three">
        <div class="form-field">
            <label>Gallery type</label>
            <div class="readonly-field">{{ $isVideo ? 'Video Gallery' : 'Image Gallery' }}</div>
        </div>
        <x-admin.input name="title" label="Title" :value="$item?->title" required placeholder="{{ $isVideo ? 'Enter a clear video title' : 'Enter a clear image title' }}" />
        @unless($isVideo)
            <x-admin.input name="alt_text" label="Image alternative text" :value="$item?->alt_text" placeholder="Describe the image for screen readers" />
        @else
            <div></div>
        @endunless
        <x-admin.input name="category" label="Category / collection" :value="$item?->category" placeholder="Portrait, Television, Film, Interview" />
        <x-admin.input name="year" label="Year" type="number" :value="$item?->year" min="1900" :max="date('Y') + 5" placeholder="2024" />
        <div></div>
        <div class="full"><x-admin.rich-text name="description" label="Short description" :value="$item?->description" placeholder="Write a short description for gallery cards or media references..." /></div>
        @unless($isVideo)
            <div class="full"><x-admin.input name="fallback_text" label="Message when this image cannot load" :value="$item?->fallback_text" placeholder="Example: Portrait image is not available." /></div>
        @endunless
    </div>
</section>

@if($isVideo)
    <section class="form-section">
        <div class="form-section-heading"><h2>YouTube video</h2></div>
        <div class="form-grid">
            <div class="full"><x-admin.input name="youtube_url" label="YouTube video URL" :value="$item?->youtube_url" required placeholder="https://www.youtube.com/watch?v=..." /></div>
        </div>
    </section>
@else
    <section class="form-section">
        <div class="form-section-heading"><h2>Image upload</h2></div>
        <x-admin.image-upload name="image" label="Gallery image" :current="$item?->type === 'image' ? $item?->image_url : null" />
    </section>
@endif

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
        <x-admin.checkbox name="show_in_gallery" label="Show on public {{ $isVideo ? 'Video Gallery' : 'Image Gallery' }} page" :checked="$item?->show_in_gallery ?? ($defaultShowInGallery ?? true)" />
        <x-admin.checkbox name="show_on_home" label="Show in homepage {{ $isVideo ? 'video' : 'image' }} gallery section" :checked="$item?->show_on_home ?? ($defaultShowOnHome ?? false)" />
        <x-admin.checkbox name="show_in_profiles" label="Show as a Profiles & Media card" :checked="$item?->show_in_profiles ?? ($defaultShowInProfiles ?? false)" />
        <x-admin.checkbox name="show_in_biography" label="Show in Biography {{ $isVideo ? 'videos' : 'gallery' }}" :checked="$item?->show_in_biography ?? true" />
        <x-admin.checkbox name="is_featured" label="Featured item" :checked="$item?->is_featured ?? false" />
        <x-admin.checkbox name="is_active" label="Item is active" :checked="$item?->is_active ?? true" />
    </div>
</section>
