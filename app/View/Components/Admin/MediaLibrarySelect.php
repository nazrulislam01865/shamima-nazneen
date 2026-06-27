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

    public function __construct(
        public string $name,
        public string $label = 'Choose from Gallery / Media Library',
        public ?string $currentPath = null,
        public ?string $help = null,
    ) {
        $this->items = MediaLibrary::images();
        $this->selectedId = MediaLibrary::imageIdForPath($currentPath);
        $this->currentUrl = Media::url($currentPath);
    }

    public function render(): View|Closure|string
    {
        return view('components.admin.media-library-select');
    }
}
