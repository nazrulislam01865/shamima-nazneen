@extends('layouts.admin')
@section('title', 'Edit Work')
@section('page_title', 'Works & Filmography')
@section('page_context', 'Works Page')
@php
    $homeContext = request()->boolean('home');
@endphp
@section('content')
<x-admin.page-header :title="'Edit: '.$work->title" :description="'Category: '.($work->category?->name ?: 'Not assigned').' · Year: '.$work->year" />
<form class="admin-form" action="{{ route('admin.works.update', array_filter(['work' => $work, 'home' => $homeContext ? 1 : null])) }}" method="POST" enctype="multipart/form-data" data-disable-on-submit>@csrf @method('PUT') @include('admin.works._form')<x-admin.form-actions :cancel="route('admin.works.index', $homeContext ? ['home' => 1] : [])" submit="Save Work" /></form>
@endsection
