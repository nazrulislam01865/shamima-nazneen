@extends('layouts.admin')

@section('title', 'Custom Pages')
@section('page_title', 'Custom Pages')
@section('page_context', 'Website Pages')

@section('content')
<x-admin.page-header
    title="Custom pages"
    description="Create content pages and choose whether each page appears in the header menu, footer menu, or both."
    :action="route('admin.custom-pages.create')"
    action-label="Add Page"
/>

<div class="admin-card">
    <x-admin.sortable-help text="Drag a page using the move handle. The saved sequence is used in the header and footer menus." />
    @if($customPages->isEmpty())
        <x-admin.empty title="No custom pages yet" message="Add a page such as Privacy Policy, Press Kit, Awards, or Terms." />
    @else
        <div class="table-wrap">
            <table class="admin-table">
                <thead>
                    <tr>
                        <th class="move-column">Move</th>
                        <th>Page</th>
                        <th>Header</th>
                        <th>Footer</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody data-sortable-list data-reorder-url="{{ route('admin.reorder', ['resource' => 'custom-pages']) }}">
                    @foreach($customPages as $page)
                        <tr data-sortable-item data-id="{{ $page->id }}">
                            <td class="move-cell"><x-admin.sort-handle :label="'Move page '.$page->name" /></td>
                            <td>
                                <strong>{{ $page->name }}</strong>
                                <small class="table-subtext">/pages/{{ $page->slug }}</small>
                            </td>
                            <td><x-admin.status :active="$page->show_in_header" true-label="Shown" false-label="Hidden" /></td>
                            <td><x-admin.status :active="$page->show_in_footer" true-label="Shown" false-label="Hidden" /></td>
                            <td><x-admin.status :active="$page->is_active" /></td>
                            <td>
                                <div class="table-actions">
                                    @if($page->is_active)
                                        <a class="admin-button secondary small" href="{{ route('pages.show', $page) }}" target="_blank" rel="noopener noreferrer">View</a>
                                    @endif
                                    <a class="admin-button secondary small" href="{{ route('admin.custom-pages.edit', $page) }}">Edit</a>
                                    <form action="{{ route('admin.custom-pages.destroy', $page) }}" method="POST" data-confirm-delete="Delete this page permanently?">
                                        @csrf
                                        @method('DELETE')
                                        <button class="admin-button danger small" type="submit">Delete</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
</div>
@endsection
