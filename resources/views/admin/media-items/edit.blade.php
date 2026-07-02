@extends('layouts.admin')
@section('title', 'Edit '.ucfirst($mediaItem->type))
@section('page_title', ucfirst($mediaItem->type).' Gallery')
@section('page_context', request()->boolean('profiles') || request()->boolean('home') ? 'Home Page' : 'Gallery Page')
@php
    $context = array_filter([
        'media_item' => $mediaItem,
        'type' => request('type', $mediaItem->type),
        'home' => request()->boolean('home') ? 1 : null,
        'profiles' => request()->boolean('profiles') ? 1 : null,
        'gallery' => request()->boolean('gallery') ? 1 : null,
    ]);
    $cancelContext = collect($context)->except('media_item')->all();
@endphp
@section('content')
<x-admin.page-header :title="'Edit: '.$mediaItem->title" :description="ucfirst($mediaItem->type).' Gallery item · Choose all placements from this form.'" />
<form class="admin-form" action="{{ route('admin.media-items.update', $context) }}" method="POST" enctype="multipart/form-data" data-disable-on-submit>
    @csrf
    @method('PUT')
    @if(request()->boolean('home'))<input type="hidden" name="home" value="1">@endif
    @if(request()->boolean('profiles'))<input type="hidden" name="profiles" value="1">@endif
    @if(request()->boolean('gallery'))<input type="hidden" name="gallery" value="1">@endif
    @include('admin.media-items._form')
    <x-admin.form-actions :cancel="route('admin.media-items.index', $cancelContext)" submit="Save Media Item" />
</form>
@endsection
