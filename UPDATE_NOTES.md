# Central Gallery / Media Library update

## Completed

- Every new image uploaded from Hero Slider, Home Page Content, Biography, Work Categories, Works & Filmography, Events, logo/favicon settings, and rich-text editors is automatically registered in **Gallery / Media Library**.
- Existing images used by those sections are added to the media library during migration without changing their current frontend placements.
- Valid YouTube video links entered in works, selected-work cards, events, page buttons, menu items, and the YouTube profile setting are also registered in the central media library.
- Each media item can independently be enabled for:
  - Public Gallery page
  - Homepage image/video section
  - Homepage Profiles & Media cards
  - Biography gallery
  - Featured-card styling
- Existing image upload fields and all current section settings remain available. Administrators can either upload a new image or choose a reusable image from the central library.
- Profiles & Media cards now support an image/video, title, description, link name, and internal or external destination URL.
- A per-media missing-image message and a global fallback message are available. Broken image icons are hidden and replaced with the configured text.
- Reused media files are protected from deletion while another section still references them.

## Update an existing installation

```bash
php artisan migrate
php artisan optimize:clear
php artisan storage:link
php artisan serve
```

Do not run `php artisan migrate:fresh`; it deletes existing content.
## Site Identity & SEO navigation correction

- Removed **Profiles & Media Cards** from the **Home Page** admin submenu.
- Kept all profile/social destination fields inside **General Settings → Site Identity & SEO**.
- Added a contextual button in that settings section for managing gallery images or videos used as Profiles & Media cards.
- No database migration is required.


## Dynamic Profiles & Media links

- Replaced the fixed Facebook, YouTube, Chorki, IMDb, and Wikipedia card inputs with a repeatable list.
- Administrators can add or remove as many profile/media cards as needed.
- Each card now supports a card name, internal/external URL, and custom description.
- Removed the separate “Manage Profile Card Media” button and its explanatory block from Site Identity & SEO.
- Existing configured profile URLs are automatically migrated into the new repeatable list.
- Gallery-based profile cards remain supported from the Gallery / Media Library, preserving existing display settings.

## 2026-06-27 mobile follow layout + button loaders
- Improved the mobile/small-device Profile & Media follow card layout so links stack in a clean single column without cutting off the IMDb card.
- Added centered, consistent icon sizing inside the follow cards for Chorki, IMDb, YouTube and Wikipedia.
- Added universal frontend button/link loading state for form submit buttons and CTA-style links.
- Added universal admin panel loading state for submit buttons, delete buttons, filter buttons, logout, and admin action links.

## Latest fixes
- Replaced the Gallery / Media Library dropdown with a visual phone-gallery style image picker.
- Selecting a media image now immediately updates the selected preview in the admin form.
- Fixed the Gallery page 500 error caused by an undefined `$watchUrl` variable.
- Made work and film card images render as real `<img>` elements instead of only JavaScript-applied background images.
- Made the `/media/{path}` file route more tolerant of `storage/`, `public/`, and `app/public/` path prefixes and public storage fallback paths.
