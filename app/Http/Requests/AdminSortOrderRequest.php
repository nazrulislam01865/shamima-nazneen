<?php

namespace App\Http\Requests;

use App\Http\Requests\Concerns\HasFriendlyValidationMessages;
use Illuminate\Foundation\Http\FormRequest;

class AdminSortOrderRequest extends FormRequest
{
    use HasFriendlyValidationMessages;

    public function authorize(): bool
    {
        return $this->user()?->is_admin === true;
    }

    public function rules(): array
    {
        return [
            'order' => ['required', 'array', 'min:1'],
            'order.*' => ['required', 'integer', 'distinct', 'min:1'],
        ];
    }
}
