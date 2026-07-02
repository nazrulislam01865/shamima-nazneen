# Production Year Optional Update

This update makes the work production/release year optional across the admin and frontend.

## Changes

- `Works & Filmography` production year is no longer required in validation.
- The admin work form no longer marks `Release / production year` as required.
- Added a migration to make `works.year` nullable for existing live databases.
- Updated the original works table migration so new installations also use nullable year.
- Frontend Works page no longer breaks when a work has no year.
- Year/decade filters now ignore missing years safely.
- Featured work cards only show the year badge when a year exists.
- Home film cards only show the year badge when a year exists.
- Admin list/dashboard now show a clean dash or fallback when year is not provided.
- Sorting keeps works with missing years at the bottom for latest/oldest sorting.

## Deployment

After uploading/pulling the update, run:

```bash
php artisan migrate --force
php artisan optimize:clear
php artisan optimize
```

If you see `View path not found`, create the Laravel cache folders first:

```bash
mkdir -p storage/framework/views storage/framework/cache storage/framework/sessions storage/logs bootstrap/cache
php artisan optimize:clear
```
