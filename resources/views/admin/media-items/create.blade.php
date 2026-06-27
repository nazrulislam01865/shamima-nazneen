@extends('layouts.admin')
@php
    $label = $defaultType === 'video' ? 'Video' : 'Image';
    $context = array_filter([
        'type' => $defaultType,
        'home' => ($defaultShowOnHome ?? false) ? 1 : null,
        'profiles' => ($defaultShowInProfiles ?? false) ? 1 : null,
        'gallery' => request()->boolean('gallery') ? 1 : null,
    ]);
@endphp
@section('title', 'Add '.$label)
@section('page_title', 'Gallery / Media Library')
@section('page_context', ($defaultShowInProfiles ?? false) ? 'Home Page' : 'Gallery Page')
@section('content')
<x-admin.page-header :title="'Add '.strtolower($label)" description="Add the item once, then choose every public section where it should appear." />
<form class="admin-form" action="{{ route('admin.media-items.store', $context) }}" method="POST" enctype="multipart/form-data" data-disable-on-submit>
    @csrf
    @if(($defaultShowOnHome ?? false))<input type="hidden" name="home" value="1">@endif
    @if(($defaultShowInProfiles ?? false))<input type="hidden" name="profiles" value="1">@endif
    @if(request()->boolean('gallery'))<input type="hidden" name="gallery" value="1">@endif
    @include('admin.media-items._form')
    <x-admin.form-actions :cancel="route('admin.media-items.index', $context)" :submit="'Create '.$label" />
</form>
@endsection
