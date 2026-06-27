@extends('layouts.admin')
@section('title', 'Add Hero Slide')
@section('page_title', 'Hero Slides')
@section('page_context', 'Home Page')
@section('content')
<x-admin.page-header title="Add hero slide" description="Add a new image to the home-page hero slider." />
<form class="admin-form" action="{{ route('admin.hero-slides.store') }}" method="POST" enctype="multipart/form-data" data-disable-on-submit>@csrf @include('admin.hero-slides._form')<x-admin.form-actions :cancel="route('admin.hero-slides.index')" submit="Create Hero Slide" /></form>
@endsection
