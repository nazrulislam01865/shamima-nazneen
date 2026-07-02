# Mobile Follow Icon Round Border Update

Updated the mobile navigation Follow section so social/profile icons use the same round bordered dark-brown/gold style as the footer social icons.

## Updated file

- `public/assets/css/site-overrides.css`

## Behavior

- Mobile menu Follow icons now show inside round bordered circles.
- Uploaded custom profile logos also appear inside the round circle.
- Text labels remain beside the icon for easy readability.
- No database migration is required.

After uploading, clear cache if needed:

```bash
php artisan optimize:clear
```
