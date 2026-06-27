<?php

namespace App\Support;

use Illuminate\Http\Request;
use Illuminate\Support\Arr;

final class AdminPageRegistry
{
    /**
     * @return array<string, array<string, mixed>>
     */
    public static function all(): array
    {
        return [
            'home' => [
                'label' => 'Home Page',
                'short_label' => 'Home',
                'icon' => 'home',
                'description' => 'Manage the homepage slider, section content, featured works, galleries, audience quotes, events, and contact messages. Profile and media card links are managed under Site Identity & SEO.',
                'public_route' => 'home',
                'modules' => [
                    self::module('overview', 'Page Overview', 'A page-by-page control centre for the homepage.', 'grid', 'admin.pages.show', ['page' => 'home'], 'admin.pages.show', routeParams: ['page' => 'home']),
                    self::module('slider', 'Hero Slider', 'Manage the first section visitors see on the homepage.', 'image', 'admin.hero-slides.index', [], 'admin.hero-slides.*'),
                    self::module('content', 'Page Content', 'Edit homepage headings, descriptions, buttons, images, and section visibility.', 'layout', 'admin.content-sections.index', ['page' => 'home'], 'admin.content-sections.*', context: ['page' => 'home']),
                    self::module('featured-works', 'Homepage Works', 'Manage works shown after the introductory homepage sections.', 'film', 'admin.works.index', ['home' => 1], 'admin.works.*', query: ['home' => '1']),
                    self::module('home-videos', 'Homepage Videos', 'Manage the homepage video gallery shown before the image gallery.', 'video', 'admin.media-items.index', ['type' => 'video', 'home' => 1], 'admin.media-items.*', query: ['type' => 'video', 'home' => '1']),
                    self::module('home-images', 'Homepage Images', 'Manage the homepage image gallery shown after the videos.', 'gallery', 'admin.media-items.index', ['type' => 'image', 'home' => 1], 'admin.media-items.*', query: ['type' => 'image', 'home' => '1']),
                    self::module('testimonials', 'Audience Quotes', 'Add, edit, rearrange, or hide audience appreciation quotes.', 'quote', 'admin.testimonials.index', [], 'admin.testimonials.*'),
                    self::module('events', 'Events & Appearances', 'Manage event cards and decide which ones appear on the homepage.', 'calendar', 'admin.events.index', [], 'admin.events.*'),
                    self::module('inquiries', 'Contact Messages', 'Review booking, media, collaboration, and professional inquiries.', 'mail', 'admin.inquiries.index', [], 'admin.inquiries.*'),
                ],
            ],
            'biography' => [
                'label' => 'Biography Page',
                'short_label' => 'Biography',
                'icon' => 'book',
                'description' => 'Manage the biography hero, page introduction, timeline sections, and biography gallery heading.',
                'public_route' => 'biography.index',
                'modules' => [
                    self::module('overview', 'Page Overview', 'A focused control centre for the biography page.', 'grid', 'admin.pages.show', ['page' => 'biography'], 'admin.pages.show', routeParams: ['page' => 'biography']),
                    self::module('content', 'Page Content', 'Edit the biography hero and gallery section content.', 'layout', 'admin.content-sections.index', ['page' => 'biography'], 'admin.content-sections.*', context: ['page' => 'biography']),
                    self::module('timeline', 'Biography Sections', 'Manage the chronological biography story, images, labels, and visibility.', 'book', 'admin.biography-sections.index', [], 'admin.biography-sections.*'),
                ],
            ],
            'works' => [
                'label' => 'Works Page',
                'short_label' => 'Works',
                'icon' => 'film',
                'description' => 'Manage the works archive page, categories, years, details popup content, images, and links.',
                'public_route' => 'works.index',
                'modules' => [
                    self::module('overview', 'Page Overview', 'A focused control centre for the works archive.', 'grid', 'admin.pages.show', ['page' => 'works'], 'admin.pages.show', routeParams: ['page' => 'works']),
                    self::module('content', 'Page Content', 'Edit the works page hero and professional contact section.', 'layout', 'admin.content-sections.index', ['page' => 'works'], 'admin.content-sections.*', context: ['page' => 'works']),
                    self::module('categories', 'Work Categories', 'These categories create the Television, Films, Theatre, Digital, Direction, and other sections shown on the public Works page.', 'folder', 'admin.work-categories.index', [], 'admin.work-categories.*'),
                    self::module('archive', 'Works & Filmography', 'Add and edit works, years, descriptions, images, credits, and links.', 'film', 'admin.works.index', [], 'admin.works.*', queryAbsent: ['home']),
                ],
            ],
            'gallery' => [
                'label' => 'Gallery Page',
                'short_label' => 'Gallery',
                'icon' => 'gallery',
                'description' => 'Manage the gallery page heading, uploaded images, embedded YouTube videos, categories, and featured media.',
                'public_route' => 'gallery.index',
                'modules' => [
                    self::module('overview', 'Page Overview', 'A focused control centre for image and video galleries.', 'grid', 'admin.pages.show', ['page' => 'gallery'], 'admin.pages.show', routeParams: ['page' => 'gallery']),
                    self::module('content', 'Page Content', 'Edit the gallery page hero heading and introductory text.', 'layout', 'admin.content-sections.index', ['page' => 'gallery'], 'admin.content-sections.*', context: ['page' => 'gallery']),
                    self::module('images', 'Image Gallery', 'Manage the image collection shown first on the gallery page.', 'image', 'admin.gallery-media.images', [], 'admin.gallery-media.images'),
                    self::module('videos', 'Video Gallery', 'Manage the YouTube video collection shown after the images.', 'video', 'admin.gallery-media.videos', [], 'admin.gallery-media.videos'),
                    self::module('media', 'All Gallery Media', 'View images and videos together in one management list.', 'gallery', 'admin.media-items.index', [], 'admin.media-items.index', queryAbsent: ['type', 'home']),
                ],
            ],
        ];
    }

