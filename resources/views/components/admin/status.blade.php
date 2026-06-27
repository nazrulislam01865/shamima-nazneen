@props(['active' => true, 'trueLabel' => 'Active', 'falseLabel' => 'Hidden'])
<span class="status-badge {{ $active ? 'active' : 'inactive' }}">{{ $active ? $trueLabel : $falseLabel }}</span>
