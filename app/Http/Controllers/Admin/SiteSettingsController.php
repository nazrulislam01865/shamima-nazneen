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
use Throwable;

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
        try {
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
            $data['profile_card_links'] = $this->profileCardLinksWithUploadedIcons($request);

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
        } catch (Throwable $exception) {
            report($exception);

            return back()
                ->withInput()
                ->with('error', 'The site settings could not be saved. Please check the information and try again.');
        }
    }

    private function profileCardLinksWithUploadedIcons(SiteSettingRequest $request): array
    {
        return collect($request->input('profile_card_links', []))
            ->map(function (array $link, int $index) use ($request): array {
                $title = trim((string) ($link['title'] ?? ''));
                $currentIconPath = trim((string) ($link['current_icon_path'] ?? '')) ?: null;
                $iconPath = $currentIconPath;
                $iconField = "profile_card_links.$index.icon";

                if ($request->hasFile($iconField)) {
                    $iconPath = $this->storeUploadedFile($request->file($iconField), 'profile-icons', $currentIconPath);
                    MediaLibrary::registerImage(
                        $iconPath,
                        ($title ?: 'Profile or media link').' logo',
                        'Profiles & Media Logos',
                        'Profile logo is not available.',
                        $title ?: 'Profile logo'
                    );
                } elseif (filter_var($link['remove_icon'] ?? false, FILTER_VALIDATE_BOOLEAN)) {
                    $iconPath = $this->removeUploadedFileIfRequested(true, $currentIconPath);
                }

                return [
                    'title' => $title,
                    'url' => trim((string) ($link['url'] ?? '')),
                    'description' => trim((string) ($link['description'] ?? '')),
                    'icon_path' => $iconPath,
                ];
            })
            ->filter(fn (array $link): bool => $link['title'] !== '' && $link['url'] !== '')
            ->values()
            ->all();
    }
}
