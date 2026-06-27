@extends('layouts.admin')
@section('title', 'Edit Work Category')
@section('page_title', 'Work Categories')
@section('page_context', 'Works Page')
@section('content')
<x-admin.page-header :title="'Edit: '.$workCategory->name" description="Update its archive label, home card, image, order, and visibility." />
<form class="admin-form" action="{{ route('admin.work-categories.update', $workCategory) }}" method="POST" enctype="multipart/form-data" data-disable-on-submit>@csrf @method('PUT') @include('admin.work-categories._form')<x-admin.form-actions :cancel="route('admin.work-categories.index')" submit="Save Work Category" /></form>
@endsection