    /**
     * @return array<string, mixed>|null
     */
    public static function find(string $page): ?array
    {
        return self::all()[$page] ?? null;
    }

    /**
     * @param array<string, mixed> $module
     */
    public static function isModuleActive(array $module, ?Request $request = null): bool
    {
        $request ??= request();

        if (! $request->routeIs((string) $module['match'])) {
            return false;
        }

        foreach ($module['route_params'] ?? [] as $key => $expected) {
            if ((string) $request->route($key) !== (string) $expected) {
                return false;
            }
        }

        foreach ($module['query'] ?? [] as $key => $expected) {
            if ((string) $request->query($key) !== (string) $expected) {
                return false;
            }
        }

        foreach ($module['query_absent'] ?? [] as $key) {
            if ($request->query->has($key)) {
                return false;
            }
        }

        foreach ($module['context'] ?? [] as $key => $expected) {
            if ((string) self::resolveContext($request, (string) $key) !== (string) $expected) {
                return false;
            }
        }

        return true;
    }

    /**
     * @param array<string, mixed> $page
     */
    public static function isPageActive(array $page, ?Request $request = null): bool
    {
        foreach ($page['modules'] as $module) {
            if (self::isModuleActive($module, $request)) {
                return true;
            }
        }

        return false;
    }

    /**
     * @return array<string, mixed>
     */
    private static function module(
        string $key,
        string $label,
        string $description,
        string $icon,
        string $route,
        array $params,
        string $match,
        array $query = [],
        array $context = [],
        array $routeParams = [],
        array $queryAbsent = [],
    ): array {
        return [
            'key' => $key,
            'label' => $label,
            'description' => $description,
            'icon' => $icon,
            'route' => $route,
            'params' => $params,
            'match' => $match,
            'query' => $query,
            'context' => $context,
            'route_params' => $routeParams,
            'query_absent' => $queryAbsent,
        ];
    }

    private static function resolveContext(Request $request, string $key): mixed
    {
        if ($request->query->has($key)) {
            return $request->query($key);
        }

        $contentSection = $request->route('contentSection');
        $mediaItem = $request->route('mediaItem') ?? $request->route('media_item');

        return match ($key) {
            'page' => is_object($contentSection) ? ($contentSection->page ?? null) : null,
            'type' => is_object($mediaItem) ? ($mediaItem->type ?? null) : null,
            default => Arr::get($request->route()?->parameters() ?? [], $key),
        };
    }
}
