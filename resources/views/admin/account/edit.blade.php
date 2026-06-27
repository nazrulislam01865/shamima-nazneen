@extends('layouts.admin')
@section('title', 'Administrator Account')
@section('page_title', 'Administrator Account')
@section('page_context', 'General Settings')
@section('content')
<x-admin.page-header title="Administrator account" description="Update the administrator name, login email, or password. Leave the password fields empty to keep the current password." />
<form class="admin-form" action="{{ route('admin.account.update') }}" method="POST" data-disable-on-submit>
    @csrf @method('PUT')
    <section class="form-section">
        <div class="form-section-heading"><h2>Login information</h2></div>
        <div class="form-grid">
            <x-admin.input name="name" label="Administrator name" :value="$admin->name" required autocomplete="name" placeholder="Enter the administrator's full name" />
            <x-admin.input name="email" label="Login email" type="email" :value="$admin->email" required autocomplete="email" placeholder="admin@example.com" />
        </div>
    </section>
    <section class="form-section">
        <div class="form-section-heading"><h2>Change password</h2><p>For security, the current password is required when setting a new one.</p></div>
        <div class="form-grid">
            <x-admin.input name="current_password" label="Current password" type="password" autocomplete="current-password" />
            <div></div>
            <x-admin.input name="password" label="New password" type="password" autocomplete="new-password" help="At least 10 characters with uppercase, lowercase, and a number." />
            <x-admin.input name="password_confirmation" label="Confirm new password" type="password" autocomplete="new-password" />
        </div>
    </section>
    <x-admin.form-actions :cancel="route('admin.dashboard')" submit="Save Account" />
</form>
@endsection
