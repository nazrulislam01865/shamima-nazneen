@props(['cancel', 'submit' => 'Save Changes'])
<div class="form-actions">
    <a class="admin-button secondary" href="{{ $cancel }}">Cancel</a>
    <button class="admin-button primary" type="submit" data-submit-button>{{ $submit }}</button>
</div>
