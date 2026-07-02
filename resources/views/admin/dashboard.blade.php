@extends('layouts.admin')

@section('title', 'Dashboard')
@section('page_title', 'Dashboard')
@section('page_context', 'Overview')

@section('content')
<x-admin.page-header title="Website overview" description="Manage every public section from one secure administration area. Changes are reflected on the website after saving." />

<div class="stats-grid">
    <article class="stat-card"><span>Total works</span><strong>{{ $stats['works'] }}</strong><a href="{{ route('admin.works.index') }}">Manage works →</a></article>
    <article class="stat-card"><span>Image gallery</span><strong>{{ $stats['images'] }}</strong><a href="{{ route('admin.gallery-media.images') }}">Manage images →</a></article>
    <article class="stat-card"><span>YouTube videos</span><strong>{{ $stats['videos'] }}</strong><a href="{{ route('admin.gallery-media.videos') }}">Manage videos →</a></article>
    <article class="stat-card"><span>Events</span><strong>{{ $stats['events'] }}</strong><a href="{{ route('admin.events.index') }}">Manage events →</a></article>
    <article class="stat-card"><span>Custom pages</span><strong>{{ $stats['custom_pages'] }}</strong><a href="{{ route('admin.custom-pages.index') }}">Manage pages →</a></article>
    <article class="stat-card"><span>New inquiries</span><strong>{{ $stats['new_inquiries'] }}</strong><a href="{{ route('admin.inquiries.index', ['status' => 'new']) }}">Review inquiries →</a></article>
</div>

<div class="dashboard-grid">
    <section class="admin-card">
        <div class="admin-card-header">
            <div><h2>Recent inquiries</h2><p>Latest booking, media, and professional messages.</p></div>
            <a class="admin-button secondary small" href="{{ route('admin.inquiries.index') }}">View all</a>
        </div>
        @if($recentInquiries->isEmpty())
            <x-admin.empty title="No inquiries received" description="New messages submitted through the public contact form will appear here." />
        @else
            <div class="table-wrap">
                <table class="admin-table">
                    <thead><tr><th>Sender</th><th>Subject</th><th>Status</th><th>Received</th><th></th></tr></thead>
                    <tbody>
                    @foreach($recentInquiries as $inquiry)
                        <tr>
                            <td><div class="table-title"><div><strong>{{ $inquiry->name }}</strong><small>{{ $inquiry->email }}</small></div></div></td>
                            <td>{{ \Illuminate\Support\Str::limit($inquiry->subject ?: $inquiry->message, 45) }}</td>
                            <td><span class="status-badge {{ $inquiry->status }}">{{ ucfirst($inquiry->status) }}</span></td>
                            <td>{{ $inquiry->created_at->diffForHumans() }}</td>
                            <td><a class="admin-button secondary small" href="{{ route('admin.inquiries.show', $inquiry) }}">Open</a></td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </section>

    <section class="admin-card">
        <div class="admin-card-header">
            <div><h2>Recently added works</h2><p>Quick access to current work entries.</p></div>
            <a class="admin-button secondary small" href="{{ route('admin.works.create') }}">Add work</a>
        </div>
        @if($recentWorks->isEmpty())
            <x-admin.empty title="No works added" :action="route('admin.works.create')" action-label="Add first work" />
        @else
            <div class="admin-card-body" style="display:grid;gap:12px">
                @foreach($recentWorks as $work)
                    <a href="{{ route('admin.works.edit', $work) }}" style="display:flex;gap:12px;align-items:center;text-decoration:none;padding-bottom:12px;border-bottom:1px solid #eeeae2">
                        @if($work->image_url)<img src="{{ $work->image_url }}" alt="" style="width:62px;height:46px;object-fit:cover;border-radius:8px">@endif
                        <span><strong style="display:block;font-size:13px">{{ $work->title }}</strong><small style="color:#71736b">{{ collect([$work->category?->name, $work->year])->filter()->join(' · ') ?: 'Work entry' }}</small></span>
                    </a>
                @endforeach
            </div>
        @endif
    </section>
</div>
@endsection
