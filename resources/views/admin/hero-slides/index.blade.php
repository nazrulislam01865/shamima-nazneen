@extends('layouts.admin')
@section('title', 'Hero Slides')
@section('page_title', 'Hero Slides')
@section('page_context', 'Home Page')
@section('content')
<x-admin.page-header title="Hero slides" description="Manage the full-width images shown first at the top of the home page." :action="route('admin.hero-slides.create')" action-label="Add Hero Slide" />
<section class="admin-card">
    @if($heroSlides->isEmpty())
        <x-admin.empty title="No hero slides yet" description="Add the first home-page slider image." :action="route('admin.hero-slides.create')" action-label="Add Hero Slide" />
    @else
        <x-admin.sortable-help />
        <div class="table-wrap">
            <table class="admin-table">
                <thead><tr><th class="move-column">Move</th><th>Slide</th><th>Text placement</th><th>Status</th><th></th></tr></thead>
                <tbody data-sortable-list data-reorder-url="{{ route('admin.reorder', ['resource' => 'hero-slides']) }}">
                @foreach($heroSlides as $slide)
                    <tr data-sortable-item data-id="{{ $slide->id }}">
                        <td class="move-cell"><x-admin.sort-handle :label="'Move hero slide '.$slide->title" /></td>
                        <td><div class="table-title"><img src="{{ $slide->image_url }}" alt=""><div><strong>{{ $slide->title ?: 'Image-only slide' }}</strong><small>{{ \Illuminate\Support\Str::limit($slide->subtitle ?: 'No subtitle', 60) }}</small></div></div></td>
                        <td>{{ ucfirst($slide->settings['text_alignment'] ?? 'left') }} / {{ ucfirst($slide->settings['vertical_position'] ?? 'bottom') }}</td>
                        <td><x-admin.status :active="$slide->is_active" /></td>
                        <td><div class="table-actions"><a class="admin-button secondary small" href="{{ route('admin.hero-slides.edit', $slide) }}">Edit</a><form action="{{ route('admin.hero-slides.destroy', $slide) }}" method="POST" data-confirm-delete="Delete this hero slide?">@csrf @method('DELETE')<button class="admin-button danger small" type="submit">Delete</button></form></div></td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    @endif
</section>
@endsection
