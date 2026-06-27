@extends('layouts.admin')

@section('title', 'Edit '.$customPage->name)
@section('page_title', 'Edit Page')
@section('page_context', 'Custom Pages')

@section('content')
<x-admin.page-header title="Edit {{ $customPage->name }}" description="Update the page content, menu placement, and public visibility." />
<form class="admin-form" action="{{ route('admin.custom-pages.update', $customPage) }}" method="POST" data-disable-on-submit>
    @csrf
    @method('PUT')
    @include('admin.custom-pages._form')
    <x-admin.form-actions :cancel="route('admin.custom-pages.index')" submit="Save Page" />
</form>
@endsection
