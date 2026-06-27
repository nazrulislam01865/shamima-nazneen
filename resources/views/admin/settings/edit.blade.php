@extends('layouts.admin')

@section('title', 'Site Identity & SEO')
@section('page_title', 'Site Identity & SEO')
@section('page_context', 'General Settings')

@section('content')
<x-admin.page-header title="Site Identity & SEO" description="Control the website identity, logo, favicon, contact details, Profiles & Media card links, footer, and search metadata." />

<form class="admin-form" action="{{ route('admin.settings.update') }}" method="POST" enctype="multipart/form-data" data-disable-on-submit>
    @csrf
    @method('PUT')

    <section class="form-section">
        <div class="form-section-heading"><h2>Brand identity</h2><p>Upload the official logo and browser favicon. Both can be replaced at any time.</p></div>
        <div class="form-grid">
            <x-admin.input name="site_name" label="Website name" :value="$settings->site_name" required placeholder="Example: Shamima Nazneen" />
            <x-admin.input name="tagline" label="Professional tagline" :value="$settings->tagline" placeholder="Example: Actress, director, and theatre personality" />
            <div class="full"><x-admin.media-library-select name="logo_media_id" label="Choose logo from Gallery / Media Library" :current-path="$settings->logo_path" /></div>
            <div class="full"><x-admin.image-upload name="logo" label="Or upload a new website logo" :current="$settings->logo_url" remove-name="remove_logo" help="PNG, JPG, or WEBP. A new upload is automatically added to Gallery / Media Library." /></div>
            <div class="full"><x-admin.media-library-select name="favicon_media_id" label="Choose favicon from Gallery / Media Library" :current-path="$settings->favicon_path" /></div>
            <div class="full"><x-admin.image-upload name="favicon" label="Or upload a new browser favicon" :current="$settings->favicon_url" remove-name="remove_favicon" help="PNG, ICO, WEBP, or JPG. A new upload is automatically added to Gallery / Media Library." /></div>
        </div>
    </section>

    <section class="form-section">
        <div class="form-section-heading"><h2>Official contact information</h2><p>These details appear in the public contact area and footer where applicable.</p></div>
        <div class="form-grid">
            <x-admin.input name="email" label="Official email" type="email" :value="$settings->email" placeholder="Example: contact@example.com" />
            <x-admin.input name="phone" label="Phone number" :value="$settings->phone" placeholder="Example: +880 1XXXXXXXXX" />
            <div class="full"><x-admin.textarea name="address" label="Address" :value="$settings->address" rows="3" placeholder="Write the official office or contact address" /></div>
            <x-admin.input name="media_inquiry_label" label="Media inquiry label" :value="$settings->media_inquiry_label" required placeholder="Example: Media & Professional Inquiries" help="Used as the label for media and professional contact links." />
            <div></div>
            <div class="full"><x-admin.textarea name="footer_text" label="Footer description" :value="$settings->footer_text" rows="4" placeholder="Write a short description to display in the website footer" /></div>
            <div class="full"><x-admin.input name="image_fallback_text" label="Missing image message" :value="$settings->image_fallback_text ?: 'Image is not available.'" required placeholder="Example: Image is not available right now." help="This text replaces the broken-image icon anywhere an image cannot be loaded." /></div>
        </div>
    </section>

    @php
        $profileCardLinks = old('profile_card_links', $settings->profile_card_links ?? []);
        if (blank($profileCardLinks)) {
            $profileCardLinks = [['title' => '', 'url' => '', 'description' => '']];
        }
    @endphp
    <section class="form-section" id="profiles-media-links">
        <div class="form-section-heading">
            <h2>Profiles and media card links</h2>
            <p>Add as many homepage profile or media links as needed. Each saved item becomes a separate clickable card.</p>
        </div>

        <div class="repeatable-list" data-repeatable-links data-repeatable-name="profile_card_links" data-next-index="{{ count($profileCardLinks) }}">
            <div class="repeatable-list-rows" data-repeatable-rows>
                @foreach($profileCardLinks as $index => $profileLink)
                    <div class="repeatable-link-row profile-card-link-row" data-repeatable-row>
                        <div class="form-field">
                            <label for="profile_card_links_{{ $index }}_title">Card name</label>
                            <input id="profile_card_links_{{ $index }}_title" name="profile_card_links[{{ $index }}][title]" type="text" value="{{ $profileLink['title'] ?? '' }}" maxlength="120">
                            @error("profile_card_links.$index.title")<small class="field-error">{{ $message }}</small>@enderror
                        </div>
                        <div class="form-field">
                            <label for="profile_card_links_{{ $index }}_url">Link URL</label>
                            <input id="profile_card_links_{{ $index }}_url" name="profile_card_links[{{ $index }}][url]" type="text" value="{{ $profileLink['url'] ?? '' }}" maxlength="500">
                            @error("profile_card_links.$index.url")<small class="field-error">{{ $message }}</small>@enderror
                        </div>
                        <div class="form-field profile-card-description-field">
                            <label for="profile_card_links_{{ $index }}_description">Card description</label>
                            <textarea id="profile_card_links_{{ $index }}_description" name="profile_card_links[{{ $index }}][description]" rows="3" maxlength="500">{{ $profileLink['description'] ?? '' }}</textarea>
                            @error("profile_card_links.$index.description")<small class="field-error">{{ $message }}</small>@enderror
                        </div>
                        <button class="admin-button danger small repeatable-remove" type="button" data-repeatable-remove>Remove</button>
                    </div>
                @endforeach
            </div>

            <button class="admin-button secondary" type="button" data-repeatable-add>Add Another Profile or Media Link</button>

            <template data-repeatable-template>
                <div class="repeatable-link-row profile-card-link-row" data-repeatable-row>
                    <div class="form-field">
                        <label>Card name</label>
                        <input data-field="title" type="text" maxlength="120">
                    </div>
                    <div class="form-field">
                        <label>Link URL</label>
                        <input data-field="url" type="text" maxlength="500">
                    </div>
                    <div class="form-field profile-card-description-field">
                        <label>Card description</label>
                        <textarea data-field="description" rows="3" maxlength="500"></textarea>
                    </div>
                    <button class="admin-button danger small repeatable-remove" type="button" data-repeatable-remove>Remove</button>
                </div>
            </template>
        </div>
    </section>

    <section class="form-section">
        <div class="form-section-heading"><h2>Search engine information</h2><p>Used for the browser title and search-engine preview.</p></div>
        <div class="form-grid">
            <div class="full"><x-admin.input name="seo_title" label="SEO title" :value="$settings->seo_title" maxlength="255" placeholder="Example: Shamima Nazneen | Actress, Director & Theatre Personality" /></div>
            <div class="full"><x-admin.textarea name="seo_description" label="SEO description" :value="$settings->seo_description" rows="4" maxlength="500" placeholder="Write a clear summary for search engines and social sharing previews" /></div>
        </div>
    </section>

    <x-admin.form-actions :cancel="route('admin.dashboard')" submit="Save Site Settings" />
</form>
@endsection
