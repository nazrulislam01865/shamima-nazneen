@extends('layouts.admin')
@section('title', 'Work Categories')
@section('page_title', 'Work Categories')
@section('page_context', 'Works Page')
@section('content')
<x-admin.page-header title="Work categories" description="Control the work filters, homepage work cards, and category sequence used on the public pages." :action="route('admin.work-categories.create')" action-label="Add Work Category" />
<section class="admin-card">
@if($workCategories->isEmpty())
    <x-admin.empty title="No work categories yet" :action="route('admin.work-categories.create')" action-label="Add Work Category" />
@else
<x-admin.sortable-help />
<div class="table-wrap"><table class="admin-table">
<thead><tr><th class="move-column">Move</th><th>Category</th><th>Works</th><th>Home</th><th>Status</th><th></th></tr></thead>
<tbody data-sortable-list data-reorder-url="{{ route('admin.reorder', ['resource' => 'work-categories']) }}">@foreach($workCategories as $category)
<tr data-sortable-item data-id="{{ $category->id }}">
    <td class="move-cell"><x-admin.sort-handle :label="'Move category '.$category->name" /></td>
    <td><div class="table-title">@if($category->home_image_url)<img src="{{ $category->home_image_url }}" alt="">@endif<div><strong>{{ $category->name }}</strong><small>/works?category={{ $category->slug }}</small></div></div></td>
    <td>{{ $category->works_count }}</td><td><x-admin.status :active="$category->show_on_home" true-label="Shown" false-label="Not shown" /></td><td><x-admin.status :active="$category->is_active" /></td>
    <td><div class="table-actions"><a class="admin-button secondary small" href="{{ route('admin.work-categories.edit', $category) }}">Edit</a><form action="{{ route('admin.work-categories.destroy', $category) }}" method="POST" data-confirm-delete="Delete this category? Categories containing works cannot be deleted.">@csrf @method('DELETE')<button class="admin-button danger small" type="submit">Delete</button></form></div></td>
</tr>
@endforeach</tbody>
</table></div>
@endif
</section>
@endsection
