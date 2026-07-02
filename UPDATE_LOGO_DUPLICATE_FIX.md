# Logo duplicate display fix

Updated behavior:

- When a website logo is uploaded, the public header shows only one logo.
- The duplicate logo that appeared before the first menu item was caused by the hidden mobile menu brand being forced visible by the shared `.brand-logo-only` CSS class.
- The mobile menu brand is now kept hidden and no longer receives the uploaded logo.
- In the admin sidebar, when a logo is uploaded, the sidebar brand now shows only that uploaded logo image.
- If no logo is uploaded, the existing automatic `SN` logo and site name remain unchanged.

Updated files:

- resources/views/frontend/partials/header.blade.php
- resources/views/layouts/admin.blade.php
- public/assets/css/site-overrides.css
- public/assets/css/admin.css

No migration is required.

After uploading to cPanel, hard refresh the browser. If the old logo still appears, delete compiled Blade files from:

storage/framework/views/
