# Update: Separate Image and Video Gallery + 16:9 Cards

## What changed

1. Image Gallery and Video Gallery are now separated in the admin panel.
2. The admin Gallery page no longer shows images and videos together by default.
3. Image-selection fields now show only Image Gallery items.
4. Video Gallery manages only YouTube video items.
5. Public `/gallery` now shows image items only.
6. Public `/videos` now shows video items only.
7. Gallery thumbnails/cards/previews are forced to a 16:9 landscape ratio.
8. Visible slug/URL-name fields were removed from these admin forms:
   - Work Categories
   - Works & Filmography
   - Biography Sections
   - Custom Pages
9. Slugs are still generated/preserved automatically in the backend, so no database change is required.
10. User-facing validation messages for media/gallery actions were improved.

## No migration required

This update only changes controllers, views, support classes, JavaScript, and CSS.

## After upload

Run:

```bash
php artisan optimize:clear
```

If you see `View path not found`, run:

```bash
mkdir -p storage/framework/views storage/framework/cache storage/framework/sessions bootstrap/cache
php artisan optimize:clear
```
