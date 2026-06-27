@php
    $section = $biographySection ?? null;
@endphp
<section class="form-section">
    <div class="form-section-heading"><h2>Biography content</h2><p>The year or period label appears with the section. The public page uses the same visual timeline design as the supplied template.</p></div>
    <div class="form-grid">
        <x-admin.input name="title" label="Section name" :value="$section?->title" required placeholder="Example: Early Life and Theatre Journey" />
        <x-admin.input name="slug" label="URL anchor" :value="$section?->slug" placeholder="Example: early-life" help="Optional. Generated from the section name when left empty." />
        <x-admin.input name="year_label" label="Year or period" :value="$section?->year_label" placeholder="1999, 2004–2012, Television" help="This replaces any “To Be Added” placeholder on the public website." />
        <div class="full"><x-admin.rich-text name="content" label="Biography text" :value="$section?->content" required help="Use the toolbar for paragraphs, headings, emphasis, lists, and links." /></div>
        <div class="full"><x-admin.media-library-select name="library_media_id" label="Choose section image from Gallery / Media Library" :current-path="$section?->image_path" /></div>
        <div class="full"><x-admin.image-upload name="image" label="Or upload a new section image" :current="$section?->image_url" help="A new upload is automatically added to Gallery / Media Library." /></div>
    </div>
</section>
<section class="form-section"><div class="form-section-heading"><h2>Visibility</h2></div><div class="checkbox-grid"><x-admin.checkbox name="is_active" label="Show this section" :checked="$section?->is_active ?? true" help="Inactive sections remain saved in the admin panel." /></div></section>
