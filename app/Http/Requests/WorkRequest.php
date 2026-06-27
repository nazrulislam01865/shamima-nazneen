<?php

namespace App\Http\Requests;

use App\Rules\MeaningfulRichText;
use App\Rules\SafeUrl;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Validator;

class WorkRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()?->is_admin === true;
    }

    protected function prepareForValidation(): void
    {
        $links = collect($this->input('external_links', []))
            ->map(fn ($link): array => [
                'label' => trim((string) ($link['label'] ?? '')),
                'url' => trim((string) ($link['url'] ?? '')),
            ])
            ->filter(fn (array $link): bool => $link['label'] !== '' || $link['url'] !== '')
            ->values()
            ->all();

        $this->merge([
            'external_links' => $links,
            'is_featured' => $this->boolean('is_featured'),
            'show_on_home' => $this->boolean('show_on_home'),
            'is_active' => $this->boolean('is_active'),
            'remove_image' => $this->boolean('remove_image'),
        ]);
    }

    public function rules(): array
    {
        return [
            'category_id' => ['required', Rule::exists('work_categories', 'id')],
            'title' => ['required', 'string', 'max:255'],
            'slug' => ['nullable', 'string', 'max:255'],
            'year' => ['required', 'integer', 'digits:4', 'min:1900', 'max:'.(date('Y') + 5)],
            'credit' => ['nullable', 'string', 'max:160'],
            'role' => ['nullable', 'string', 'max:160'],
            'platform' => ['nullable', 'string', 'max:160'],
            'short_description' => ['required', 'string', new MeaningfulRichText],
            'library_media_id' => ['nullable', Rule::exists('media_items', 'id')->where(fn ($query) => $query->where('type', 'image'))],
            'image' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:5120'],
            'remove_image' => ['boolean'],
            'external_links' => ['nullable', 'array', 'max:10'],
            'external_links.*.label' => ['nullable', 'required_with:external_links.*.url', 'string', 'max:120'],
            'external_links.*.url' => ['nullable', 'required_with:external_links.*.label', 'string', 'max:500', new SafeUrl],
            'is_featured' => ['boolean'],
            'show_on_home' => ['boolean'],
            'is_active' => ['boolean'],
        ];
    }

    public function after(): array
    {
        return [
            function (Validator $validator): void {
                $work = $this->route('work');
                $existingImage = $work instanceof \App\Models\Work ? $work->image_path : null;

                if ($this->boolean('show_on_home')
                    && ! $this->hasFile('image')
                    && ! $this->filled('library_media_id')
                    && (blank($existingImage) || $this->boolean('remove_image'))) {
                    $validator->errors()->add('image', 'Upload a work image or choose one from Gallery / Media Library.');
                }
            },
        ];
    }
}
