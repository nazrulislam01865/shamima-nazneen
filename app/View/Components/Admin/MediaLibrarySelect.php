<?php

namespace App\View\Components\Admin;

use App\Support\Media;
use App\Support\MediaLibrary;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class MediaLibrarySelect extends Component
{
    public mixed $items;

    public ?int $selectedId;

    public ?string $currentUrl;

    public string $typeLabel;

    public string $emptyMessage;

    public function __construct(
        public string $name,
        public string $label = 'Choose from Image Gallery',
        public ?string $currentPath = null,
        public ?string $currentVideoUrl = null,
        public ?string $help = null,
        public string $type = 'image',
    ) {
        $this->type = $type === 'video' ? 'video' : 'image';
        $this->typeLabel = $this->type === 'video' ? 'video' : 'image';
        $this->items = MediaLibrary::items($this->type);
        $this->selectedId = $this->type === 'video'
            ? MediaLibrary::videoIdForUrl($currentVideoUrl)
            : MediaLibrary::imageIdForPath($currentPath);
        $this->currentUrl = $this->type === 'video'
            ? null
            : Media::url($currentPath);
        $this->emptyMessage = $this->type === 'video'
            ? 'No videos are available yet. Add a YouTube video in Video Gallery first.'
            : 'No images are available yet. Upload a new image below first.';
    }

    public function render(): View|Closure|string
    {
        return view('components.admin.media-library-select');
    }
}
