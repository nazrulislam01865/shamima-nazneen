@extends('layouts.admin')
@section('title', 'Add Menu Item')
@section('page_title', 'Add Menu Item')
@section('page_context', 'General Settings')
@section('content')
<x-admin.page-header title="Add navigation item" description="Create a customizable link for the header or footer menu." />
<form class="admin-form" method="POST" action="{{ route('admin.menu-items.store') }}" enctype="multipart/form-data" data-disable-on-submit>
    @csrf
    @include('admin.menu-items._form')
    <x-admin.form-actions :cancel="route('admin.menu-items.index', ['location' => $defaultLocation])" submit="Add Menu Item" />
</form>
@endsection
