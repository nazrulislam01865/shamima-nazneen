@extends('layouts.admin')

@section('title', $pageConfig['label'])
@section('page_title', $pageConfig['label'])

@section('content')
<x-admin.page-header
    :title="$pageConfig['label'].' settings'"
    :description="$pageConfig['description']"
    :action="route($pageConfig['public_route'])"
    action-label="View Public Page ↗"
/>

<section class="page-control-summary">
    <div>
        <span class="page-control-icon">@include('admin.partials.icon', ['name' => $pageConfig['icon']])</span>
        <div>
            <strong>{{ $sectionActive }} of {{ $sectionTotal }} page sections are visible</strong>
            <p>The public template structure remains unchanged. Use the settings below to control its content and visibility.</p>
        </div>
    </div>
    <a class="admin-button secondary" href="{{ route('admin.content-sections.index', ['page' => $pageKey]) }}">Edit Page Content</a>
</section>

<div class="page-settings-grid">
    @foreach($pageConfig['modules'] as $module)
        @continue($module['key'] === 'overview')
        @php
            $metric = $metrics[$module['key']] ?? null;
        @endphp
        <a class="page-setting-card" href="{{ route($module['route'], $module['params'] ?? []) }}">
            <span class="page-setting-card-icon">@include('admin.partials.icon', ['name' => $module['icon']])</span>
            <span class="page-setting-card-copy">
                <span class="page-setting-card-heading">
                    <strong>{{ $module['label'] }}</strong>
                    @if($metric)
                        <small>{{ $metric['value'] }} {{ $metric['label'] }}</small>
                    @endif
                </span>
                <span>{{ $module['description'] }}</span>
            </span>
            <span class="page-setting-card-arrow" aria-hidden="true">→</span>
        </a>
    @endforeach
</div>
@endsection
