<?php

namespace App\Http\Controllers;

use App\Models\CustomPage;
use Illuminate\Contracts\View\View;

class CustomPageController extends Controller
{
    public function show(CustomPage $customPage): View
    {
        abort_unless($customPage->is_active, 404);

        return view('frontend.custom-page', compact('customPage'));
    }
}
