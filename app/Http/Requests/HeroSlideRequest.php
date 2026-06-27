<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Validator;

class HeroSlideRequest extends FormRequest
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
            'title' => ['nullable', 'string', 'max:255'],
            'subtitle' => ['nullable', 'string', 'max:1000'],
            'library_media_id' => ['nullable', Rule::exists('media_items', 'id')->where(fn ($query) => $query->where('type', 'image'))],
            'image' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:8192'],
            'remove_image' => ['boolean'],
            'text_alignment' => ['required', Rule::in(['left', 'center', 'right'])],
            'vertical_position' => ['required', Rule::in(['top', 'center', 'bottom'])],
            'text_color' => ['required', 'regex:/^#[0-9A-Fa-f]{6}$/'],
            'overlay_opacity' => ['required', 'integer', 'min:0', 'max:80'],
            'title_size' => ['required', 'integer', 'min:32', 'max:110'],
            'subtitle_size' => ['required', 'integer', 'min:12', 'max:36'],
            'is_active' => ['boolean'],
        ];
    }

    public function after(): array
    {
        return [
            function (Validator $validator): void {
                $slide = $this->route('hero_slide');
                $existingImage = $slide instanceof \App\Models\HeroSlide ? $slide->image_path : null;

                if (! $this->hasFile('image') && ! $this->filled('library_media_id') && (blank($existingImage) || $this->boolean('remove_image'))) {
                    $validator->errors()->add('image', 'Upload a hero image or choose one from Gallery / Media Library.');
                }
            },
        ];
    }
}
