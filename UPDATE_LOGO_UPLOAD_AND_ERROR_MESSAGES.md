# Update notes

## Changed

- Added a custom logo image upload for every item in **Site Identity & SEO → Profiles and media card links**.
- If a profile/media link has a custom uploaded logo, that image is shown in:
  - homepage slider follow section
  - mobile menu follow section
  - footer social links
  - homepage Profiles, interviews, and public features section
- If no custom logo is uploaded for a profile/media link, the existing automatic logo/letter style remains.
- Added friendly validation messages for Site Identity & SEO fields, including social/profile link URLs and icon images.
- Replaced technical SafeUrl validation wording with user-friendly wording.
- Added friendly public error pages for common errors: 401, 403, 404, 419, 429, 500, and 503.
- Wrapped Site Settings save in a safe failure handler so technical save errors are not shown directly to the user.

## No migration required

The custom link logo path is stored inside the existing `profile_card_links` JSON field.

## After upload

If the live site still shows old markup or CSS, clear compiled Blade views by deleting files inside:

```text
storage/framework/views/
```

Then hard refresh the browser.
