@extends('layouts.admin')
@section('title', 'Add Quote')
@section('page_title', 'Audience Quotes')
@section('page_context', 'Home Page')
@section('content')
<x-admin.page-header title="Add audience quote" description="Add a short response or appreciation quote." />
<form class="admin-form" action="{{ route('admin.testimonials.store') }}" method="POST" data-disable-on-submit>@csrf @include('admin.testimonials._form')<x-admin.form-actions :cancel="route('admin.testimonials.index')" submit="Create Quote" /></form>
@endsection
