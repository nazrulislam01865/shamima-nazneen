<?php

namespace App\Http\Requests;

use App\Http\Requests\Concerns\HasFriendlyValidationMessages;
use App\Models\CustomPage;
use App\Rules\MeaningfulRichText;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CustomPageRequest extends FormRequest
{
    use HasFriendlyValidationMessages;

    public function authorize(): bool
    {
        return $this->user()?->is_admin === true;
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'show_in_header' => $this->boolean('show_in_header'),
            'show_in_footer' => $this->boolean('show_in_footer'),
            'is_active' => $this->boolean('is_active'),
        ]);
    }

    public function rules(): array
    {
        $page = $this->route('customPage');
        $pageId = $page instanceof CustomPage ? $page->id : null;

        return [
            'name' => ['required', 'string', 'max:160'],
            'slug' => [
                'nullable',
                'string',
                'max:180',
                'regex:/^[a-z0-9]+(?:-[a-z0-9]+)*$/',
                Rule::unique('custom_pages', 'slug')->ignore($pageId),
            ],
            'content' => ['required', 'string', new MeaningfulRichText],
            'show_in_header' => ['boolean'],
            'show_in_footer' => ['boolean'],
            'is_active' => ['boolean'],
        ];
    }

    public function messages(): array
    {
        return $this->friendlyValidationMessages([
            'slug.regex' => 'The page URL name may contain lowercase letters, numbers, and hyphens only.',
        ]);
    }
}
