# Social Follow Sync Update

Updated the home slider follow bar, mobile menu follow area, and footer social links to read from the same `profile_card_links` data used by the home page "Profiles, interviews, and public features" section.

## Updated files

- `resources/views/frontend/home.blade.php`
- `resources/views/frontend/partials/social-links.blade.php`
- `resources/views/frontend/partials/header.blade.php`
- `resources/views/frontend/partials/footer.blade.php`

## Result

Any link added from admin under **Site Identity & SEO → Profiles and media card links** now appears in:

1. Slider follow section
2. Mobile navigation follow section
3. Footer social links
4. Profiles, interviews, and public features section

The previous uploaded-logo behavior is preserved: when a logo is uploaded, it replaces the full logo section instead of only replacing the round icon.

No migration is needed.

After upload, clear compiled Blade views if cPanel still shows the old version:

`storage/framework/views/`
