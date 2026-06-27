@props(['name', 'label', 'checked' => false, 'help' => null])
<label class="checkbox-card">
    <input type="hidden" name="{{ $name }}" value="0">
    <input type="checkbox" name="{{ $name }}" value="1" @checked((bool) old($name, $checked)) {{ $attributes }}>
    <span class="checkbox-ui" aria-hidden="true"></span>
    <span><strong>{{ $label }}</strong></span>
</label>
