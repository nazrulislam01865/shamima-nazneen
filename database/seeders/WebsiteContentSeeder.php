<?php

namespace Database\Seeders;

use App\Models\BiographySection;
use App\Models\ContentSection;
use App\Models\Event;
use App\Models\HeroSlide;
use App\Models\MediaItem;
use App\Models\SiteSetting;
use App\Models\Testimonial;
use App\Models\Work;
use App\Models\WorkCategory;
use Illuminate\Database\Seeder;

class WebsiteContentSeeder extends Seeder
{
    public function run(): void
    {
        SiteSetting::query()->updateOrCreate(
            ['id' => 1],
            [
                'site_name' => 'Shamima Nazneen',
                'tagline' => 'Actress, director, and theatre personality',
                'email' => 'contact@example.com',
                'media_inquiry_label' => 'Media Inquiry',
                'footer_text' => 'Official website archive for biography, selected works, media, and professional inquiries.',
                'seo_title' => 'Shamima Nazneen | Official Website',
                'seo_description' => 'Biography, selected works, filmography, image gallery, videos, and official contact information.',
                'social_links' => [
                    'facebook' => null,
                    'youtube' => null,
                    'chorki' => 'https://www.chorki.com/movie/casts/shamima-nazneen',
                    'imdb' => 'https://www.imdb.com/name/nm2069800/',
                    'wikipedia' => 'https://en.wikipedia.org/wiki/Shamima_Nazneen',
                ],
                'profile_card_links' => [
                    [
                        'title' => 'Wikipedia Profile',
                        'url' => 'https://en.wikipedia.org/wiki/Shamima_Nazneen',
                        'description' => 'Open the public Wikipedia profile and biography reference.',
                    ],
                    [
                        'title' => 'IMDb Profile',
                        'url' => 'https://www.imdb.com/name/nm2069800/',
                        'description' => 'View screen credits and the public IMDb profile.',
                    ],
                    [
                        'title' => 'Chorki Cast Profile',
                        'url' => 'https://www.chorki.com/movie/casts/shamima-nazneen',
                        'description' => 'Explore the public Chorki cast and platform profile.',
                    ],
                ],
            ]
        );

        $this->seedContentSections();
        $this->seedHeroSlides();
        $this->seedBiography();
        $categories = $this->seedWorkCategories();
        $this->seedWorks($categories);
        $this->seedMedia();
        $this->seedTestimonials();
        $this->seedEvents($categories);
    }

