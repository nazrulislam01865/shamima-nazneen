@extends('layouts.admin')
@section('title', 'Edit Event')
@section('page_title', 'Events')
@section('page_context', 'Home Page')
@section('content')
<x-admin.page-header :title="'Edit: '.$event->title" description="Update the event details and home-page visibility." />
<form class="admin-form" action="{{ route('admin.events.update', $event) }}" method="POST" enctype="multipart/form-data" data-disable-on-submit>@csrf @method('PUT') @include('admin.events._form')<x-admin.form-actions :cancel="route('admin.events.index')" submit="Save Event" /></form>
@endsection
