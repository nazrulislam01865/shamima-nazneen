@php
    $category = $workCategory ?? null;
@endphp
<section class="form-section">
    <div class="form-section-heading"><h2>Category information</h2><p>These categories create the Television, Films, Theatre, Digital, Direction, and other grouped sections on the public Works page.</p></div>
    <div class="form-grid">
        <x-admin.input name="name" label="Category name" :value="$category?->name" required placeholder="Example: Television & Drama" />
        <div class="full"><x-admin.textarea name="description" label="Archive description" :value="$category?->description" rows="4" placeholder="Write a short introduction for this work category..." /></div>
    </div>
</section>
<section class="form-section">
    <div class="form-section-heading"><h2>Home-page card</h2><p>This controls the category card under “Selected Works” on the home page.</p></div>
    <div class="form-grid">
        <x-admin.input name="home_title" label="Home card title" :value="$category?->home_title" placeholder="Example: Television & Drama" help="Defaults to the category name." />
        <div></div>
        <div class="full"><x-admin.textarea name="home_description" label="Home card short description" :value="$category?->home_description" rows="4" placeholder="Write the short description shown on the homepage card..." /></div>
        <div class="full"><x-admin.media-library-select name="library_media_id" label="Choose card image from Image Gallery" :current-path="$category?->home_image_path" /></div>
        <div class="full"><x-admin.image-upload name="home_image" label="Or upload a new home card image" :current="$category?->home_image_url" remove-name="remove_home_image" help="A landscape image is recommended. A new upload is automatically added to Image Gallery." /></div>
    </div>
</section>
<section class="form-section">
    <div class="form-section-heading"><h2>Display settings</h2><p>Use the drag handle on the category list to change its sequence.</p></div>
    <div class="checkbox-grid">
        <x-admin.checkbox name="show_on_home" label="Show on home page" :checked="$category?->show_on_home ?? false" help="Displays this category as a Selected Works card." />
        <x-admin.checkbox name="is_active" label="Category is active" :checked="$category?->is_active ?? true" help="Inactive categories are omitted from public filters." />
    </div>
</section>
