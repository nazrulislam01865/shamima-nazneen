@extends('layouts.admin')
@section('title', 'Edit Menu Item')
@section('page_title', 'Edit Menu Item')
@section('page_context', 'General Settings')
@section('content')
<x-admin.page-header :title="'Edit: '.$menuItem->label" description="Update the public navigation label, destination, and visibility." />
<form class="admin-form" method="POST" action="{{ route('admin.menu-items.update', $menuItem) }}" enctype="multipart/form-data" data-disable-on-submit>
    @csrf @method('PUT')
    @include('admin.menu-items._form')
    <x-admin.form-actions :cancel="route('admin.menu-items.index', ['location' => $menuItem->location])" submit="Save Menu Item" />
</form>
@endsection
