@extends('layouts.admin')
@section('title', 'Add Work')
@section('page_title', 'Works & Filmography')
@section('page_context', 'Works Page')
@section('content')
<x-admin.page-header title="Add work" description="Create a work entry with its year, rich popup details, optional external link, and home-page visibility." />
<form class="admin-form" action="{{ route('admin.works.store', ($defaultShowOnHome ?? false) ? ['home' => 1] : []) }}" method="POST" enctype="multipart/form-data" data-disable-on-submit>@csrf @include('admin.works._form')<x-admin.form-actions :cancel="route('admin.works.index', ($defaultShowOnHome ?? false) ? ['home' => 1] : [])" submit="Create Work" /></form>
@endsection
