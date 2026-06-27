<?php

namespace App\Http\Requests;

use App\Rules\MeaningfulRichText;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class BiographySectionRequest extends FormRequest
{
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
        return [
            'title' => ['required', 'string', 'max:255'],
            'slug' => ['nullable', 'string', 'max:255'],
            'year_label' => ['nullable', 'string', 'max:80'],
            'content' => ['required', 'string', new MeaningfulRichText],
            'library_media_id' => ['nullable', Rule::exists('media_items', 'id')->where(fn ($query) => $query->where('type', 'image'))],
            'image' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:5120'],
            'remove_image' => ['boolean'],
            'is_active' => ['boolean'],
        ];
    }
}
