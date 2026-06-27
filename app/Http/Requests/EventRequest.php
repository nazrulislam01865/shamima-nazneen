<?php

namespace App\Http\Requests;

use App\Rules\SafeUrl;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class EventRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()?->is_admin === true;
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'show_on_home' => $this->boolean('show_on_home'),
            'is_active' => $this->boolean('is_active'),
            'remove_image' => $this->boolean('remove_image'),
        ]);
    }

    public function rules(): array
    {
        return [
            'title' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'event_date' => ['nullable', 'date'],
            'library_media_id' => ['nullable', Rule::exists('media_items', 'id')->where(fn ($query) => $query->where('type', 'image'))],
            'image' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:5120'],
            'remove_image' => ['boolean'],
            'link_name' => ['nullable', 'required_with:link_url', 'string', 'max:120'],
            'link_url' => ['nullable', 'required_with:link_name', new SafeUrl, 'max:500'],
            'work_category_id' => ['nullable', 'integer', 'exists:work_categories,id'],
            'show_on_home' => ['boolean'],
            'is_active' => ['boolean'],
        ];
    }
}