    private function seedContentSections(): void
    {
        $sections = [
            ['page' => 'home', 'section_key' => 'about', 'eyebrow' => 'About Shamima Nazneen', 'title' => 'A familiar face of Bangladeshi television, film, and theatre.', 'description' => '<p>Shamima Nazneen is a Bangladeshi actress, director, and theatre personality known for her work across television dramas, films, stage, and digital platforms.</p><p>Her performances carry warmth, maturity, and emotional depth. Over the years, she has appeared in stories that speak to family, society, relationships, and everyday human emotion.</p><p>This official website brings together her biography, selected works, videos, media appearances, audience appreciation, and professional contact information in one place.</p>', 'button_label' => 'Read More About Her', 'button_url' => '/biography', 'image_path' => 'assets/images/template/embedded-2516360e304f.png', 'sort_order' => 10],
            ['page' => 'home', 'section_key' => 'biography', 'eyebrow' => 'Biography', 'title' => 'A life in performance.', 'description' => '<p>Shamima Nazneen’s journey as an artist has moved through theatre, television, film, direction, and digital storytelling. Each chapter reflects discipline, patience, and a deep connection with the audience.</p>', 'button_label' => 'Read Full Biography', 'button_url' => '/biography', 'image_path' => 'assets/images/template/embedded-92827328aada.png', 'sort_order' => 20],
            ['page' => 'home', 'section_key' => 'works', 'eyebrow' => 'Selected Works', 'title' => 'Stories told through screen, stage, and character.', 'description' => '<p>A curated view of Shamima Nazneen’s work across television, film, theatre, and digital platforms.</p>', 'sort_order' => 30],
            ['page' => 'home', 'section_key' => 'films', 'eyebrow' => 'Filmography', 'title' => 'Selected films from her screen journey.', 'description' => '<p>Her film work includes appearances in noted Bangladeshi productions. Explore selected films, role details, posters, and viewing links where available.</p>', 'button_label' => 'View All Films', 'button_url' => '/works?category=films', 'sort_order' => 40],
            ['page' => 'home', 'section_key' => 'videos', 'eyebrow' => 'Video Gallery', 'title' => 'Watch performances, interviews, and features.', 'description' => '<p>Browse selected videos featuring Shamima Nazneen, including drama clips, biography features, interviews, and online platform appearances.</p>', 'button_label' => 'View More Videos', 'button_url' => '/gallery?type=video', 'sort_order' => 50],
            ['page' => 'home', 'section_key' => 'gallery', 'eyebrow' => 'Image Gallery', 'title' => 'Moments from screen, stage, and public life.', 'description' => '<p>A clean photo collection of portraits, drama posters, film stills, public appearances, cultural programs, and media moments.</p>', 'button_label' => 'View Full Gallery', 'button_url' => '/gallery', 'sort_order' => 60],
            ['page' => 'home', 'section_key' => 'media', 'eyebrow' => 'Media & Profiles', 'title' => 'Profiles, interviews, and public features.', 'description' => '<p>Find public profiles, online features, video interviews, and media references connected to Shamima Nazneen’s artistic journey.</p>', 'sort_order' => 70],
            ['page' => 'home', 'section_key' => 'audience', 'eyebrow' => 'Audience Appreciation', 'title' => 'Loved by viewers across generations.', 'description' => '<p>Audience responses from Facebook, YouTube, and online platforms reflect the affection people have for Shamima Nazneen’s performances and screen presence.</p>', 'sort_order' => 80],
            ['page' => 'home', 'section_key' => 'events', 'eyebrow' => 'Events & Appearances', 'title' => 'Cultural programs, media events, and special appearances.', 'description' => '<p>For cultural programs, television shows, interviews, guest appearances, and professional invitations, please contact the official representative.</p>', 'button_label' => 'Send Booking Inquiry', 'button_url' => '#contact', 'sort_order' => 90],
            ['page' => 'home', 'section_key' => 'contact', 'eyebrow' => 'Official Contact', 'title' => 'For booking, media, and professional inquiries.', 'description' => '<p>For event invitations, media communication, interview requests, public appearances, or collaboration inquiries, please use the official contact form.</p>', 'sort_order' => 100],

            ['page' => 'biography', 'section_key' => 'hero', 'eyebrow' => 'Biography', 'title' => 'Shamima Nazneen', 'description' => '<p>A journey through theatre, television, film, direction, and a lasting connection with audiences.</p>', 'image_path' => 'assets/images/template/embedded-92827328aada.png', 'sort_order' => 10],
            ['page' => 'biography', 'section_key' => 'gallery', 'eyebrow' => 'Photo & Video Gallery', 'title' => 'Selected moments from her artistic journey.', 'description' => '<p>Explore portraits, screen moments, public appearances, and selected videos.</p>', 'sort_order' => 20],

            ['page' => 'works', 'section_key' => 'hero', 'eyebrow' => 'Official Archive', 'title' => 'Works', 'description' => '<p>Explore films, television dramas, theatre performances, digital releases, direction, interviews, and public media features.</p>', 'sort_order' => 10],
            ['page' => 'works', 'section_key' => 'contact', 'eyebrow' => 'Professional Information', 'title' => 'For media, credits, or professional inquiries', 'description' => '<p>Use the official contact form for verified credits, booking, collaboration, and media requests.</p>', 'button_label' => 'Send Inquiry', 'button_url' => '/#contact', 'sort_order' => 20],

            ['page' => 'gallery', 'section_key' => 'hero', 'eyebrow' => 'Official Archive', 'title' => 'Image & Video Gallery', 'description' => '<p>Browse portraits, television moments, film appearances, cultural programs, media features, and embedded YouTube videos.</p>', 'sort_order' => 10],
        ];

        foreach ($sections as $section) {
            ContentSection::query()->updateOrCreate(
                ['page' => $section['page'], 'section_key' => $section['section_key']],
                $section + ['is_active' => true]
            );
        }
    }

    private function seedHeroSlides(): void
    {
        $slides = [
            ['image_path' => 'assets/images/template/embedded-bfef7bc6b1de.png', 'title' => null, 'subtitle' => null, 'sort_order' => 1],
            ['image_path' => 'assets/images/template/embedded-fc41de6d376a.png', 'title' => null, 'subtitle' => null, 'sort_order' => 2],
        ];

        foreach ($slides as $slide) {
            HeroSlide::query()->updateOrCreate(['image_path' => $slide['image_path']], $slide + ['is_active' => true]);
        }
    }

