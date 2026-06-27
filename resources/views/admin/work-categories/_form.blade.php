@php
    $category = $workCategory ?? null;
    $homeLinks = old('home_links', $category?->home_links);
    if (blank($homeLinks)) {
        $homeLinks = [[
            'label' => $category?->link_label,
            'url' => $category?->forward_url,
        ]];
    }
@endphp
<section class="form-section">
    <div class="form-section-heading"><h2>Category information</h2><p>These categories create the Television, Films, Theatre, Digital, Direction, and other grouped sections on the public Works page.</p></div>
    <div class="form-grid">
        <x-admin.input name="name" label="Category name" :value="$category?->name" required placeholder="Example: Television & Drama" />
        <x-admin.input name="slug" label="Filter URL name" :value="$category?->slug" placeholder="Example: television-drama" help="Optional. Generated automatically when left empty." />
        <div class="full"><x-admin.textarea name="description" label="Archive description" :value="$category?->description" rows="4" placeholder="Write a short introduction for this work category..." /></div>
    </div>
</section>
<section class="form-section">
    <div class="form-section-heading"><h2>Home-page card</h2><p>This controls the category card under “Selected Works” on the home page.</p></div>
    <div class="form-grid">
        <x-admin.input name="home_title" label="Home card title" :value="$category?->home_title" placeholder="Example: Television & Drama" help="Defaults to the category name." />
        <div></div>
        <div class="full"><x-admin.textarea name="home_description" label="Home card short description" :value="$category?->home_description" rows="4" placeholder="Write the short description shown on the homepage card..." /></div>
        <div class="full"><x-admin.media-library-select name="library_media_id" label="Choose card image from Gallery / Media Library" :current-path="$category?->home_image_path" /></div>
        <div class="full"><x-admin.image-upload name="home_image" label="Or upload a new home card image" :current="$category?->home_image_url" remove-name="remove_home_image" help="A landscape image is recommended. A new upload is automatically added to Gallery / Media Library." /></div>
    </div>
</section>
<section class="form-section">
    <div class="form-section-heading">
        <h2>Card links</h2>
        <p>Add one or more links below this homepage card. Leave all rows empty to use the automatic filtered Works-page link.</p>
    </div>
    <div class="repeatable-list" data-repeatable-links data-repeatable-name="home_links" data-next-index="{{ count($homeLinks) }}">
        <div class="repeatable-list-rows" data-repeatable-rows>
            @foreach($homeLinks as $index => $link)
                <div class="repeatable-link-row" data-repeatable-row>
                    <div class="form-field">
                        <label for="home_links_{{ $index }}_label">Link label</label>
                        <input id="home_links_{{ $index }}_label" name="home_links[{{ $index }}][label]" type="text" value="{{ $link['label'] ?? '' }}" maxlength="120">
                        @error("home_links.$index.label")<small class="field-error">{{ $message }}</small>@enderror
                    </div>
                    <div class="form-field">
                        <label for="home_links_{{ $index }}_url">Link URL</label>
                        <input id="home_links_{{ $index }}_url" name="home_links[{{ $index }}][url]" type="text" value="{{ $link['url'] ?? '' }}" maxlength="500">
                        @error("home_links.$index.url")<small class="field-error">{{ $message }}</small>@enderror
                    </div>
                    <button class="admin-button danger small repeatable-remove" type="button" data-repeatable-remove>Remove</button>
                </div>
            @endforeach
        </div>
        <button class="admin-button secondary" type="button" data-repeatable-add>Add Another Link</button>
        <template data-repeatable-template>
            <div class="repeatable-link-row" data-repeatable-row>
                <div class="form-field">
                    <label>Link label</label>
                    <input data-field="label" type="text" maxlength="120">
                </div>
                <div class="form-field">
                    <label>Link URL</label>
                    <input data-field="url" type="text" maxlength="500">
                </div>
                <button class="admin-button danger small repeatable-remove" type="button" data-repeatable-remove>Remove</button>
            </div>
        </template>
    </div>
</section>
<section class="form-section">
    <div class="form-section-heading"><h2>Display settings</h2><p>Use the drag handle on the category list to change its sequence.</p></div>
    <div class="checkbox-grid">
        <x-admin.checkbox name="show_on_home" label="Show on home page" :checked="$category?->show_on_home ?? false" help="Displays this category as a Selected Works card." />
        <x-admin.checkbox name="is_active" label="Category is active" :checked="$category?->is_active ?? true" help="Inactive categories are omitted from public filters." />
    </div>
</section>
