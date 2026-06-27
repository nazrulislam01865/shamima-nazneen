@extends('layouts.admin')
@section('title', 'Add Event')
@section('page_title', 'Events')
@section('page_context', 'Home Page')
@section('content')
<x-admin.page-header title="Add event or appearance" description="Add an event, interview, program, or professional appearance." />
<form class="admin-form" action="{{ route('admin.events.store') }}" method="POST" enctype="multipart/form-data" data-disable-on-submit>@csrf @include('admin.events._form')<x-admin.form-actions :cancel="route('admin.events.index')" submit="Create Event" /></form>
@endsection
