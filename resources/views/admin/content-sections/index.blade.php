@extends('layouts.admin')

@section('title', $pageConfig ? $pageConfig['label'].' Content' : 'Page Content')
@section('page_title', $pageConfig ? $pageConfig['label'].' Content' : 'Page Content')
@section('page_context', 'Page management')

@section('content')
<x-admin.page-header
    :title="$pageConfig ? $pageConfig['label'].' content' : 'Page content'"
    :description="$pageConfig
        ? 'Edit every heading, description, button, image, visibility setting, and drag-and-drop sequence used on the '.$pageConfig['short_label'].' page.'
        : 'Select a page and edit its headings, descriptions, buttons, images, visibility settings, and sequence.'"
    :action="$pageFilter === 'home' ? route('admin.content-sections.create', ['page' => 'home']) : null"
    action-label="Add Home Content"
/>

<nav class="page-filter-tabs" aria-label="Filter page content">
    <a href="{{ route('admin.content-sections.index') }}" class="{{ $pageFilter === null ? 'active' : '' }}">All Pages</a>
    @foreach($availablePages as $pageKey => $page)
        <a href="{{ route('admin.content-sections.index', ['page' => $pageKey]) }}" class="{{ $pageFilter === $pageKey ? 'active' : '' }}">{{ $page['label'] }}</a>
    @endforeach
</nav>

@forelse($sections as $pageName => $pageSections)
    <section class="page-group">
        <div class="page-group-heading">
            <h2 class="page-group-label">{{ $availablePages[$pageName]['label'] ?? ucfirst($pageName).' Page' }}</h2>
            @if(isset($availablePages[$pageName]))
                <a href="{{ route('admin.pages.show', ['page' => $pageName]) }}">Open page overview →</a>
            @endif
        </div>
        <x-admin.sortable-help />
        <div class="section-list" data-sortable-list data-reorder-url="{{ route('admin.reorder', ['resource' => 'content-sections']) }}">
            @foreach($pageSections as $section)
                <article class="section-row" data-sortable-item data-id="{{ $section->id }}">
                    <x-admin.sort-handle :label="'Move '.($section->title ?: \Illuminate\Support\Str::headline($section->section_key)).' section'" />
                    <div>
                        <h3>{{ $section->title ?: \Illuminate\Support\Str::headline($section->section_key) }}</h3>
                        <p>{{ \Illuminate\Support\Str::headline($section->section_key) }} section · {{ $section->eyebrow ?: 'No eyebrow label' }}</p>
                    </div>
                    <x-admin.status :active="$section->is_active" />
                    <div class="table-actions">
                        <a class="admin-button secondary small" href="{{ route('admin.content-sections.edit', $section) }}">Edit section</a>
                        @if($section->page === 'home' && \Illuminate\Support\Str::startsWith($section->section_key, 'custom-'))
                            <form action="{{ route('admin.content-sections.destroy', $section) }}" method="POST" data-confirm-delete="Delete this custom home-page section?">
                                @csrf @method('DELETE')
                                <button class="admin-button danger small" type="submit">Delete</button>
                            </form>
                        @endif
                    </div>
                </article>
            @endforeach
        </div>
    </section>
@empty
    <x-admin.empty title="No page sections found" description="No editable content sections exist for this page." />
@endforelse
@endsection
