@extends('layouts.admin')

@php

    $homeOnly = request()->boolean('home');

@endphp
@section('title', $homeOnly ? 'Homepage Works' : 'Works & Filmography')
@section('page_title', $homeOnly ? 'Homepage Works' : 'Works & Filmography')
@section('page_context', $homeOnly ? 'Home Page' : 'Works Page')

@section('content')
<x-admin.page-header
    :title="$homeOnly ? 'Homepage works' : 'Works archive'"
    :description="$homeOnly
        ? 'These entries appear in the homepage work sections. Drag them into the exact sequence visitors should see.'
        : 'Add films, television dramas, theatre, digital releases, direction, and other selected work. Drag entries to control their public sequence.'"
    :action="route('admin.works.create', $homeOnly ? ['home' => 1] : [])"
    action-label="Add Work"
/>

@if($homeOnly)
    <div class="context-notice">
        <strong>Homepage filter is active.</strong>
        <span>Only work entries with “Show on home page” enabled are listed.</span>
        <a href="{{ route('admin.works.index') }}">View all works</a>
    </div>
@endif

<form class="filters-bar" method="GET" action="{{ route('admin.works.index') }}">
    @if($homeOnly)<input type="hidden" name="home" value="1">@endif
    <div class="filter-field"><label for="search">Search</label><input id="search" type="search" name="search" value="{{ request('search') }}"></div>
    <div class="filter-field"><label for="category">Category</label><select id="category" name="category"><option value="">Select a category or show all</option>@foreach($categories as $category)<option value="{{ $category->slug }}" @selected(request('category') === $category->slug)>{{ $category->name }}</option>@endforeach</select></div>
    <button class="admin-button primary" type="submit">Filter</button>
    @if(request()->hasAny(['search','category']))
        <a class="admin-button secondary" href="{{ route('admin.works.index', $homeOnly ? ['home' => 1] : []) }}">Clear</a>
    @endif
</form>

<section class="admin-card">
@if($works->isEmpty())
    <x-admin.empty
        :title="$homeOnly ? 'No works are selected for the homepage' : 'No matching works'"
        :description="$homeOnly ? 'Edit an existing work and enable Show on home page, or add a new work.' : 'Add a work or clear the current filters.'"
        :action="route('admin.works.create', $homeOnly ? ['home' => 1] : [])"
        action-label="Add Work"
    />
@else
<x-admin.sortable-help />
<div class="table-wrap"><table class="admin-table">
<thead><tr><th class="move-column">Move</th><th>Work</th><th>Category</th><th>Year</th><th>Home</th><th>Status</th><th></th></tr></thead>
<tbody data-sortable-list data-reorder-url="{{ route('admin.reorder', ['resource' => 'works']) }}">@foreach($works as $work)
<tr data-sortable-item data-id="{{ $work->id }}">
    <td class="move-cell"><x-admin.sort-handle :label="'Move work '.$work->title" /></td>
    <td><div class="table-title">@if($work->image_url)<img src="{{ $work->image_url }}" alt="">@endif<div><strong>{{ $work->title }}</strong><small>{{ $work->role ?: $work->credit ?: \Illuminate\Support\Str::limit(strip_tags($work->short_description), 55) }}</small></div></div></td>
    <td>{{ $work->category?->name }}</td><td><strong>{{ $work->year ?: '—' }}</strong></td><td><x-admin.status :active="$work->show_on_home" true-label="Shown" false-label="Not shown" /></td><td><x-admin.status :active="$work->is_active" /></td>
    <td><div class="table-actions"><a class="admin-button secondary small" href="{{ route('admin.works.edit', array_filter(['work' => $work, 'home' => $homeOnly ? 1 : null])) }}">Edit</a><form action="{{ route('admin.works.destroy', $work) }}" method="POST" data-confirm-delete="Delete this work permanently?">@csrf @method('DELETE')<button class="admin-button danger small" type="submit">Delete</button></form></div></td>
</tr>
@endforeach</tbody>
</table></div>
@endif
</section>
@endsection
