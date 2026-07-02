<?php

namespace App\Http\Requests;

use App\Http\Requests\Concerns\HasFriendlyValidationMessages;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Validator;

class ContactInquiryRequest extends FormRequest
{
    use HasFriendlyValidationMessages;

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:160'],
            'email' => ['required', 'email', 'max:160'],
            'phone' => ['nullable', 'string', 'max:40'],
            'subject' => ['nullable', 'string', 'max:255'],
            'message' => ['required', 'string', 'max:5000'],
            'captcha_answer' => ['required', 'integer'],
            'website' => ['nullable', 'size:0'],
        ];
    }

    public function after(): array
    {
        return [
            function (Validator $validator): void {
                $expected = $this->session()->get('contact_captcha_answer');

                if ($expected === null || (int) $this->input('captcha_answer') !== (int) $expected) {
                    $validator->errors()->add('captcha_answer', 'The captcha answer is incorrect. Please try again.');
                }
            },
        ];
    }

    public function messages(): array
    {
        return $this->friendlyValidationMessages([
            'website.size' => 'Unable to submit the form. Please refresh the page and try again.',
            'captcha_answer.required' => 'Please solve the captcha before sending the inquiry.',
            'captcha_answer.integer' => 'Please enter the captcha answer as a number.',
        ]);
    }
}
