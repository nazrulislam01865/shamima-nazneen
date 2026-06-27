@props(['title', 'description' => null, 'action' => null, 'actionLabel' => 'Add New'])
<div class="admin-page-header">
    <div>
        <h1>{{ $title }}</h1>
        @if($description)<p>{{ $description }}</p>@endif
    </div>
    @if($action)
        <a class="admin-button primary" href="{{ $action }}">+ {{ $actionLabel }}</a>
    @endif
</div>
