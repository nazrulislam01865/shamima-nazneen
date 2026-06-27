# Shamima Nazneen — Dynamic Laravel Website

A complete Laravel conversion of the supplied biography, works, image gallery, and video gallery templates. The public design follows the supplied prototypes, while all editable content is managed through a secure administration panel.

## Included features

### Public website

- Responsive home page based on the supplied design
- Dynamic hero image slider
- Biography page with ordered chapters and year/period labels
- Selected Works category cards that open the filtered works archive
- Complete works archive with category, year, search, and sort controls
- Real production/release year shown for every work instead of `To Be Added`
- Accessible **View Details** popup with:
  - Work name
  - Year and category
  - Credit, role, and platform
  - Rich-text short description
  - Optional custom link name and URL
- Combined image and video gallery
- Image lightbox
- Privacy-enhanced embedded YouTube players
- Direct links from video cards to the original YouTube video
- Dynamic events, audience quotes, public profile links, footer, and contact form
- Dynamic logo, favicon, SEO title, and SEO description

### Central Gallery / Media Library

- Images uploaded in any supported admin section are automatically saved as reusable media-library records.
- Existing section upload controls remain available, and each section can also select an image already stored in the library.
- Valid YouTube video links entered in works, selected-work cards, events, page buttons, menus, and profile settings are captured in the media library.
- A library item can be placed on the public Gallery, homepage image/video section, Biography gallery, and Profiles & Media cards independently.
- Per-item and global missing-image text replaces broken image icons.

### Administration panel

Admin URL: `/admin/login`

The administrator can manage:

- Website name, tagline, logo, favicon, contact information, social/profile links, footer, and SEO
- Every public page section, including heading, description, image, button, visibility, and drag-and-drop sequence
- Hero slides
- Biography chapters and year labels
- Work categories and home-page category cards
- Works, years, rich-text popup descriptions, images, external links, featured state, and home visibility
- Image gallery uploads
- YouTube video gallery entries
- Independent **Show on home page** setting for every image and video
- Audience quotes
- Events and appearances
- Contact inquiries and inquiry status
- Administrator name, email, and password

## Technical approach

- Laravel 13 structure
- PHP 8.3 or newer
- MySQL/MariaDB
- Reusable Blade layouts, partials, and admin form components
- Form Request validation
- Middleware-protected admin routes
- Hashed administrator passwords
- Sanitized rich-text HTML
- Safe internal/external URL validation
- Storage-disk based uploads
- Responsive, accessible popup, navigation, filters, forms, and mouse/keyboard sorting controls
- Plain compiled CSS and JavaScript in `public/assets`, so deployment does not require a server-side Node build

## Local installation

### 1. Create the database

```sql
CREATE DATABASE shamima_nazneen CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
```

### 2. Install PHP dependencies

```bash
composer install
```

Required PHP extensions include:

```text
ctype, curl, dom, fileinfo, filter, hash, mbstring, openssl,
pdo, pdo_mysql, session, tokenizer, xml
```

### 3. Configure the environment

```bash
cp .env.example .env
php artisan key:generate
```

Update these values in `.env`:

```dotenv
APP_URL=http://127.0.0.1:8000

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=shamima_nazneen
DB_USERNAME=root
DB_PASSWORD=

ADMIN_NAME="Website Administrator"
ADMIN_EMAIL=admin@example.com
ADMIN_PASSWORD=Admin@12345
```

Use a strong administrator password before seeding a production database.

### 4. Create tables and sample content

```bash
php artisan migrate --seed
```

The seeder installs the supplied template content, example works, gallery entries, and the administrator account configured in `.env`.

### 5. Link uploaded files

```bash
php artisan storage:link
```

### 6. Start the application

```bash
php artisan serve
```

Open:

```text
Public website: http://127.0.0.1:8000
Admin login:    http://127.0.0.1:8000/admin/login
```

Default example credentials from `.env.example`:

```text
Email:    admin@example.com
Password: Admin@12345
```

After signing in, open **Administrator Account** and change the login credentials.

## Production deployment

The public web root must point to the Laravel `public` directory.

