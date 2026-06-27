<?php

use Illuminate\Support\Facades\Artisan;

Artisan::command('inspire', function (): void {
    $this->comment('Art is the heart of this archive.');
})->purpose('Display an inspiring quote');
