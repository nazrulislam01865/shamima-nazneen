<?php

namespace App\Http\Requests;

use App\Http\Requests\Concerns\HasFriendlyValidationMessages;
use App\Rules\SafeUrl;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class MenuItemRequest extends FormRequest
{
    use HasFriendlyValidationMessages;

    public function authorize(): bool
    {
        return $this->user()?->is_admin === true;
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'open_new_tab' => $this->boolean('open_new_tab'),
            'is_active' => $this->boolean('is_active'),
            'remove_icon' => $this->boolean('remove_icon'),
        ]);
    }

    public function rules(): array
    {
        return [
            'location' => ['required', Rule::in(['header', 'footer'])],
            'label' => ['required', 'string', 'max:120'],
            'url' => ['required', 'string', 'max:500', new SafeUrl],
            'icon' => ['nullable', 'file', 'mimes:jpg,jpeg,png,webp,svg', 'max:2048'],
            'remove_icon' => ['boolean'],
            'open_new_tab' => ['boolean'],
            'is_active' => ['boolean'],
        ];
    }
}