```bash
cd /var/www/shamima-nazneen

php artisan down

git pull --ff-only origin main
composer install --no-dev --prefer-dist --optimize-autoloader

php artisan migrate --force
php artisan storage:link

sudo chown -R www-data:www-data storage bootstrap/cache
sudo chmod -R 775 storage bootstrap/cache

php artisan optimize:clear
php artisan config:cache
php artisan route:cache
php artisan view:cache

sudo systemctl restart php8.4-fpm
sudo nginx -t
sudo systemctl reload nginx

php artisan up
```

No `npm install` or `npm run build` is required for the included frontend because the website and admin assets are already available under `public/assets`.

## Upload directories

Uploaded files are stored through Laravel's public disk:

```text
storage/app/public/site
storage/app/public/hero
storage/app/public/sections
storage/app/public/biography
storage/app/public/work-categories
storage/app/public/works
storage/app/public/media
storage/app/public/events
```

The `php artisan storage:link` command exposes them at `public/storage`.

## Content workflow

### Add a work

1. Open **Admin → Works → Add Work**.
2. Select its category.
3. Enter the work name and four-digit year.
4. Enter the rich-text short description.
5. Add an image when available.
6. Optionally enter a custom link name and URL.
7. Enable **Show on home page** when it should appear in the matching home section.
8. Save.

Visitors can then click **View Details** to see the popup.

### Add a gallery image

1. Open **Admin → Image & Video Gallery → Add Gallery Item**.
2. Choose **Image gallery item**.
3. Upload the image and add its title, category, year, and description.
4. Enable **Show on home page** when required.
5. Save.

### Add a YouTube video

1. Open **Admin → Image & Video Gallery → Add Gallery Item**.
2. Choose **YouTube video**.
3. Paste the YouTube URL.
4. Add its title, category, year, and description.
5. Enable **Show on home page** when required.
6. Save.

The public site generates the embedded player and original YouTube watch link automatically.

## Drag-and-drop sequencing

Numeric display-order fields are intentionally hidden from the administrator. On sortable admin lists, use the **Move** handle to drag an item up or down. The sequence saves automatically and is used by the public website. The same handle supports the keyboard Up and Down arrow keys.

All text, number, URL, select, rich-text, image upload, password, and search controls include visible examples or instructional placeholders so administrators can understand what to enter.

## Automated checks

After installing dependencies:

```bash
php artisan test
```

The project includes tests for admin access, YouTube URL handling, and rich-text sanitization.

## Page-based admin navigation

The administration sidebar is arranged by public page so editors can work on one page at a time:

- **Home Page**
  - Page Overview
  - Hero Slider
  - Page Content
  - Homepage Works
  - Homepage Videos
  - Homepage Images
  - Audience Quotes
  - Events & Appearances
  - Contact Messages
- **Biography Page**
  - Page Overview
  - Page Content
  - Biography Sections
- **Works Page**
  - Page Overview
  - Page Content
  - Work Categories
  - Works & Filmography
- **Gallery Page**
  - Page Overview
  - Page Content
  - Image Gallery
  - Video Gallery
  - All Gallery Media
- **General Settings**
  - Site Identity & SEO
  - Administrator Account

Each page overview displays the related content controls and current record counts. Homepage-only work and media lists retain their filter while creating, editing, saving, or cancelling an item.

## Custom pages and reviewed homepage behaviour

The admin panel now includes **Website Pages → Custom Pages**. An administrator can create a page with a page name and rich-text editor, upload images directly into the page content, choose header-menu and footer-menu visibility, publish/unpublish the page, and drag pages into the required menu sequence.

Homepage behaviour follows the reviewed requirements:

- Homepage images come only from active Image Gallery records with **Show on landing/home page** enabled.
- Homepage videos come only from active Video Gallery records with **Show on landing/home page** enabled.
- Selected Works cards use the category image, title, short description, link label, and optional forward link managed by the administrator. Leaving the forward link empty automatically opens the Works page filtered to that category.
- The Filmography button opens the filtered Films archive.
- Media/profile cards are fully clickable and accept internal paths or external URLs.
- Audience quotes display as an accessible automatic slider with manual previous, next, and dot controls.
- Event cards can open a selected filtered Works category or a custom internal/external link.

After replacing an older project version, run:

```bash
php artisan migrate
php artisan optimize:clear
php artisan storage:link
```
