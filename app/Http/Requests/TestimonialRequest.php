<?php

namespace App\Http\Requests;

use App\Rules\SafeUrl;
use Illuminate\Foundation\Http\FormRequest;

class TestimonialRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()?->is_admin === true;
    }

    protected function prepareForValidation(): void
    {
        $this->merge(['is_active' => $this->boolean('is_active')]);
    }

    public function rules(): array
    {
        return [
            'quote' => ['required', 'string', 'max:3000'],
            'author' => ['nullable', 'string', 'max:160'],
            'source' => ['nullable', 'string', 'max:160'],
            'source_url' => ['nullable', new SafeUrl, 'max:500'],
            'is_active' => ['boolean'],
        ];
    }
}
