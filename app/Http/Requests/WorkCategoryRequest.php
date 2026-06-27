<?php

namespace App\Http\Requests;

use App\Rules\SafeUrl;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Validator;

class WorkCategoryRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()?->is_admin === true;
    }

    protected function prepareForValidation(): void
    {
        $links = collect($this->input('home_links', []))
            ->map(fn ($link): array => [
                'label' => trim((string) ($link['label'] ?? '')),
                'url' => trim((string) ($link['url'] ?? '')),
            ])
            ->filter(fn (array $link): bool => $link['label'] !== '' || $link['url'] !== '')
            ->values()
            ->all();

        $this->merge([
            'home_links' => $links,
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
            'home_links' => ['nullable', 'array', 'max:10'],
            'home_links.*.label' => ['required_with:home_links.*.url', 'nullable', 'string', 'max:120'],
            'home_links.*.url' => ['required_with:home_links.*.label', 'nullable', 'string', 'max:500', new SafeUrl],
            'show_on_home' => ['boolean'],
            'is_active' => ['boolean'],
        ];
    }

    public function after(): array
    {
        return [
            function (Validator $validator): void {
                $category = $this->route('work_category');
                $existingImage = $category instanceof \App\Models\WorkCategory
                    ? $category->home_image_path
                    : null;

                if ($this->boolean('show_on_home')
                    && ! $this->hasFile('home_image')
                    && ! $this->filled('library_media_id')
                    && (blank($existingImage) || $this->boolean('remove_home_image'))) {
                    $validator->errors()->add('home_image', 'Upload a home card image or choose one from Gallery / Media Library.');
                }
            },
        ];
    }
}
