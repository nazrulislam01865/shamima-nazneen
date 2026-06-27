@extends('layouts.admin')
@section('title', 'Edit Hero Slide')
@section('page_title', 'Hero Slides')
@section('page_context', 'Home Page')
@section('content')
<x-admin.page-header title="Edit hero slide" description="Replace the image or update its optional content and visibility." />
<form class="admin-form" action="{{ route('admin.hero-slides.update', $heroSlide) }}" method="POST" enctype="multipart/form-data" data-disable-on-submit>@csrf @method('PUT') @include('admin.hero-slides._form')<x-admin.form-actions :cancel="route('admin.hero-slides.index')" submit="Save Hero Slide" /></form>
@endsection
