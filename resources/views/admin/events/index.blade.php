@extends('layouts.admin')
@section('title', 'Events')
@section('page_title', 'Events')
@section('page_context', 'Home Page')
@section('content')
<x-admin.page-header title="Events & appearances" description="Manage cultural programs, interviews, guest appearances, public links, and the homepage event sequence." :action="route('admin.events.create')" action-label="Add Event" />
<section class="admin-card">
@if($events->isEmpty())
    <x-admin.empty title="No events yet" :action="route('admin.events.create')" action-label="Add Event" />
@else
<x-admin.sortable-help />
<div class="table-wrap"><table class="admin-table">
<thead><tr><th class="move-column">Move</th><th>Event</th><th>Destination</th><th>Date</th><th>Home</th><th>Status</th><th></th></tr></thead>
<tbody data-sortable-list data-reorder-url="{{ route('admin.reorder', ['resource' => 'events']) }}">@foreach($events as $event)
<tr data-sortable-item data-id="{{ $event->id }}"><td class="move-cell"><x-admin.sort-handle :label="'Move event '.$event->title" /></td><td><div class="table-title">@if($event->image_url)<img src="{{ $event->image_url }}" alt="">@endif<div><strong>{{ $event->title }}</strong><small>{{ \Illuminate\Support\Str::limit(strip_tags($event->description), 60) }}</small></div></div></td><td>@if($event->workCategory)<strong>Works: {{ $event->workCategory->name }}</strong>@elseif($event->link_url)<span>{{ $event->link_name ?: 'Custom link' }}</span>@else<span>Not linked</span>@endif</td><td>{{ $event->event_date?->format('M d, Y') ?: 'No date' }}</td><td><x-admin.status :active="$event->show_on_home" true-label="Shown" false-label="Not shown" /></td><td><x-admin.status :active="$event->is_active" /></td><td><div class="table-actions"><a class="admin-button secondary small" href="{{ route('admin.events.edit', $event) }}">Edit</a><form action="{{ route('admin.events.destroy', $event) }}" method="POST" data-confirm-delete="Delete this event?">@csrf @method('DELETE')<button class="admin-button danger small" type="submit">Delete</button></form></div></td></tr>
@endforeach</tbody>
</table></div>
@endif
</section>
@endsection