    private function seedBiography(): void
    {
        $sections = [
            ['title' => 'Early Artistic Journey', 'slug' => 'early-artistic-journey', 'year_label' => 'Beginning', 'content' => '<p>Her artistic path grew from a sustained interest in performance, storytelling, and the emotional detail of everyday life.</p>'],
            ['title' => 'Theatre Foundation', 'slug' => 'theatre-foundation', 'year_label' => '1996', 'content' => '<p>Theatre practice shaped her discipline, voice, movement, timing, and collaborative approach to performance.</p>'],
            ['title' => 'Television Career', 'slug' => 'television-career', 'year_label' => 'Television', 'content' => '<p>Through dramas and serials, she became a familiar screen presence in character-driven stories about family and society.</p>'],
            ['title' => 'Film Journey', 'slug' => 'film-journey', 'year_label' => 'Cinema', 'content' => '<p>Her film appearances placed her within important Bangladeshi screen stories and expanded the range of her acting archive.</p>'],
            ['title' => 'Direction and Digital Work', 'slug' => 'direction-and-digital-work', 'year_label' => 'Creative Work', 'content' => '<p>Her journey also includes direction, online productions, streaming-platform appearances, interviews, and digital features.</p>'],
            ['title' => 'Acting Style and Audience Connection', 'slug' => 'acting-style-and-audience-connection', 'year_label' => 'Performance', 'content' => '<p>Warmth, restraint, emotional honesty, and a natural screen presence remain central to her connection with viewers.</p>'],
            ['title' => 'Selected Areas of Work', 'slug' => 'selected-areas-of-work', 'year_label' => 'Archive', 'content' => '<p>Her archive includes theatre, television, cinema, direction, digital platforms, interviews, and public cultural programs.</p>'],
            ['title' => 'Legacy and Continuing Journey', 'slug' => 'legacy-and-continuing-journey', 'year_label' => 'Continuing', 'content' => '<p>Her ongoing journey reflects experience, artistic curiosity, and a continuing relationship with audiences across generations.</p>'],
        ];

        foreach ($sections as $index => $section) {
            BiographySection::query()->updateOrCreate(['slug' => $section['slug']], $section + ['sort_order' => ($index + 1) * 10, 'is_active' => true]);
        }
    }

    private function seedWorkCategories(): array
    {
        $rows = [
            ['name' => 'Television', 'slug' => 'television', 'description' => 'Television dramas, serials, and special productions.', 'home_title' => 'Television & Drama', 'home_description' => 'Explore drama appearances, serial work, and television productions featuring emotional, social, and family-focused roles.', 'home_image_path' => 'https://images.unsplash.com/photo-1503095396549-807759245b35?auto=format&fit=crop&w=900&q=80', 'link_label' => 'View Television Work →', 'show_on_home' => true, 'sort_order' => 10],
            ['name' => 'Films', 'slug' => 'films', 'description' => 'Selected film roles and Bangladeshi cinema appearances.', 'home_title' => 'Film Appearances', 'home_description' => 'See selected film roles and screen performances from her journey in Bangladeshi cinema.', 'home_image_path' => 'https://images.unsplash.com/photo-1485846234645-a62644f84728?auto=format&fit=crop&w=900&q=80', 'link_label' => 'View Filmography →', 'show_on_home' => true, 'sort_order' => 20],
            ['name' => 'Theatre', 'slug' => 'theatre', 'description' => 'Stage performances and theatre foundation.', 'home_title' => 'Theatre Work', 'home_description' => 'Explore selected stage work and the theatre practice that shaped her artistic foundation.', 'home_image_path' => 'https://images.unsplash.com/photo-1501386761578-eac5c94b800a?auto=format&fit=crop&w=900&q=80', 'link_label' => 'View Theatre Work →', 'show_on_home' => false, 'sort_order' => 30],
            ['name' => 'Digital', 'slug' => 'digital', 'description' => 'Streaming, online drama, and digital platform work.', 'home_title' => 'Digital Releases', 'home_description' => 'Find online dramas, streaming-platform appearances, video features, and recent digital work.', 'home_image_path' => 'https://images.unsplash.com/photo-1499364615650-ec38552f4f34?auto=format&fit=crop&w=900&q=80', 'link_label' => 'Explore Digital Work →', 'show_on_home' => true, 'sort_order' => 40],
            ['name' => 'Direction', 'slug' => 'direction', 'description' => 'Creative and directorial work.', 'show_on_home' => false, 'sort_order' => 50],
            ['name' => 'Interviews', 'slug' => 'interviews', 'description' => 'Interviews and public conversations.', 'show_on_home' => false, 'sort_order' => 60],
            ['name' => 'Media Features', 'slug' => 'media-features', 'description' => 'Public profiles and media features.', 'show_on_home' => false, 'sort_order' => 70],
        ];

        $categories = [];
        foreach ($rows as $row) {
            $categories[$row['slug']] = WorkCategory::query()->updateOrCreate(['slug' => $row['slug']], $row + ['is_active' => true]);
        }

        return $categories;
    }

