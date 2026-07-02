<?php

namespace App\Http\Requests;

use App\Http\Requests\Concerns\HasFriendlyValidationMessages;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class WorkCategoryRequest extends FormRequest
{
    use HasFriendlyValidationMessages;

    public function authorize(): bool
    {
        return $this->user()?->is_admin === true;
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'show_on_home' => $this->boolean('show_on_home'),
            'is_active' => $this->boolean('is_active'),
            'remove_home_image' => $this->boolean('remove_home_image'),
        ]);
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:120'],
            'slug' => ['nullable', 'string', 'max:160'],
            'description' => ['nullable', 'string'],
            'home_title' => ['nullable', 'string', 'max:160'],
            'home_description' => ['nullable', 'string'],
            'library_media_id' => ['nullable', Rule::exists('media_items', 'id')->where(fn ($query) => $query->where('type', 'image'))],
            'home_image' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:5120'],
            'remove_home_image' => ['boolean'],
            'show_on_home' => ['boolean'],
            'is_active' => ['boolean'],
        ];
    }

    public function messages(): array
    {
        return $this->friendlyValidationMessages([
            'home_image.image' => 'Please upload a valid card image.',
            'home_image.mimes' => 'The card image must be a JPG, PNG, or WEBP file.',
            'home_image.max' => 'The card image must be 5 MB or smaller.',
        ]);
    }
}
