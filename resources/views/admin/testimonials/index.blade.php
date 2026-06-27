@extends('layouts.admin')
@section('title', 'Audience Quotes')
@section('page_title', 'Audience Quotes')
@section('page_context', 'Home Page')
@section('content')
<x-admin.page-header title="Audience appreciation" description="Manage the quotes and audience responses shown on the home page in their public sequence." :action="route('admin.testimonials.create')" action-label="Add Quote" />
<section class="admin-card">
@if($testimonials->isEmpty())
    <x-admin.empty title="No audience quotes yet" :action="route('admin.testimonials.create')" action-label="Add Quote" />
@else
<x-admin.sortable-help />
<div class="table-wrap"><table class="admin-table">
<thead><tr><th class="move-column">Move</th><th>Quote</th><th>Author / source</th><th>Status</th><th></th></tr></thead>
<tbody data-sortable-list data-reorder-url="{{ route('admin.reorder', ['resource' => 'testimonials']) }}">@foreach($testimonials as $testimonial)
<tr data-sortable-item data-id="{{ $testimonial->id }}"><td class="move-cell"><x-admin.sort-handle :label="'Move quote by '.($testimonial->author ?: 'anonymous author')" /></td><td style="max-width:520px">“{{ \Illuminate\Support\Str::limit($testimonial->quote, 120) }}”</td><td><strong>{{ $testimonial->author ?: '—' }}</strong><br><small>{{ $testimonial->source ?: '' }}</small></td><td><x-admin.status :active="$testimonial->is_active" /></td><td><div class="table-actions"><a class="admin-button secondary small" href="{{ route('admin.testimonials.edit', $testimonial) }}">Edit</a><form action="{{ route('admin.testimonials.destroy', $testimonial) }}" method="POST" data-confirm-delete="Delete this quote?">@csrf @method('DELETE')<button class="admin-button danger small" type="submit">Delete</button></form></div></td></tr>
@endforeach</tbody>
</table></div>
@endif
</section>
@endsection
