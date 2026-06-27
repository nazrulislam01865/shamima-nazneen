@extends('layouts.admin')

@php
    $type = $forcedType ?? (in_array(request('type'), ['image', 'video'], true) ? request('type') : null);
    $homeOnly = request()->boolean('home');
    $profilesOnly = request()->boolean('profiles');
    $galleryOnly = request()->boolean('gallery');
    $typeLabel = $type === 'image' ? 'Images' : ($type === 'video' ? 'Videos' : 'All Media');
    $pageTitle = $profilesOnly ? 'Profiles & Media Cards' : ($homeOnly ? 'Homepage '.$typeLabel : 'Gallery / Media Library');
    $context = array_filter([
        'type' => $type,
        'home' => $homeOnly ? 1 : null,
        'profiles' => $profilesOnly ? 1 : null,
        'gallery' => $galleryOnly ? 1 : null,
    ]);
    $baseListUrl = route('admin.media-items.index', $context);
@endphp

@section('title', $pageTitle)
@section('page_title', $pageTitle)
@section('page_context', $profilesOnly || $homeOnly ? 'Home Page' : 'Gallery Page')

@section('content')
<x-admin.page-header
    :title="strtolower($pageTitle)"
    :description="$profilesOnly
        ? 'Choose image or video items that become clickable cards in the homepage Profiles & Media section.'
        : ($homeOnly
            ? 'Only items selected for this homepage gallery section are listed. Drag items to control their sequence.'
            : 'Keep all website images and YouTube links in one library, then choose where each item is displayed.')"
    :action="route('admin.media-items.create', $context)"
    :action-label="$type === 'image' ? 'Add Image' : ($type === 'video' ? 'Add Video' : 'Add Media Item')"
/>

@if($homeOnly || $profilesOnly || $galleryOnly)
    <div class="context-notice">
        <strong>Placement filter is active.</strong>
        <span>
            @if($profilesOnly) Only items enabled for Profiles & Media cards are listed.
            @elseif($homeOnly) Only items enabled for the matching homepage gallery section are listed.
            @else Only items enabled for the public Gallery page are listed.
            @endif
        </span>
        <a href="{{ route('admin.media-items.index') }}">Open complete media library</a>
    </div>
@endif

<nav class="page-filter-tabs" aria-label="Media library filters">
    <a href="{{ route('admin.media-items.index') }}" class="{{ ! $type && ! $homeOnly && ! $profilesOnly && ! $galleryOnly ? 'active' : '' }}">All Media</a>
    <a href="{{ route('admin.gallery-media.images') }}" class="{{ $type === 'image' && ! $homeOnly && ! $profilesOnly ? 'active' : '' }}">Images</a>
    <a href="{{ route('admin.gallery-media.videos') }}" class="{{ $type === 'video' && ! $homeOnly && ! $profilesOnly ? 'active' : '' }}">Videos</a>
    <a href="{{ route('admin.media-items.index', ['gallery' => 1]) }}" class="{{ $galleryOnly ? 'active' : '' }}">Public Gallery</a>
    <a href="{{ route('admin.media-items.index', ['profiles' => 1]) }}" class="{{ $profilesOnly ? 'active' : '' }}">Profiles & Media</a>
</nav>

<form class="filters-bar" method="GET" action="{{ $baseListUrl }}">
    @if($homeOnly)<input type="hidden" name="home" value="1">@endif
    @if($profilesOnly)<input type="hidden" name="profiles" value="1">@endif
    @if($galleryOnly)<input type="hidden" name="gallery" value="1">@endif
    @if($type)<input type="hidden" name="type" value="{{ $type }}">@endif
    <div class="filter-field"><label for="search">Search</label><input id="search" type="search" name="search" value="{{ request('search') }}"></div>
    @unless($type)
        <div class="filter-field"><label for="type">Media type</label><select id="type" name="type"><option value="">Show images and videos</option><option value="image" @selected(request('type') === 'image')>Images</option><option value="video" @selected(request('type') === 'video')>Videos</option></select></div>
    @endunless
    <button class="admin-button primary" type="submit">Filter</button>
    @if(request('search'))<a class="admin-button secondary" href="{{ $baseListUrl }}">Clear</a>@endif
</form>

<section class="admin-card">
@if($mediaItems->isEmpty())
    <x-admin.empty
        title="No matching media items"
        description="Add an image or YouTube video, then choose its Gallery, homepage, and Profiles & Media placements."
        :action="route('admin.media-items.create', $context)"
        :action-label="$type === 'image' ? 'Add Image' : ($type === 'video' ? 'Add Video' : 'Add Media Item')"
    />
@else
<x-admin.sortable-help />
<div class="table-wrap"><table class="admin-table">
<thead><tr><th class="move-column">Move</th><th>Media item</th><th>Type</th><th>Public Gallery</th><th>Homepage</th><th>Profiles</th><th>Status</th><th></th></tr></thead>
<tbody data-sortable-list data-reorder-url="{{ route('admin.reorder', ['resource' => 'media-items']) }}">@foreach($mediaItems as $item)
<tr data-sortable-item data-id="{{ $item->id }}">
    <td class="move-cell"><x-admin.sort-handle :label="'Move media item '.$item->title" /></td>
    <td><div class="table-title">@if($item->image_url)<img src="{{ $item->image_url }}" alt="" data-fallback-text="{{ $item->fallback_text ?: 'Preview unavailable' }}">@endif<div><strong>{{ $item->title }}</strong><small>{{ $item->category ?: 'Uncategorized' }}{{ $item->year ? ' · '.$item->year : '' }}</small></div></div></td>
    <td><span class="status-badge {{ $item->type === 'video' ? 'read' : 'active' }}">{{ ucfirst($item->type) }}</span></td>
    <td><x-admin.status :active="$item->show_in_gallery" true-label="Shown" false-label="Hidden" /></td>
    <td><x-admin.status :active="$item->show_on_home" true-label="Shown" false-label="Hidden" /></td>
    <td><x-admin.status :active="$item->show_in_profiles" true-label="Shown" false-label="Hidden" /></td>
    <td><x-admin.status :active="$item->is_active" /></td>
    <td><div class="table-actions"><a class="admin-button secondary small" href="{{ route('admin.media-items.edit', array_merge(['media_item' => $item], $context)) }}">Edit</a><form action="{{ route('admin.media-items.destroy', $item) }}" method="POST" data-confirm-delete="Delete this media library item? Files currently reused by another section will remain protected.">@csrf @method('DELETE')<button class="admin-button danger small" type="submit">Delete</button></form></div></td>
</tr>
@endforeach</tbody>
</table></div>
@endif
</section>
@endsection
