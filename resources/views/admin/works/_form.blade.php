@php
    $record = $work ?? null;
    $externalLinks = old('external_links', $record?->external_links);
    if (blank($externalLinks)) {
        $externalLinks = [[
            'label' => $record?->link_name,
            'url' => $record?->link_url,
        ]];
    }
@endphp
<section class="form-section">
    <div class="form-section-heading"><h2>Work information</h2><p>The year is required and is shown publicly instead of “To Be Added”.</p></div>
    <div class="form-grid three">
        <x-admin.select name="category_id" label="Work category" :options="$categories->pluck('name','id')->all()" :value="$record?->category_id" required />
        <x-admin.input name="title" label="Work name" :value="$record?->title" required placeholder="Enter the film, drama, theatre, or project name" />
        <x-admin.input name="year" label="Release / production year" type="number" :value="$record?->year" required min="1900" :max="date('Y') + 5" placeholder="2024" />
        <x-admin.input name="credit" label="Credit" :value="$record?->credit" placeholder="Actor, Director, Guest appearance" />
        <x-admin.input name="role" label="Character / role" :value="$record?->role" placeholder="Example: Lead character, Guest artist" />
        <x-admin.input name="platform" label="Channel / platform" :value="$record?->platform" placeholder="BTV, YouTube, Chorki..." />
        <div class="full"><x-admin.rich-text name="short_description" label="Short description shown in View Details" :value="$record?->short_description" required help="This rich-text content appears inside the public popup after a visitor clicks View Details." /></div>
        <div class="full"><x-admin.media-library-select name="library_media_id" label="Choose poster from Image Gallery" :current-path="$record?->image_path" /></div>
        <div class="full"><x-admin.image-upload name="image" label="Or upload a new poster / work image" :current="$record?->image_url" help="A new upload is automatically added to Image Gallery." /></div>
    </div>
</section>
<section class="form-section">
    <div class="form-section-heading">
        <h2>Optional external links</h2>
        <p>Add one or more named links. They appear inside the View Details popup and beside the work where the layout supports it.</p>
    </div>
    <div class="repeatable-list" data-repeatable-links data-repeatable-name="external_links" data-next-index="{{ count($externalLinks) }}">
        <div class="repeatable-list-rows" data-repeatable-rows>
            @foreach($externalLinks as $index => $link)
                @php
                    $labelErrorKey = "external_links.$index.label";
                    $urlErrorKey = "external_links.$index.url";
                @endphp
                <div class="repeatable-link-row" data-repeatable-row>
                    <div class="form-field {{ $errors->has($labelErrorKey) ? 'has-error' : '' }}" data-field-wrapper data-field-name="{{ $labelErrorKey }}">
                        <label for="external_links_{{ $index }}_label">Link name</label>
                        <input id="external_links_{{ $index }}_label" name="external_links[{{ $index }}][label]" type="text" value="{{ $link['label'] ?? '' }}" maxlength="120" @if($errors->has($labelErrorKey)) aria-invalid="true" aria-describedby="external_links_{{ $index }}_label_error" @endif>
                        @error($labelErrorKey)<small id="external_links_{{ $index }}_label_error" class="field-error">{{ $message }}</small>@enderror
                    </div>
                    <div class="form-field {{ $errors->has($urlErrorKey) ? 'has-error' : '' }}" data-field-wrapper data-field-name="{{ $urlErrorKey }}">
                        <label for="external_links_{{ $index }}_url">Link URL</label>
                        <input id="external_links_{{ $index }}_url" name="external_links[{{ $index }}][url]" type="text" value="{{ $link['url'] ?? '' }}" maxlength="500" @if($errors->has($urlErrorKey)) aria-invalid="true" aria-describedby="external_links_{{ $index }}_url_error" @endif>
                        @error($urlErrorKey)<small id="external_links_{{ $index }}_url_error" class="field-error">{{ $message }}</small>@enderror
                    </div>
                    <button class="admin-button danger small repeatable-remove" type="button" data-repeatable-remove>Remove</button>
                </div>
            @endforeach
        </div>
        <button class="admin-button secondary" type="button" data-repeatable-add>Add Another Link</button>
        <template data-repeatable-template>
            <div class="repeatable-link-row" data-repeatable-row>
                <div class="form-field">
                    <label>Link name</label>
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
    <div class="form-section-heading"><h2>Display settings</h2></div>
    <div class="checkbox-grid">
        <x-admin.checkbox name="is_featured" label="Featured work" :checked="$record?->is_featured ?? false" help="Prioritizes this entry where the design supports featured work." />
        <x-admin.checkbox name="show_on_home" label="Show on home page" :checked="$record?->show_on_home ?? ($defaultShowOnHome ?? false)" help="Displays it in the matching home-page work section." />
        <x-admin.checkbox name="is_active" label="Publicly visible" :checked="$record?->is_active ?? true" help="Inactive entries stay saved but disappear from the website." />
    </div>
</section>
