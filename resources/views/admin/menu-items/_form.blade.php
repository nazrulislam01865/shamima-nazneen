@php
    $item = $menuItem ?? null;
@endphp
<section class="form-section">
    <div class="form-section-heading"><h2>Navigation item</h2><p>Customize the text, destination, icon, location, and visibility of this public menu link.</p></div>
    <div class="form-grid">
        <x-admin.select name="location" label="Menu location" :options="['header' => 'Header menu', 'footer' => 'Footer quick links']" :value="$item?->location ?? ($defaultLocation ?? 'header')" required :placeholder="null" />
        <x-admin.input name="label" label="Menu label" :value="$item?->label" required placeholder="Example: Biography" />
        <div class="full"><x-admin.input name="url" label="Destination link" :value="$item?->url" required placeholder="/biography, /works?category=films, #contact, or https://example.com" help="Use an internal path, page anchor, or complete external URL." /></div>
        <div class="full"><x-admin.image-upload name="icon" label="Menu icon image" :current="$item?->icon_url" remove-name="remove_icon" help="Optional. Upload a small square PNG, JPG, WEBP, or SVG icon. If empty, the website uses a matching default line icon." /></div>
    </div>
</section>
<section class="form-section">
    <div class="form-section-heading"><h2>Display settings</h2><p>Drag menu items on the list page to change the sequence shown to visitors.</p></div>
    <div class="checkbox-grid">
        <x-admin.checkbox name="open_new_tab" label="Open in a new tab" :checked="$item?->open_new_tab ?? false" help="Recommended only for external websites." />
        <x-admin.checkbox name="is_active" label="Show this menu item" :checked="$item?->is_active ?? true" help="Inactive items remain saved but are hidden publicly." />
    </div>
</section>
