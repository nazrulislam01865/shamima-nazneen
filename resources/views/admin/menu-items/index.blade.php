@extends('layouts.admin')
@section('title', 'Navigation Menus')
@section('page_title', 'Navigation Menus')
@section('page_context', 'General Settings')
@section('content')
<x-admin.page-header
    :title="$location === 'header' ? 'Header menu items' : 'Footer menu items'"
    :description="$location === 'header' ? 'Customize and arrange the links shown in the public website header.' : 'Customize and arrange the links shown under Quick Links in the footer.'"
    :action="route('admin.menu-items.create', ['location' => $location])"
    action-label="Add Menu Item"
/>
<nav class="page-filter-tabs" aria-label="Menu location">
    <a href="{{ route('admin.menu-items.index', ['location' => 'header']) }}" class="{{ $location === 'header' ? 'active' : '' }}">Header Menu</a>
    <a href="{{ route('admin.menu-items.index', ['location' => 'footer']) }}" class="{{ $location === 'footer' ? 'active' : '' }}">Footer Menu</a>
</nav>
<section class="admin-card">
@if($menuItems->isEmpty())
    <x-admin.empty title="No menu items yet" description="Add the first navigation item for this menu." :action="route('admin.menu-items.create', ['location' => $location])" action-label="Add Menu Item" />
@else
    <x-admin.sortable-help />
    <div class="table-wrap"><table class="admin-table">
        <thead><tr><th class="move-column">Move</th><th>Menu item</th><th>Destination</th><th>New tab</th><th>Status</th><th></th></tr></thead>
        <tbody data-sortable-list data-reorder-url="{{ route('admin.reorder', ['resource' => 'menu-items']) }}">
        @foreach($menuItems as $item)
            <tr data-sortable-item data-id="{{ $item->id }}">
                <td class="move-cell"><x-admin.sort-handle :label="'Move menu item '.$item->label" /></td>
                <td><strong>{{ $item->label }}</strong><small>{{ ucfirst($item->location) }} menu</small></td>
                <td><code>{{ $item->url }}</code></td>
                <td><x-admin.status :active="$item->open_new_tab" true-label="Yes" false-label="No" /></td>
                <td><x-admin.status :active="$item->is_active" /></td>
                <td><div class="table-actions"><a class="admin-button secondary small" href="{{ route('admin.menu-items.edit', $item) }}">Edit</a><form action="{{ route('admin.menu-items.destroy', $item) }}" method="POST" data-confirm-delete="Delete this menu item?">@csrf @method('DELETE')<button class="admin-button danger small" type="submit">Delete</button></form></div></td>
            </tr>
        @endforeach
        </tbody>
    </table></div>
@endif
</section>
@endsection
