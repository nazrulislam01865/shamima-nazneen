@extends('layouts.admin')
@section('title', 'Inquiries')
@section('page_title', 'Inquiries')
@section('page_context', 'Home Page')
@section('content')
<x-admin.page-header title="Contact inquiries" description="Review booking, media, interview, collaboration, and professional messages sent from the public website." />
<form class="filters-bar" method="GET" action="{{ route('admin.inquiries.index') }}">
    <div class="filter-field"><label for="status">Status</label><select id="status" name="status"><option value="">Select a status or show all</option>@foreach(['new'=>'New','read'=>'Read','replied'=>'Replied','closed'=>'Closed'] as $value => $label)<option value="{{ $value }}" @selected(request('status') === $value)>{{ $label }}</option>@endforeach</select></div>
    <button class="admin-button primary" type="submit">Filter</button>@if(request('status'))<a class="admin-button secondary" href="{{ route('admin.inquiries.index') }}">Clear</a>@endif
</form>
<section class="admin-card">
@if($inquiries->isEmpty())
    <x-admin.empty title="No inquiries found" description="Messages submitted through the contact form will appear here." />
@else
<div class="table-wrap"><table class="admin-table">
<thead><tr><th>Sender</th><th>Subject / message</th><th>Phone</th><th>Status</th><th>Received</th><th></th></tr></thead>
<tbody>@foreach($inquiries as $inquiry)
<tr>
    <td><div class="table-title"><div><strong>{{ $inquiry->name }}</strong><small>{{ $inquiry->email }}</small></div></div></td>
    <td>{{ \Illuminate\Support\Str::limit($inquiry->subject ?: $inquiry->message, 72) }}</td><td>{{ $inquiry->phone ?: '—' }}</td><td><span class="status-badge {{ $inquiry->status }}">{{ ucfirst($inquiry->status) }}</span></td><td>{{ $inquiry->created_at->format('M d, Y H:i') }}</td>
    <td><a class="admin-button secondary small" href="{{ route('admin.inquiries.show', $inquiry) }}">Open</a></td>
</tr>
@endforeach</tbody>
</table></div>
@if($inquiries->hasPages())<div class="pagination-wrap">{{ $inquiries->links() }}</div>@endif
@endif
</section>
@endsection
