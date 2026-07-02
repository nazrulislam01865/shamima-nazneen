<?php
    $profileCardLinks = collect($siteSettings->profile_card_links ?? [])
        ->filter(fn ($link) => filled($link['title'] ?? null) && filled($link['url'] ?? null))
        ->values();

    if ($profileCardLinks->isEmpty()) {
        $legacyDefinitions = [
            'chorki' => ['title' => 'Chorki', 'description' => 'Explore the public Chorki cast and platform profile.'],
            'imdb' => ['title' => 'IMDb', 'description' => 'View screen credits and the public IMDb profile.'],
            'wikipedia' => ['title' => 'Wikipedia', 'description' => 'Open the public Wikipedia profile and biography reference.'],
            'youtube' => ['title' => 'YouTube', 'description' => 'Watch public interviews, appearances, and video features.'],
            'facebook' => ['title' => 'Facebook', 'description' => 'Visit the official Facebook page and public features.'],
        ];

        $profileCardLinks = collect($legacyDefinitions)
            ->map(fn ($definition, $key) => filled($social[$key] ?? null) ? [
                'title' => $definition['title'],
                'url' => $social[$key],
                'description' => $definition['description'],
                'icon_path' => null,
            ] : null)
            ->filter()
            ->values();
    }

    $profileMarkFor = function (?string $title, ?string $url = null): array {
        $normalized = strtolower(trim(($title ?? '').' '.($url ?? '')));
        return match (true) {
            str_contains($normalized, 'chorki') => ['mark' => 'C', 'class' => 'chorki'],
            str_contains($normalized, 'imdb') => ['mark' => 'IMDb', 'class' => 'imdb'],
            str_contains($normalized, 'wiki') => ['mark' => 'W', 'class' => 'wikipedia'],
            str_contains($normalized, 'youtube') || str_contains($normalized, 'youtu.be') => ['mark' => '▶', 'class' => 'youtube'],
            str_contains($normalized, 'facebook') || str_contains($normalized, 'fb.com') => ['mark' => 'f', 'class' => 'facebook'],
            str_contains($normalized, 'instagram') => ['mark' => '◎', 'class' => 'instagram'],
            str_contains($normalized, 'linkedin') => ['mark' => 'in', 'class' => 'linkedin'],
            str_contains($normalized, 'x.com') || str_contains($normalized, 'twitter') => ['mark' => '𝕏', 'class' => 'x'],
            default => ['mark' => mb_strtoupper(mb_substr(trim((string) $title), 0, 1)) ?: '↗', 'class' => 'default'],
        };
    };
?>

<?php if($profileMedia->isNotEmpty() || $profileCardLinks->isNotEmpty()): ?>
<section class="works media-profiles-section" id="media">
    <div class="container">
        <div class="section-head media-section-head">
            <?php if($section->eyebrow): ?><div class="section-label"><?php echo e($section->eyebrow); ?></div><?php endif; ?>
            <h2><?php echo e($section->title); ?></h2>
            <div class="lead rich-content"><?php echo $section->description; ?></div>
        </div>

        <?php if($profileCardLinks->isNotEmpty()): ?>
            <div class="profile-follow-panel">
                <h3><span aria-hidden="true">✦</span> Follow <?php echo e($siteSettings->site_name); ?> <span aria-hidden="true">✦</span></h3>
                <div class="profile-follow-grid">
                    <?php $__currentLoopData = $profileCardLinks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $profileLink): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php
                            $profileUrl = $profileLink['url'];
                            $profileIsExternal = \Illuminate\Support\Str::startsWith($profileUrl, ['http://', 'https://']);
                            $profileTitle = $profileLink['title'];
                            $icon = $profileMarkFor($profileTitle, $profileUrl);
                            $profileIconUrl = \App\Support\Media::url($profileLink['icon_path'] ?? null);
                        ?>
                        <a class="profile-follow-card profile-follow-card-<?php echo e($icon['class']); ?>" href="<?php echo e($profileUrl); ?>" <?php if($profileIsExternal): ?> target="_blank" rel="noopener noreferrer" <?php endif; ?>>
                            <span class="profile-follow-icon <?php echo e($profileIconUrl ? 'has-custom-icon' : ''); ?>" aria-hidden="true">
                                <?php if($profileIconUrl): ?>
                                    <img src="<?php echo e($profileIconUrl); ?>" alt="" loading="lazy" data-fallback-text="Profile logo is not available.">
                                <?php else: ?>
                                    <?php echo e($icon['mark']); ?>

                                <?php endif; ?>
                            </span>
                            <span class="profile-follow-copy">
                                <strong><?php echo e($profileTitle); ?></strong>
                                <?php if(filled($profileLink['description'] ?? null)): ?><small><?php echo e($profileLink['description']); ?></small><?php endif; ?>
                            </span>
                            <span class="profile-follow-arrow" aria-hidden="true">›</span>
                        </a>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
        <?php endif; ?>

        <?php if($profileMedia->isNotEmpty()): ?>
            <div class="press-grid media-library-grid">
                <?php $__currentLoopData = $profileMedia; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $profileItem): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php
                        $profileUrl = $profileItem->link_url ?: ($profileItem->type === 'video' ? $profileItem->youtube_watch_url : route('gallery.index'));
                        $profileIsExternal = \Illuminate\Support\Str::startsWith($profileUrl, ['http://', 'https://']);
                    ?>
                    <a class="press-card press-card-link media-library-press-card" href="<?php echo e($profileUrl); ?>" <?php if($profileIsExternal): ?> target="_blank" rel="noopener noreferrer" <?php endif; ?>>
                        <div class="press-card-media">
                            <?php if($profileItem->image_url): ?>
                                <img src="<?php echo e($profileItem->image_url); ?>" alt="<?php echo e($profileItem->alt_text ?: $profileItem->title); ?>" data-fallback-text="<?php echo e($profileItem->fallback_text ?: $siteSettings->image_fallback_text); ?>">
                            <?php else: ?>
                                <span class="media-fallback is-visible"><?php echo e($profileItem->fallback_text ?: $siteSettings->image_fallback_text); ?></span>
                            <?php endif; ?>
                            <?php if($profileItem->type === 'video'): ?><span class="press-play" aria-hidden="true">▶</span><?php endif; ?>
                        </div>
                        <h3><?php echo e($profileItem->title); ?></h3>
                        <p><?php echo e(\Illuminate\Support\Str::limit(strip_tags($profileItem->description ?: $profileItem->link_label ?: 'Open this profile or media feature.'), 120)); ?></p>
                        <span class="text-link"><?php echo e($profileItem->link_label ?: 'Open link'); ?></span>
                    </a>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        <?php endif; ?>
    </div>
</section>
<?php endif; ?>
<?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/laravel/shamima-nazneen/resources/views/frontend/home-sections/media.blade.php ENDPATH**/ ?>