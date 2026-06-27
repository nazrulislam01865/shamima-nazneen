<?php

namespace App\Http\Requests;

use App\Rules\SafeUrl;
use App\Support\YouTube;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Validator;

class MediaItemRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()?->is_admin === true;
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'show_in_gallery' => $this->boolean('show_in_gallery'),
            'show_on_home' => $this->boolean('show_on_home'),
            'show_in_profiles' => $this->boolean('show_in_profiles'),
            'show_in_biography' => $this->boolean('show_in_biography'),
            'is_featured' => $this->boolean('is_featured'),
            'is_active' => $this->boolean('is_active'),
            'remove_image' => $this->boolean('remove_image'),
        ]);
    }

    public function rules(): array
    {
        return [
            'type' => ['required', Rule::in(['image', 'video'])],
            'title' => ['required', 'string', 'max:255'],
            'alt_text' => ['nullable', 'string', 'max:255'],
            'category' => ['nullable', 'string', 'max:120'],
            'year' => ['nullable', 'integer', 'digits:4', 'min:1900', 'max:'.(date('Y') + 5)],
            'description' => ['nullable', 'string'],
            'fallback_text' => ['nullable', 'string', 'max:255'],
            'image' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:8192'],
            'remove_image' => ['boolean'],
            'youtube_url' => ['nullable', 'string', 'max:500'],
            'link_name' => ['nullable', 'required_with:link_url', 'string', 'max:120'],
            'link_url' => ['nullable', 'required_with:link_name', new SafeUrl, 'max:500'],
            'show_in_gallery' => ['boolean'],
            'show_on_home' => ['boolean'],
            'show_in_profiles' => ['boolean'],
            'show_in_biography' => ['boolean'],
            'is_featured' => ['boolean'],
            'is_active' => ['boolean'],
        ];
    }

    public function after(): array
    {
        return [
            function (Validator $validator): void {
                $mediaItem = $this->route('media_item');
                $existingImagePath = $mediaItem instanceof \App\Models\MediaItem ? $mediaItem->image_path : null;

                if ($this->input('type') === 'image' && ! $this->hasFile('image') && (blank($existingImagePath) || $this->boolean('remove_image'))) {
                    $validator->errors()->add('image', 'An image is required for an image library item.');
                }

                if ($this->input('type') === 'video' && ! YouTube::id($this->input('youtube_url'))) {
                    $validator->errors()->add('youtube_url', 'Enter a valid YouTube video URL.');
                }

                if ($this->boolean('show_in_profiles') && blank($this->input('link_url')) && $this->input('type') !== 'video') {
                    $validator->errors()->add('link_url', 'Add a destination link when an image is used as a Profiles & Media card.');
                }
            },
        ];
    }
}