    private function seedWorks(array $categories): void
    {
        $imageUrls = [
            'https://images.unsplash.com/photo-1485846234645-a62644f84728?auto=format&fit=crop&w=900&q=80',
            'https://images.unsplash.com/photo-1503095396549-807759245b35?auto=format&fit=crop&w=900&q=80',
            'https://images.unsplash.com/photo-1499364615650-ec38552f4f34?auto=format&fit=crop&w=900&q=80',
            'https://images.unsplash.com/photo-1515165562835-c3b8c9986c2f?auto=format&fit=crop&w=900&q=80',
            'https://images.unsplash.com/photo-1519741497674-611481863552?auto=format&fit=crop&w=900&q=80',
            'https://images.unsplash.com/photo-1529139574466-a303027c1d8b?auto=format&fit=crop&w=900&q=80',
        ];

        $works = [
            ['category' => 'films', 'title' => 'Srabon Megher Din', 'slug' => 'srabon-megher-din', 'year' => 1999, 'credit' => 'Actress', 'role' => 'Durga', 'platform' => 'Cinema', 'short_description' => '<p>A selected film from her screen journey in Bangladeshi cinema.</p>', 'image_path' => $imageUrls[0], 'show_on_home' => true, 'is_featured' => true],
            ['category' => 'films', 'title' => 'Dui Duari', 'slug' => 'dui-duari', 'year' => 2000, 'credit' => 'Actress', 'role' => 'Supporting role', 'platform' => 'Cinema', 'short_description' => '<p>A film appearance from her journey in Bangladeshi cinema.</p>', 'image_path' => $imageUrls[1], 'show_on_home' => true, 'is_featured' => true],
            ['category' => 'films', 'title' => 'Shyamol Chhaya', 'slug' => 'shyamol-chhaya', 'year' => 2004, 'credit' => 'Actress', 'role' => 'Supporting role', 'platform' => 'Cinema', 'short_description' => '<p>A noted Bangladeshi film associated with her screen career.</p>', 'image_path' => $imageUrls[2], 'show_on_home' => true, 'is_featured' => true],
            ['category' => 'films', 'title' => 'Ghetuputra Komola', 'slug' => 'ghetuputra-komola', 'year' => 2012, 'credit' => 'Actress', 'role' => 'Supporting role', 'platform' => 'Cinema', 'short_description' => '<p>A selected film appearance from her career.</p>', 'image_path' => $imageUrls[3], 'show_on_home' => true, 'is_featured' => true],
            ['category' => 'films', 'title' => 'Pita - The Father', 'slug' => 'pita-the-father', 'year' => 2012, 'credit' => 'Actress', 'role' => 'Supporting role', 'platform' => 'Cinema', 'short_description' => '<p>Film work from her journey in Bangladeshi cinema.</p>', 'image_path' => $imageUrls[4], 'show_on_home' => true, 'is_featured' => false],
            ['category' => 'films', 'title' => 'Chorabali', 'slug' => 'chorabali', 'year' => 2012, 'credit' => 'Actress', 'role' => 'Supporting role', 'platform' => 'Cinema', 'short_description' => '<p>A selected screen appearance from Bangladeshi cinema.</p>', 'image_path' => $imageUrls[5], 'show_on_home' => true, 'is_featured' => false],
            ['category' => 'television', 'title' => 'Friendbook', 'slug' => 'friendbook', 'year' => 2021, 'credit' => 'Actress', 'role' => 'Television role', 'platform' => 'NTV', 'short_description' => '<p>A character-driven television serial appearance.</p>', 'image_path' => $imageUrls[1], 'show_on_home' => false, 'is_featured' => true],
            ['category' => 'television', 'title' => 'Bachelor Point', 'slug' => 'bachelor-point', 'year' => 2018, 'credit' => 'Actress', 'role' => 'Television role', 'platform' => 'Television / Digital', 'short_description' => '<p>A selected television appearance. Full role details can be maintained from the admin panel.</p>', 'image_path' => $imageUrls[2], 'show_on_home' => false, 'is_featured' => false],
            ['category' => 'theatre', 'title' => 'Nagarik Theatre Journey', 'slug' => 'nagarik-theatre-journey', 'year' => 1996, 'credit' => 'Performer', 'role' => 'Stage performer', 'platform' => 'Theatre', 'short_description' => '<p>Theatre practice and stage work forming an important foundation of her artistic journey.</p>', 'image_path' => 'https://images.unsplash.com/photo-1501386761578-eac5c94b800a?auto=format&fit=crop&w=900&q=80', 'show_on_home' => false, 'is_featured' => true],
            ['category' => 'digital', 'title' => 'Tonoya', 'slug' => 'tonoya', 'year' => 2024, 'credit' => 'Actress', 'role' => 'Featured performer', 'platform' => 'Chorki', 'short_description' => '<p>A platform-based screen appearance. Replace or expand the verified production details from the admin panel.</p>', 'image_path' => 'https://images.unsplash.com/photo-1522869635100-9f4c5e86aa37?auto=format&fit=crop&w=900&q=80', 'link_name' => 'View on Chorki', 'link_url' => 'https://www.chorki.com/movie/casts/shamima-nazneen', 'show_on_home' => false, 'is_featured' => true],
            ['category' => 'direction', 'title' => 'Package Sangbad', 'slug' => 'package-sangbad', 'year' => 2014, 'credit' => 'Director', 'role' => 'Director', 'platform' => 'Television', 'short_description' => '<p>A selected directorial credit from her creative journey.</p>', 'image_path' => $imageUrls[0], 'show_on_home' => false, 'is_featured' => false],
        ];

        foreach ($works as $index => $work) {
            $category = $categories[$work['category']];
            unset($work['category']);
            Work::query()->updateOrCreate(
                ['slug' => $work['slug']],
                $work + ['category_id' => $category->id, 'sort_order' => ($index + 1) * 10, 'is_active' => true]
            );
        }
    }

