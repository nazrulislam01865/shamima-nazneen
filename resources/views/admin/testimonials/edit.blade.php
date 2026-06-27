@extends('layouts.admin')
@section('title', 'Edit Quote')
@section('page_title', 'Audience Quotes')
@section('page_context', 'Home Page')
@section('content')
<x-admin.page-header title="Edit audience quote" description="Update its wording, attribution, source, order, or visibility." />
<form class="admin-form" action="{{ route('admin.testimonials.update', $testimonial) }}" method="POST" data-disable-on-submit>@csrf @method('PUT') @include('admin.testimonials._form')<x-admin.form-actions :cancel="route('admin.testimonials.index')" submit="Save Quote" /></form>
@endsection
