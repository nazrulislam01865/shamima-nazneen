@extends('layouts.admin')

@php
    $type = ($forcedType ?? request('type')) === 'video' ? 'video' : 'image';
    $homeOnly = request()->boolean('home');
    $profilesOnly = request()->boolean('profiles');
    $galleryOnly = request()->boolean('gallery');
    $typeLabel = $type === 'video' ? 'Videos' : 'Images';
    $pageTitle = $profilesOnly
        ? 'Profiles & Media '.($type === 'video' ? 'Videos' : 'Images')
        : ($homeOnly ? 'Homepage '.$typeLabel : ($type === 'video' ? 'Video Gallery' : 'Image Gallery'));
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
    :description="$type === 'video'
        ? 'Manage YouTube videos separately from the image gallery. Only video items appear here.'
        : 'Manage uploaded images separately from the video gallery. Only image items appear here.'"
    :action="route('admin.media-items.create', $context)"
    :action-label="$type === 'video' ? 'Add Video' : 'Add Image'"
/>

@if($homeOnly || $profilesOnly || $galleryOnly)
    <div class="context-notice">
        <strong>Placement filter is active.</strong>
        <span>
            @if($profilesOnly) Only {{ strtolower($typeLabel) }} enabled for Profiles & Media cards are listed.
            @elseif($homeOnly) Only {{ strtolower($typeLabel) }} enabled for the matching homepage section are listed.
            @else Only {{ strtolower($typeLabel) }} enabled for the public {{ $type === 'video' ? 'Video' : 'Image' }} Gallery page are listed.
            @endif
        </span>
        <a href="{{ route('admin.media-items.index', ['type' => $type]) }}">Open complete {{ strtolower($typeLabel) }} library</a>
    </div>
@endif

<nav class="page-filter-tabs" aria-label="Gallery type filters">
    <a href="{{ route('admin.gallery-media.images') }}" class="{{ $type === 'image' && ! $homeOnly && ! $profilesOnly ? 'active' : '' }}">Image Gallery</a>
    <a href="{{ route('admin.gallery-media.videos') }}" class="{{ $type === 'video' && ! $homeOnly && ! $profilesOnly ? 'active' : '' }}">Video Gallery</a>
</nav>

<form class="filters-bar" method="GET" action="{{ $baseListUrl }}">
    <input type="hidden" name="type" value="{{ $type }}">
    @if($homeOnly)<input type="hidden" name="home" value="1">@endif
    @if($profilesOnly)<input type="hidden" name="profiles" value="1">@endif
    @if($galleryOnly)<input type="hidden" name="gallery" value="1">@endif
    <div class="filter-field"><label for="search">Search</label><input id="search" type="search" name="search" value="{{ request('search') }}"></div>
    <button class="admin-button primary" type="submit">Filter</button>
    @if(request('search'))<a class="admin-button secondary" href="{{ $baseListUrl }}">Clear</a>@endif
</form>

<section class="admin-card">
@if($mediaItems->isEmpty())
    <x-admin.empty
        :title="$type === 'video' ? 'No videos found' : 'No images found'"
        :description="$type === 'video' ? 'Add a YouTube video, then choose where it should appear.' : 'Upload an image, then choose where it should appear.'"
        :action="route('admin.media-items.create', $context)"
        :action-label="$type === 'video' ? 'Add Video' : 'Add Image'"
    />
@else
<x-admin.sortable-help />
<div class="table-wrap"><table class="admin-table">
<thead><tr><th class="move-column">Move</th><th>{{ $type === 'video' ? 'Video item' : 'Image item' }}</th><th>Public {{ $type === 'video' ? 'Video' : 'Image' }} Gallery</th><th>Homepage</th><th>Profiles</th><th>Status</th><th></th></tr></thead>
<tbody data-sortable-list data-reorder-url="{{ route('admin.reorder', ['resource' => 'media-items']) }}">@foreach($mediaItems as $item)
<tr data-sortable-item data-id="{{ $item->id }}">
    <td class="move-cell"><x-admin.sort-handle :label="'Move gallery item '.$item->title" /></td>
    <td><div class="table-title">@if($item->image_url)<img src="{{ $item->image_url }}" alt="" data-fallback-text="{{ $item->fallback_text ?: 'Preview unavailable' }}">@endif<div><strong>{{ $item->title }}</strong><small>{{ $item->category ?: 'Uncategorized' }}{{ $item->year ? ' · '.$item->year : '' }}</small></div></div></td>
    <td><x-admin.status :active="$item->show_in_gallery" true-label="Shown" false-label="Hidden" /></td>
    <td><x-admin.status :active="$item->show_on_home" true-label="Shown" false-label="Hidden" /></td>
    <td><x-admin.status :active="$item->show_in_profiles" true-label="Shown" false-label="Hidden" /></td>
    <td><x-admin.status :active="$item->is_active" /></td>
    <td><div class="table-actions"><a class="admin-button secondary small" href="{{ route('admin.media-items.edit', array_merge(['media_item' => $item], $context)) }}">Edit</a><form action="{{ route('admin.media-items.destroy', $item) }}" method="POST" data-confirm-delete="Delete this {{ $type === 'video' ? 'video' : 'image' }} gallery item? Files currently reused by another section will remain protected.">@csrf @method('DELETE')<button class="admin-button danger small" type="submit">Delete</button></form></div></td>
</tr>
@endforeach</tbody>
</table></div>
@endif
</section>
@endsection
