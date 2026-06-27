@extends('layouts.admin')
@section('title', 'Edit Biography Section')
@section('page_title', 'Biography')
@section('page_context', 'Biography Page')
@section('content')
<x-admin.page-header :title="'Edit: '.$biographySection->title" description="Update this biography chapter, its year label, image, order, or visibility." />
<form class="admin-form" action="{{ route('admin.biography-sections.update', $biographySection) }}" method="POST" enctype="multipart/form-data" data-disable-on-submit>@csrf @method('PUT') @include('admin.biography-sections._form')<x-admin.form-actions :cancel="route('admin.biography-sections.index')" submit="Save Biography Section" /></form>
@endsection
