<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Concerns\HandlesUploads;
use App\Http\Controllers\Concerns\UsesMediaLibrary;
use App\Http\Controllers\Controller;
use App\Http\Requests\SiteSettingRequest;
use App\Models\SiteSetting;
use App\Support\MediaLibrary;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class SiteSettingsController extends Controller
{
    use HandlesUploads;
    use UsesMediaLibrary;

    public function edit(): View
    {
        return view('admin.settings.edit', ['settings' => SiteSetting::current()]);
    }

    public function update(SiteSettingRequest $request): RedirectResponse
    {
        $settings = SiteSetting::current();
        $data = $request->safe()->except([
            'logo', 'favicon', 'remove_logo', 'remove_favicon', 'logo_media_id', 'favicon_media_id',
        ]);

        $data['logo_path'] = $this->resolveLibraryImage(
            $request, 'logo', 'remove_logo', 'logo_media_id', 'site', $settings->logo_path,
            $request->input('site_name').' logo', 'Brand Identity', 'Website logo is not available.'
        );
        $data['favicon_path'] = $this->resolveLibraryImage(
            $request, 'favicon', 'remove_favicon', 'favicon_media_id', 'site', $settings->favicon_path,
            $request->input('site_name').' favicon', 'Brand Identity', 'Website icon is not available.'
        );
        $data['profile_card_links'] = collect($request->input('profile_card_links', []))
            ->map(fn (array $link): array => [
                'title' => trim((string) ($link['title'] ?? '')),
                'url' => trim((string) ($link['url'] ?? '')),
                'description' => trim((string) ($link['description'] ?? '')),
            ])
            ->values()
            ->all();

        $settings->update($data);

        foreach ($data['profile_card_links'] as $profileLink) {
            MediaLibrary::registerVideo(
                $profileLink['url'] ?? null,
                $profileLink['title'] ?: 'Profile video',
                'Profiles & Media',
                $profileLink['description'] ?: null,
            );
        }

        return back()->with('success', 'Site settings updated successfully.');
    }
}
