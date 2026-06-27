@extends('layouts.admin')
@section('title', 'Add Biography Section')
@section('page_title', 'Biography')
@section('page_context', 'Biography Page')
@section('content')
<x-admin.page-header title="Add biography section" description="Add a new chapter to the public biography timeline." />
<form class="admin-form" action="{{ route('admin.biography-sections.store') }}" method="POST" enctype="multipart/form-data" data-disable-on-submit>@csrf @include('admin.biography-sections._form')<x-admin.form-actions :cancel="route('admin.biography-sections.index')" submit="Create Biography Section" /></form>
@endsection
