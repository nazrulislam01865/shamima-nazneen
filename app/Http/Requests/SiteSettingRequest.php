<?php

namespace App\Http\Requests;

use App\Http\Requests\Concerns\HasFriendlyValidationMessages;
use App\Rules\SafeUrl;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\UploadedFile;
use Illuminate\Validation\Rule;

class SiteSettingRequest extends FormRequest
{
    use HasFriendlyValidationMessages;

    public function authorize(): bool
    {
        return $this->user()?->is_admin === true;
    }

    protected function prepareForValidation(): void
    {
        $uploadedProfileIcons = $this->file('profile_card_links', []);

        $profileCardLinks = collect($this->input('profile_card_links', []))
            ->map(function ($link, $index) use ($uploadedProfileIcons): array {
                $hasUploadedIcon = data_get($uploadedProfileIcons, $index.'.icon') instanceof UploadedFile;

                return [
                    'title' => trim((string) ($link['title'] ?? '')),
                    'url' => trim((string) ($link['url'] ?? '')),
                    'description' => trim((string) ($link['description'] ?? '')),
                    'current_icon_path' => trim((string) ($link['current_icon_path'] ?? '')),
                    'remove_icon' => filter_var($link['remove_icon'] ?? false, FILTER_VALIDATE_BOOLEAN),
                    '_has_uploaded_icon' => $hasUploadedIcon,
                ];
            })
            ->filter(fn (array $link): bool => $link['title'] !== ''
                || $link['url'] !== ''
                || $link['description'] !== ''
                || $link['_has_uploaded_icon'] === true)
            ->map(function (array $link): array {
                unset($link['_has_uploaded_icon']);

                return $link;
            })
            ->all();

        $this->merge(['profile_card_links' => $profileCardLinks]);
    }

    public function rules(): array
    {
        return [
            'site_name' => ['required', 'string', 'max:120'],
            'tagline' => ['nullable', 'string', 'max:255'],
            'logo_media_id' => ['nullable', Rule::exists('media_items', 'id')->where(fn ($query) => $query->where('type', 'image'))],
            'favicon_media_id' => ['nullable', Rule::exists('media_items', 'id')->where(fn ($query) => $query->where('type', 'image'))],
            'logo' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:4096'],
            'favicon' => ['nullable', 'file', 'mimes:png,ico,jpg,jpeg,webp', 'max:2048'],
            'remove_logo' => ['nullable', 'boolean'],
            'remove_favicon' => ['nullable', 'boolean'],
            'email' => ['nullable', 'email', 'max:160'],
            'phone' => ['nullable', 'string', 'max:40'],
            'address' => ['nullable', 'string', 'max:1000'],
            'media_inquiry_label' => ['required', 'string', 'max:80'],
            'footer_text' => ['nullable', 'string', 'max:1000'],
            'image_fallback_text' => ['required', 'string', 'max:255'],
            'seo_title' => ['nullable', 'string', 'max:255'],
            'seo_description' => ['nullable', 'string', 'max:500'],
            'profile_card_links' => ['nullable', 'array', 'max:30'],
            'profile_card_links.*.title' => ['nullable', 'required_with:profile_card_links.*.url,profile_card_links.*.description,profile_card_links.*.icon', 'string', 'max:120'],
            'profile_card_links.*.url' => ['nullable', 'required_with:profile_card_links.*.title,profile_card_links.*.description,profile_card_links.*.icon', 'string', 'max:500', new SafeUrl],
            'profile_card_links.*.description' => ['nullable', 'string', 'max:500'],
            'profile_card_links.*.current_icon_path' => ['nullable', 'string', 'max:500'],
            'profile_card_links.*.remove_icon' => ['nullable', 'boolean'],
            'profile_card_links.*.icon' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
        ];
    }

    public function messages(): array
    {
        return $this->friendlyValidationMessages([
            'site_name.required' => 'Enter the website name.',
            'site_name.max' => 'The website name must be 120 characters or fewer.',
            'tagline.max' => 'The tagline must be 255 characters or fewer.',
            'logo_media_id.exists' => 'Choose a valid logo image from the media library.',
            'favicon_media_id.exists' => 'Choose a valid favicon image from the media library.',
            'logo.image' => 'Upload a valid logo image.',
            'logo.mimes' => 'The logo must be a JPG, PNG, or WEBP image.',
            'logo.max' => 'The logo image must be 4 MB or smaller.',
            'favicon.file' => 'Upload a valid favicon file.',
            'favicon.mimes' => 'The favicon must be PNG, ICO, JPG, or WEBP.',
            'favicon.max' => 'The favicon must be 2 MB or smaller.',
            'email.email' => 'Enter a valid email address.',
            'email.max' => 'The email address must be 160 characters or fewer.',
            'phone.max' => 'The phone number must be 40 characters or fewer.',
            'address.max' => 'The address must be 1000 characters or fewer.',
            'media_inquiry_label.required' => 'Enter the media inquiry button label.',
            'media_inquiry_label.max' => 'The media inquiry label must be 80 characters or fewer.',
            'footer_text.max' => 'The footer description must be 1000 characters or fewer.',
            'image_fallback_text.required' => 'Enter the missing image message.',
            'image_fallback_text.max' => 'The missing image message must be 255 characters or fewer.',
            'seo_title.max' => 'The SEO title must be 255 characters or fewer.',
            'seo_description.max' => 'The SEO description must be 500 characters or fewer.',
            'profile_card_links.array' => 'Please check the profile/media links and try again.',
            'profile_card_links.max' => 'You can add up to 30 profile/media links.',
            'profile_card_links.*.title.required_with' => 'Enter a card name for each profile/media link.',
            'profile_card_links.*.title.max' => 'Each profile/media card name must be 120 characters or fewer.',
            'profile_card_links.*.url.required_with' => 'Enter a URL for each profile/media link.',
            'profile_card_links.*.url.max' => 'Each profile/media URL must be 500 characters or fewer.',
            'profile_card_links.*.description.max' => 'Each profile/media description must be 500 characters or fewer.',
            'profile_card_links.*.current_icon_path.max' => 'Please choose the profile/media logo again.',
            'profile_card_links.*.icon.image' => 'Each profile/media logo must be a valid image.',
            'profile_card_links.*.icon.mimes' => 'Each profile/media logo must be JPG, PNG, or WEBP.',
            'profile_card_links.*.icon.max' => 'Each profile/media logo must be 2 MB or smaller.',
        ]);
    }

    public function attributes(): array
    {
        return $this->friendlyValidationAttributes([
            'site_name' => 'website name',
            'tagline' => 'tagline',
            'logo' => 'logo',
            'favicon' => 'favicon',
            'email' => 'email address',
            'phone' => 'phone number',
            'address' => 'address',
            'media_inquiry_label' => 'media inquiry label',
            'footer_text' => 'footer description',
            'image_fallback_text' => 'missing image message',
            'seo_title' => 'SEO title',
            'seo_description' => 'SEO description',
            'profile_card_links.*.title' => 'profile/media card name',
            'profile_card_links.*.url' => 'profile/media link URL',
            'profile_card_links.*.description' => 'profile/media card description',
            'profile_card_links.*.icon' => 'profile/media logo',
        ]);
    }
}
