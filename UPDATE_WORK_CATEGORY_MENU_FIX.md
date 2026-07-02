# Update: Frontend Menu Text Only + Work Category Image Removal Fix

## Updated behavior

1. Public header menu no longer renders menu icons on desktop or mobile.
2. Work Category edit/create no longer requires a home card image when the category is shown on the home page.
3. Removing a Work Category home card image is now allowed.
4. Home-page work cards show a clean fallback message when an image is not available instead of showing a broken image.
5. Old incomplete work category card links such as a label without a URL are no longer forced back into the edit form.
6. If an admin manually enters only a link label or only a link URL, the error message explains what to fix in user-friendly language.

## Updated files

- `resources/views/frontend/partials/header.blade.php`
- `resources/views/admin/work-categories/_form.blade.php`
- `app/Http/Requests/WorkCategoryRequest.php`
- `resources/views/frontend/home-sections/works.blade.php`
- `public/assets/css/site-overrides.css`

## Deployment note

After uploading the files, run:

```bash
php artisan optimize:clear
```

If Laravel says `View path not found`, first create the compiled view folder:

```bash
mkdir -p storage/framework/views storage/framework/cache storage/framework/sessions bootstrap/cache
php artisan optimize:clear
```
