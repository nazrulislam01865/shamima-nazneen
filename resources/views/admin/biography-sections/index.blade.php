@extends('layouts.admin')
@section('title', 'Biography')
@section('page_title', 'Biography')
@section('page_context', 'Biography Page')
@section('content')
<x-admin.page-header title="Biography sections" description="Build the biography timeline with editable titles, year labels, rich text, images, drag-and-drop sequencing, and visibility." :action="route('admin.biography-sections.create')" action-label="Add Biography Section" />
<section class="admin-card">
    @if($biographySections->isEmpty())
        <x-admin.empty title="No biography sections yet" :action="route('admin.biography-sections.create')" action-label="Add Biography Section" />
    @else
        <x-admin.sortable-help />
        <div class="table-wrap"><table class="admin-table">
            <thead><tr><th class="move-column">Move</th><th>Section</th><th>Year / label</th><th>Status</th><th></th></tr></thead>
            <tbody data-sortable-list data-reorder-url="{{ route('admin.reorder', ['resource' => 'biography-sections']) }}">@foreach($biographySections as $section)
                <tr data-sortable-item data-id="{{ $section->id }}">
                    <td class="move-cell"><x-admin.sort-handle :label="'Move biography section '.$section->title" /></td>
                    <td><div class="table-title">@if($section->image_url)<img class="portrait" src="{{ $section->image_url }}" alt="">@endif<div><strong>{{ $section->title }}</strong><small>{{ \Illuminate\Support\Str::limit(strip_tags($section->content), 75) }}</small></div></div></td>
                    <td>{{ $section->year_label ?: '—' }}</td><td><x-admin.status :active="$section->is_active" /></td>
                    <td><div class="table-actions"><a class="admin-button secondary small" href="{{ route('admin.biography-sections.edit', $section) }}">Edit</a><form action="{{ route('admin.biography-sections.destroy', $section) }}" method="POST" data-confirm-delete="Delete this biography section?">@csrf @method('DELETE')<button class="admin-button danger small" type="submit">Delete</button></form></div></td>
                </tr>
            @endforeach</tbody>
        </table></div>
    @endif
</section>
@endsection
