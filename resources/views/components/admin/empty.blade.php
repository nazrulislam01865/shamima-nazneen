@props(['title' => 'Nothing here yet', 'description' => null, 'action' => null, 'actionLabel' => 'Add New'])
<div class="admin-empty">
    <div class="admin-empty-icon">＋</div>
    <h3>{{ $title }}</h3>
    @if($description)<p>{{ $description }}</p>@endif
    @if($action)<a class="admin-button primary" href="{{ $action }}">{{ $actionLabel }}</a>@endif
</div>
