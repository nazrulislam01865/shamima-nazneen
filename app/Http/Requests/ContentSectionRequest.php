<?php

namespace App\Http\Requests;

use App\Http\Requests\Concerns\HasFriendlyValidationMessages;
use App\Rules\SafeUrl;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ContentSectionRequest extends FormRequest
{
    use HasFriendlyValidationMessages;

    public function authorize(): bool
    {
        return $this->user()?->is_admin === true;
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'is_active' => $this->boolean('is_active'),
            'remove_image' => $this->boolean('remove_image'),
        ]);
    }

    public function rules(): array
    {
        $creating = $this->routeIs('admin.content-sections.store');

        return [
            'page' => [$creating ? 'required' : 'nullable', Rule::in(['home'])],
            'section_name' => [$creating ? 'required' : 'nullable', 'string', 'max:120'],
            'layout' => ['nullable', Rule::in(['text-only', 'image-left', 'image-right'])],
            'eyebrow' => ['nullable', 'string', 'max:120'],
            'title' => [$creating ? 'required' : 'nullable', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'secondary_text' => ['nullable', 'string'],
            'button_label' => ['nullable', 'string', 'max:120'],
            'button_url' => ['nullable', 'string', 'max:500', new SafeUrl],
            'library_media_id' => ['nullable', Rule::exists('media_items', 'id')->where(fn ($query) => $query->where('type', 'image'))],
            'image' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:5120'],
            'remove_image' => ['boolean'],
            'is_active' => ['boolean'],
        ];
    }
}
