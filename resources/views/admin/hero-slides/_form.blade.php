@php
    $slide = $heroSlide ?? null;
    $settings = $slide?->settings ?? [];
@endphp
<section class="form-section">
    <div class="form-section-heading"><h2>Slide image and content</h2><p>Each slide contains only an image, title, and short subtitle. No button is displayed in the hero slider.</p></div>
    <div class="form-grid">
        <div class="full"><x-admin.media-library-select name="library_media_id" label="Choose hero image from Gallery / Media Library" :current-path="$slide?->image_path" /></div>
        <div class="full"><x-admin.image-upload name="image" label="Or upload a new hero image" :current="$slide?->image_url" help="Recommended: 1920×900 or wider. A new upload is automatically added to Gallery / Media Library." /></div>
        <x-admin.input name="title" label="Slide title" :value="$slide?->title" placeholder="Enter the main hero slide title" />
        <x-admin.input name="subtitle" label="Short subtitle" :value="$slide?->subtitle" placeholder="Write a short supporting line" />
    </div>
</section>
<section class="form-section">
    <div class="form-section-heading"><h2>Text customization</h2><p>Adjust the text placement, readability overlay, color, and responsive base sizes for this slide.</p></div>
    <div class="form-grid three">
        <x-admin.select name="text_alignment" label="Text alignment" :options="['left' => 'Left', 'center' => 'Center', 'right' => 'Right']" :value="$settings['text_alignment'] ?? 'left'" required :placeholder="null" />
        <x-admin.select name="vertical_position" label="Vertical position" :options="['top' => 'Top', 'center' => 'Center', 'bottom' => 'Bottom']" :value="$settings['vertical_position'] ?? 'bottom'" required :placeholder="null" />
        <x-admin.input name="text_color" label="Text color" type="text" :value="$settings['text_color'] ?? '#FFFFFF'" required placeholder="#FFFFFF" help="Use a six-digit HEX color." />
        <x-admin.input name="overlay_opacity" label="Dark overlay (%)" type="number" :value="$settings['overlay_opacity'] ?? 28" min="0" max="80" required placeholder="28" />
        <x-admin.input name="title_size" label="Title size (px)" type="number" :value="$settings['title_size'] ?? 76" min="32" max="110" required placeholder="76" />
        <x-admin.input name="subtitle_size" label="Subtitle size (px)" type="number" :value="$settings['subtitle_size'] ?? 18" min="12" max="36" required placeholder="18" />
    </div>
</section>
<section class="form-section">
    <div class="form-section-heading"><h2>Display settings</h2></div>
    <div class="checkbox-grid"><x-admin.checkbox name="is_active" label="Show this slide" :checked="$slide?->is_active ?? true" help="Inactive slides stay saved but are omitted from the public slider." /></div>
</section>
