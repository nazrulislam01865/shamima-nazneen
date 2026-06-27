@extends('layouts.admin')
@section('title', 'View Inquiry')
@section('page_title', 'Inquiries')
@section('page_context', 'Home Page')
@section('content')
<x-admin.page-header :title="$inquiry->subject ?: 'Inquiry from '.$inquiry->name" :description="'Received '.$inquiry->created_at->format('F d, Y \a\t H:i')" />
<div class="dashboard-grid">
    <section class="admin-card">
        <div class="admin-card-header"><div><h2>Message</h2><p>Submitted through the official website contact form.</p></div></div>
        <div class="admin-card-body"><div class="inquiry-message">{{ $inquiry->message }}</div></div>
    </section>
    <aside style="display:grid;gap:20px;align-content:start">
        <section class="admin-card">
            <div class="admin-card-header"><h2>Sender details</h2></div>
            <div class="admin-card-body"><div class="detail-list">
                <div class="detail-item"><span>Name</span><strong>{{ $inquiry->name }}</strong></div>
                <div class="detail-item"><span>Status</span><strong>{{ ucfirst($inquiry->status) }}</strong></div>
                <div class="detail-item"><span>Email</span><strong><a href="mailto:{{ $inquiry->email }}">{{ $inquiry->email }}</a></strong></div>
                <div class="detail-item"><span>Phone</span><strong>{{ $inquiry->phone ?: 'Not provided' }}</strong></div>
            </div></div>
        </section>
        <section class="admin-card">
            <div class="admin-card-header"><h2>Manage inquiry</h2></div>
            <div class="admin-card-body">
                <form class="admin-form" action="{{ route('admin.inquiries.update', $inquiry) }}" method="POST" data-disable-on-submit>@csrf @method('PATCH')
                    <x-admin.select name="status" label="Status" :options="['new'=>'New','read'=>'Read','replied'=>'Replied','closed'=>'Closed']" :value="$inquiry->status" required :placeholder="null" />
                    <button class="admin-button primary" type="submit" data-submit-button>Update Status</button>
                </form>
                <hr style="margin:22px 0;border:0;border-top:1px solid #e5e1d8">
                <a class="admin-button secondary" href="mailto:{{ $inquiry->email }}?subject={{ rawurlencode('Re: '.($inquiry->subject ?: 'Your inquiry')) }}">Reply by email</a>
                <form style="margin-top:10px" action="{{ route('admin.inquiries.destroy', $inquiry) }}" method="POST" data-confirm-delete="Delete this inquiry permanently?">@csrf @method('DELETE')<button class="admin-button danger" type="submit">Delete Inquiry</button></form>
            </div>
        </section>
    </aside>
</div>
<p style="margin-top:22px"><a class="admin-button secondary" href="{{ route('admin.inquiries.index') }}">← Back to inquiries</a></p>
@endsection
