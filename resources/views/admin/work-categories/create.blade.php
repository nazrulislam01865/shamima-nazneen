@extends('layouts.admin')
@section('title', 'Add Work Category')
@section('page_title', 'Work Categories')
@section('page_context', 'Works Page')
@section('content')
<x-admin.page-header title="Add work category" description="Create a new archive filter and optional home-page category card." />
<form class="admin-form" action="{{ route('admin.work-categories.store') }}" method="POST" enctype="multipart/form-data" data-disable-on-submit>@csrf @include('admin.work-categories._form')<x-admin.form-actions :cancel="route('admin.work-categories.index')" submit="Create Work Category" /></form>
@endsection