    private function seedMedia(): void
    {
        $items = [
            ['type' => 'image', 'title' => 'Official Portrait', 'category' => 'Portraits', 'year' => 2024, 'description' => '<p>Official portrait from the website archive.</p>', 'image_path' => 'assets/images/template/embedded-2516360e304f.png', 'show_on_home' => true, 'is_featured' => true, 'sort_order' => 10],
            ['type' => 'image', 'title' => 'Selected Portrait', 'category' => 'Portraits', 'year' => 2024, 'description' => '<p>A selected portrait from her artistic journey.</p>', 'image_path' => 'assets/images/template/embedded-92827328aada.png', 'show_on_home' => true, 'is_featured' => false, 'sort_order' => 20],
            ['type' => 'image', 'title' => 'Television Moment', 'category' => 'Television', 'year' => 2023, 'description' => '<p>A selected moment representing television work.</p>', 'image_path' => 'https://images.unsplash.com/photo-1503095396549-807759245b35?auto=format&fit=crop&w=900&q=80', 'show_on_home' => true, 'is_featured' => false, 'sort_order' => 30],
            ['type' => 'image', 'title' => 'Film Appearance', 'category' => 'Films', 'year' => 2012, 'description' => '<p>A film-production image for the screen archive.</p>', 'image_path' => 'https://images.unsplash.com/photo-1485846234645-a62644f84728?auto=format&fit=crop&w=900&q=80', 'show_on_home' => true, 'is_featured' => false, 'sort_order' => 40],
            ['type' => 'image', 'title' => 'Cultural Program', 'category' => 'Events', 'year' => 2023, 'description' => '<p>A public and cultural program moment.</p>', 'image_path' => 'https://images.unsplash.com/photo-1492684223066-81342ee5ff30?auto=format&fit=crop&w=900&q=80', 'show_on_home' => true, 'is_featured' => false, 'sort_order' => 50],
            ['type' => 'image', 'title' => 'Media Feature', 'category' => 'Media', 'year' => 2024, 'description' => '<p>A selected public media feature.</p>', 'image_path' => 'https://images.unsplash.com/photo-1508214751196-bcfd4ca60f91?auto=format&fit=crop&w=900&q=80', 'show_on_home' => true, 'is_featured' => false, 'sort_order' => 60],
            ['type' => 'image', 'title' => 'Stage Memory', 'category' => 'Stage', 'year' => 2022, 'description' => '<p>A moment representing stage and performance.</p>', 'image_path' => 'https://images.unsplash.com/photo-1506157786151-b8491531f063?auto=format&fit=crop&w=900&q=80', 'show_on_home' => true, 'is_featured' => false, 'sort_order' => 70],
            ['type' => 'video', 'title' => 'Meet Shamima Nazneen | Tonoya', 'category' => 'Interviews', 'year' => 2024, 'description' => '<p>A selected interview and platform feature.</p>', 'youtube_url' => 'https://www.youtube.com/watch?v=7otxj1gqRtg', 'link_name' => 'Watch on YouTube', 'link_url' => 'https://www.youtube.com/watch?v=7otxj1gqRtg', 'show_on_home' => true, 'is_featured' => true, 'sort_order' => 80],
            ['type' => 'video', 'title' => 'Srabon Megher Din', 'category' => 'Films', 'year' => 1999, 'description' => '<p>A selected film video from the public archive.</p>', 'youtube_url' => 'https://www.youtube.com/watch?v=2m56a4EyVWY', 'link_name' => 'Watch on YouTube', 'link_url' => 'https://www.youtube.com/watch?v=2m56a4EyVWY', 'show_on_home' => true, 'is_featured' => false, 'sort_order' => 90],
        ];

        foreach ($items as $item) {
            MediaItem::query()->updateOrCreate(
                ['type' => $item['type'], 'title' => $item['title']],
                $item + ['is_active' => true]
            );
        }
    }

