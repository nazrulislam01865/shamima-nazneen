<?php

namespace App\Http\Requests;

use App\Rules\SafeUrl;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class SiteSettingRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()?->is_admin === true;
    }

    protected function prepareForValidation(): void
    {
        $profileCardLinks = collect($this->input('profile_card_links', []))
            ->map(fn ($link): array => [
                'title' => trim((string) ($link['title'] ?? '')),
                'url' => trim((string) ($link['url'] ?? '')),
                'description' => trim((string) ($link['description'] ?? '')),
            ])
            ->filter(fn (array $link): bool => $link['title'] !== '' || $link['url'] !== '' || $link['description'] !== '')
            ->values()
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
            'profile_card_links.*.title' => ['nullable', 'required_with:profile_card_links.*.url,profile_card_links.*.description', 'string', 'max:120'],
            'profile_card_links.*.url' => ['nullable', 'required_with:profile_card_links.*.title,profile_card_links.*.description', 'string', 'max:500', new SafeUrl],
            'profile_card_links.*.description' => ['nullable', 'string', 'max:500'],
        ];
    }
}
