# Update: Gallery UI, Admin Work Category Links, Sidebar Stability

## Changed files

- `resources/views/frontend/gallery.blade.php`
- `resources/views/admin/work-categories/_form.blade.php`
- `app/Http/Controllers/Admin/WorkCategoryController.php`
- `app/Http/Requests/WorkCategoryRequest.php`
- `app/Models/WorkCategory.php`
- `public/assets/css/site-overrides.css`
- `public/assets/css/admin.css`
- `public/assets/js/admin.js`

## What changed

1. Public Gallery page cards are now clean, same-size, landscape 16:9 cards.
2. Public Videos page cards now use the same landscape 16:9 video thumbnail ratio.
3. Homepage image/video gallery cards are also forced to a consistent 16:9 ratio.
4. Gallery page layout was simplified from uneven masonry cards to a more user-friendly responsive card grid.
5. Desktop menu spacing was increased so the menu looks cleaner and less cramped.
6. Work Category admin form no longer shows the unnecessary Card links section.
7. Home work category cards now automatically link to the filtered Works page for that category.
8. Admin sidebar scroll position is preserved between page changes to reduce sidebar flashing/jumping.
9. Admin media previews and gallery picker cards remain 16:9.

## No migration needed

This update only changes Blade, CSS, JS, and request/controller/model behavior. No database migration is required.
