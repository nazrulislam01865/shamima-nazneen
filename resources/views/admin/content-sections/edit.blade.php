@extends('layouts.admin')

@section('title', 'Edit Page Section')
@section('page_title', ($pageConfig['label'] ?? ucfirst($contentSection->page).' Page').' Content')
@section('page_context', 'Page management')

@section('content')
@php
    $isCustomHomeSection = $contentSection->page === 'home' && \Illuminate\Support\Str::startsWith($contentSection->section_key, 'custom-');
@endphp
<x-admin.page-header
    :title="'Edit: '.($contentSection->title ?: \Illuminate\Support\Str::headline($contentSection->section_key))"
    :description="'Public page: '.($pageConfig['label'] ?? ucfirst($contentSection->page).' Page').' · Section: '.\Illuminate\Support\Str::headline($contentSection->section_key)"
/>

<form class="admin-form" action="{{ route('admin.content-sections.update', $contentSection) }}" method="POST" enctype="multipart/form-data" data-disable-on-submit>
    @csrf
    @method('PUT')
    <section class="form-section">
        <div class="form-section-heading"><h2>Section content</h2><p>Changes here update this section without changing the supplied public template structure.</p></div>
        <div class="form-grid">
            @if($isCustomHomeSection)
                <x-admin.select name="layout" label="Section layout" :options="['text-only' => 'Text only', 'image-left' => 'Image on left', 'image-right' => 'Image on right']" :value="$contentSection->settings['layout'] ?? 'image-right'" required :placeholder="null" />
                <div></div>
            @endif
            <x-admin.input name="eyebrow" label="Small section label" :value="$contentSection->eyebrow" placeholder="Example: About Shamima Nazneen" />
            <x-admin.input name="title" label="Main heading" :value="$contentSection->title" placeholder="Enter the main heading shown in this section" />
            <div class="full"><x-admin.rich-text name="description" label="Description" :value="$contentSection->description" placeholder="Write the main section content..." /></div>
            <div class="full"><x-admin.rich-text name="secondary_text" label="Secondary text" :value="$contentSection->secondary_text" placeholder="Add an optional second text block..." help="Used only by sections that support an additional text block." /></div>
        </div>
    </section>
    @if($contentSection->page !== 'works')
        <section class="form-section">
            <div class="form-section-heading"><h2>Button and image</h2><p>Leave button fields empty when the section should not display a call-to-action.</p></div>
            <div class="form-grid">
                <x-admin.input name="button_label" label="Button label" :value="$contentSection->button_label" placeholder="Example: Read Biography" />
                <x-admin.input name="button_url" label="Button link" :value="$contentSection->button_url" placeholder="/biography, #contact, or https://example.com" help="Use a site path, page anchor, or complete external URL." />
                <div class="full"><x-admin.media-library-select name="library_media_id" label="Choose section image from Gallery / Media Library" :current-path="$contentSection->image_path" /></div>
                <div class="full"><x-admin.image-upload name="image" label="Or upload a new section image" :current="$contentSection->image_url" help="Used only where the design contains an image. New uploads are automatically added to Gallery / Media Library." /></div>
            </div>
        </section>
    @endif
    <section class="form-section">
        <div class="form-section-heading"><h2>Display settings</h2></div>
        <div class="checkbox-grid"><x-admin.checkbox name="is_active" label="Show this section" :checked="$contentSection->is_active" help="Turning this off removes the entire section from the public page." /></div>
    </section>
    <x-admin.form-actions :cancel="route('admin.content-sections.index', ['page' => $contentSection->page])" submit="Save Section" />
</form>
@endsection
