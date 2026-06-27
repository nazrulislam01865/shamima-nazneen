@extends('layouts.admin')

@section('title', 'Add Page')
@section('page_title', 'Add Page')
@section('page_context', 'Custom Pages')

@section('content')
<x-admin.page-header title="Add custom page" description="Create a page with rich text and images, then choose its menu placement." />
<form class="admin-form" action="{{ route('admin.custom-pages.store') }}" method="POST" data-disable-on-submit>
    @csrf
    @include('admin.custom-pages._form')
    <x-admin.form-actions :cancel="route('admin.custom-pages.index')" submit="Create Page" />
</form>
@endsection
