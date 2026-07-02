@extends('layouts.admin')

@section('title', 'Add Home Content')
@section('page_title', 'Add Home Content')
@section('page_context', 'Home Page')

@section('content')
<x-admin.page-header title="Add home-page content" description="Create a new content section and then drag it into the required home-page position." />

<form class="admin-form" action="{{ route('admin.content-sections.store') }}" method="POST" enctype="multipart/form-data" data-disable-on-submit>
    @csrf
    <input type="hidden" name="page" value="home">
    <section class="form-section">
        <div class="form-section-heading"><h2>Section content</h2><p>Use a clear internal section name, then add the public heading and rich content.</p></div>
        <div class="form-grid">
            <x-admin.input name="section_name" label="Internal section name" required placeholder="Example: Awards and Recognition" help="Used only in the admin panel to identify this section." />
            <x-admin.select name="layout" label="Section layout" :options="['text-only' => 'Text only', 'image-left' => 'Image on left', 'image-right' => 'Image on right']" value="image-right" required :placeholder="null" />
            <x-admin.input name="eyebrow" label="Small section label" placeholder="Example: Awards" />
            <x-admin.input name="title" label="Main heading" required placeholder="Enter the main heading shown in this section" />
            <div class="full"><x-admin.rich-text name="description" label="Description" placeholder="Write the main content for this section..." /></div>
            <div class="full"><x-admin.rich-text name="secondary_text" label="Secondary text" placeholder="Add an optional second text block..." help="Leave empty when no second text block is needed." /></div>
        </div>
    </section>
    <section class="form-section">
        <div class="form-section-heading"><h2>Optional button and image</h2><p>These fields are optional and are used according to the selected layout.</p></div>
        <div class="form-grid">
            <x-admin.input name="button_label" label="Button label" placeholder="Example: Learn More" />
            <x-admin.input name="button_url" label="Button link" placeholder="/biography, #contact, or https://example.com" />
            <div class="full"><x-admin.media-library-select name="library_media_id" label="Choose section image from Image Gallery" /></div>
            <div class="full"><x-admin.image-upload name="image" label="Or upload a new section image" help="Recommended: landscape JPG, PNG, or WEBP up to 5 MB. New uploads are automatically added to Image Gallery." /></div>
        </div>
    </section>
    <section class="form-section">
        <div class="form-section-heading"><h2>Display settings</h2></div>
        <div class="checkbox-grid"><x-admin.checkbox name="is_active" label="Show this section" :checked="true" help="You can hide it later without deleting it." /></div>
    </section>
    <x-admin.form-actions :cancel="route('admin.content-sections.index', ['page' => 'home'])" submit="Add Home Content" />
</form>
@endsection
