# User-friendly validation and error-field focus update

## What changed

- Added clean, user-facing validation messages across admin and contact forms.
- Added a clickable error summary at the top of admin/public forms.
- Automatically scrolls to the first field with an error after validation fails.
- Clicking an error summary item takes the user directly to the related field.
- Fields with errors are highlighted with a clear red border/background.
- The related input/select/textarea/rich text editor receives `aria-invalid` and `aria-describedby` for accessibility.
- Frontend contact form now shows each field error beside the exact field.
- Admin login now also scrolls/focuses the wrong field after error.
- Browser-side required/email/number errors now show friendly inline messages instead of only the browser popup.
- Technical/logical validation text was replaced with clear instructions such as “Choose a valid work category” or “Upload a valid image.”

## Main files updated

- `app/Http/Requests/Concerns/HasFriendlyValidationMessages.php`
- All files in `app/Http/Requests/*.php`
- `app/Http/Controllers/Admin/AuthController.php`
- `app/Http/Controllers/Admin/ContactInquiryController.php`
- `app/Http/Controllers/Admin/EditorImageController.php`
- `resources/views/layouts/admin.blade.php`
- `resources/views/layouts/frontend.blade.php`
- `resources/views/admin/auth/login.blade.php`
- `resources/views/frontend/home-sections/contact.blade.php`
- `resources/views/components/admin/input.blade.php`
- `resources/views/components/admin/select.blade.php`
- `resources/views/components/admin/textarea.blade.php`
- `resources/views/components/admin/checkbox.blade.php`
- `resources/views/components/admin/image-upload.blade.php`
- `resources/views/components/admin/rich-text.blade.php`
- `resources/views/components/admin/media-library-select.blade.php`
- `resources/views/admin/settings/edit.blade.php`
- `resources/views/admin/work-categories/_form.blade.php`
- `resources/views/admin/works/_form.blade.php`
- `public/assets/js/admin.js`
- `public/assets/js/site.js`
- `public/assets/css/admin.css`
- `public/assets/css/site-overrides.css`

## Deployment note

No migration is required. After uploading, clear caches:

```bash
php artisan optimize:clear
```

If `optimize:clear` says `View path not found`, create the missing folder first:

```bash
mkdir -p storage/framework/views storage/framework/cache storage/framework/sessions bootstrap/cache
php artisan optimize:clear
```
