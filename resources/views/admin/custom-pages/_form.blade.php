@php
    $record = $customPage ?? null;
@endphp
<section class="form-section">
    <div class="form-section-heading">
        <h2>Page information</h2>
        <p>Create a simple content page using text, headings, links, lists, and uploaded images.</p>
    </div>
    <div class="form-grid">
        <x-admin.input
            name="name"
            label="Page name"
            :value="$record?->name"
            required
            placeholder="Example: Privacy Policy, Press Kit, or Awards"
            help="This name is used as the public page heading and menu label."
        />
        <x-admin.input
            name="slug"
            label="Page URL name"
            :value="$record?->slug"
            placeholder="Example: privacy-policy"
            help="Optional. Leave empty to generate it automatically from the page name."
        />
        <div class="full">
            <x-admin.rich-text
                name="content"
                label="Page details"
                :value="$record?->content"
                required
                placeholder="Write the complete page content here. Use the Image button to place images inside the content."
                help="You can add headings, paragraphs, lists, links, and images. Images automatically resize for mobile screens."
                :image-upload-url="route('admin.editor-images.store')"
            />
        </div>
    </div>
</section>

<section class="form-section">
    <div class="form-section-heading">
        <h2>Menu and visibility settings</h2>
        <p>Select where this page should be visible. The page list drag order controls its sequence in both menus.</p>
    </div>
    <div class="checkbox-grid">
        <x-admin.checkbox name="show_in_header" label="Show in header menu" :checked="$record?->show_in_header ?? false" help="Adds this page to the main navigation menu." />
        <x-admin.checkbox name="show_in_footer" label="Show in footer menu" :checked="$record?->show_in_footer ?? false" help="Adds this page to the footer Quick Links section." />
        <x-admin.checkbox name="is_active" label="Publicly visible" :checked="$record?->is_active ?? true" help="Inactive pages stay saved but cannot be opened publicly." />
    </div>
</section>
