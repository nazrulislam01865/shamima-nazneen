@props(['label' => 'Move item'])
<button
    type="button"
    class="sort-handle"
    data-drag-handle
    draggable="true"
    aria-label="{{ $label }}. Drag with the mouse, or focus and press the up or down arrow key."
    title="Drag to move up or down"
>
    <span aria-hidden="true">⋮⋮</span>
</button>
