<?php
    $legacySocial = $siteSettings->social_links ?? [];

    $detectProfileIcon = function (?string $label, ?string $url = null): array {
        $normalized = strtolower(trim(($label ?? '').' '.($url ?? '')));

        return match (true) {
            str_contains($normalized, 'chorki') => ['label' => 'Chorki', 'mark' => 'C', 'class' => 'chorki'],
            str_contains($normalized, 'imdb') => ['label' => 'IMDb', 'mark' => 'IMDb', 'class' => 'imdb'],
            str_contains($normalized, 'wiki') => ['label' => 'Wikipedia', 'mark' => 'W', 'class' => 'wikipedia'],
            str_contains($normalized, 'youtube') || str_contains($normalized, 'youtu.be') => ['label' => 'YouTube', 'mark' => '▶', 'class' => 'youtube'],
            str_contains($normalized, 'facebook') || str_contains($normalized, 'fb.com') => ['label' => 'Facebook', 'mark' => 'f', 'class' => 'facebook'],
            str_contains($normalized, 'instagram') => ['label' => 'Instagram', 'mark' => '◎', 'class' => 'instagram'],
            str_contains($normalized, 'linkedin') => ['label' => 'LinkedIn', 'mark' => 'in', 'class' => 'linkedin'],
            str_contains($normalized, 'x.com') || str_contains($normalized, 'twitter') => ['label' => 'X', 'mark' => '𝕏', 'class' => 'x'],
            default => [
                'label' => filled($label) ? $label : 'Profile',
                'mark' => mb_strtoupper(mb_substr(trim((string) $label), 0, 1)) ?: '↗',
                'class' => 'default',
            ],
        };
    };

    $providedLinks = collect($links ?? [])
        ->filter(fn ($link) => filled($link['url'] ?? null) || filled($link['href'] ?? null))
        ->map(function ($link) use ($detectProfileIcon) {
            $url = $link['url'] ?? $link['href'] ?? null;
            $label = $link['label'] ?? $link['title'] ?? null;
            $icon = $detectProfileIcon($label, $url);
            $iconPath = $link['icon_path'] ?? null;
            $iconUrl = $link['icon_url'] ?? \App\Support\Media::url($iconPath);

            return [
                'label' => $label ?: $icon['label'],
                'url' => $url,
                'mark' => $link['mark'] ?? $icon['mark'],
                'class' => $link['class'] ?? $icon['class'],
                'icon_url' => $iconUrl,
            ];
        })
        ->values();

    if ($providedLinks->isEmpty()) {
        $providedLinks = collect($siteSettings->profile_card_links ?? [])
            ->filter(fn ($link) => filled($link['title'] ?? null) && filled($link['url'] ?? null))
            ->map(function ($link) use ($detectProfileIcon) {
                $icon = $detectProfileIcon($link['title'] ?? null, $link['url'] ?? null);

                return [
                    'label' => $link['title'] ?: $icon['label'],
                    'url' => $link['url'],
                    'mark' => $icon['mark'],
                    'class' => $icon['class'],
                    'icon_url' => \App\Support\Media::url($link['icon_path'] ?? null),
                ];
            })
            ->values();
    }

    if ($providedLinks->isEmpty()) {
        $legacyDefinitions = [
            'chorki' => ['label' => 'Chorki', 'mark' => 'C', 'class' => 'chorki'],
            'imdb' => ['label' => 'IMDb', 'mark' => 'IMDb', 'class' => 'imdb'],
            'facebook' => ['label' => 'Facebook', 'mark' => 'f', 'class' => 'facebook'],
            'youtube' => ['label' => 'YouTube', 'mark' => '▶', 'class' => 'youtube'],
            'wikipedia' => ['label' => 'Wikipedia', 'mark' => 'W', 'class' => 'wikipedia'],
        ];

        $providedLinks = collect($legacyDefinitions)
            ->map(fn ($definition, $key) => filled($legacySocial[$key] ?? null) ? [
                'label' => $definition['label'],
                'url' => $legacySocial[$key],
                'mark' => $definition['mark'],
                'class' => $definition['class'],
                'icon_url' => null,
            ] : null)
            ->filter()
            ->values();
    }
?>

<?php $__currentLoopData = $providedLinks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $profileLink): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <?php
        $profileUrl = $profileLink['url'];
        $profileClass = $profileLink['class'] ?: 'default';
        $profileLabel = $profileLink['label'] ?: 'Profile';
        $profileIconUrl = $profileLink['icon_url'] ?? null;
        $profileIsExternal = \Illuminate\Support\Str::startsWith($profileUrl, ['http://', 'https://']);
    ?>
    <a class="social-link social-link-<?php echo e($profileClass); ?> <?php echo e($profileClass === 'chorki' ? 'chorki' : ''); ?>" href="<?php echo e($profileUrl); ?>" <?php if($profileIsExternal): ?> target="_blank" rel="noopener noreferrer" <?php endif; ?> aria-label="<?php echo e($profileLabel); ?>">
        <span class="social-icon <?php echo e($profileIconUrl ? 'has-custom-icon' : ''); ?>" aria-hidden="true">
            <?php if($profileIconUrl): ?>
                <img src="<?php echo e($profileIconUrl); ?>" alt="" loading="lazy" data-fallback-text="Profile logo is not available.">
            <?php else: ?>
                <?php echo e($profileLink['mark'] ?: '↗'); ?>

            <?php endif; ?>
        </span>
        <span><?php echo e($profileLabel); ?></span>
    </a>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/laravel/shamima-nazneen/resources/views/frontend/partials/social-links.blade.php ENDPATH**/ ?>