    private function seedTestimonials(): void
    {
        $testimonials = [
            ['quote' => 'Her screen presence feels natural, warm, and deeply human.', 'author' => 'Audience appreciation', 'source' => 'Online viewers'],
            ['quote' => 'Every character feels familiar, honest, and emotionally grounded.', 'author' => 'Viewer response', 'source' => 'Public audience'],
            ['quote' => 'A memorable performer whose work continues to connect across generations.', 'author' => 'Audience reflection', 'source' => 'Online platforms'],
        ];

        foreach ($testimonials as $index => $testimonial) {
            Testimonial::query()->updateOrCreate(
                ['quote' => $testimonial['quote']],
                $testimonial + ['sort_order' => ($index + 1) * 10, 'is_active' => true]
            );
        }
    }

    private function seedEvents(array $categories): void
    {
        $events = [
            ['title' => 'Cultural Programs', 'category' => 'theatre', 'description' => '<p>Available for selected cultural programs and artistic events through official coordination.</p>', 'image_path' => 'https://images.unsplash.com/photo-1492684223066-81342ee5ff30?auto=format&fit=crop&w=900&q=80', 'show_on_home' => true, 'sort_order' => 10],
            ['title' => 'Media Interviews', 'category' => 'interviews', 'description' => '<p>Interview and public media requests can be submitted through the official inquiry form.</p>', 'image_path' => 'https://images.unsplash.com/photo-1522869635100-9f4c5e86aa37?auto=format&fit=crop&w=900&q=80', 'show_on_home' => true, 'sort_order' => 20],
            ['title' => 'Guest Appearances', 'category' => 'television', 'description' => '<p>Professional invitations and guest-appearance requests are reviewed by the official representative.</p>', 'image_path' => 'https://images.unsplash.com/photo-1464375117522-1311ddf47c47?auto=format&fit=crop&w=900&q=80', 'show_on_home' => true, 'sort_order' => 30],
        ];

        foreach ($events as $event) {
            $category = $categories[$event['category']];
            unset($event['category']);
            Event::query()->updateOrCreate(
                ['title' => $event['title']],
                $event + ['work_category_id' => $category->id, 'is_active' => true]
            );
        }
    }
}
