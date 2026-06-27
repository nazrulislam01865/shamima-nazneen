<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactInquiryRequest;
use App\Models\ContactInquiry;
use Illuminate\Http\RedirectResponse;

class ContactInquiryController extends Controller
{
    public function store(ContactInquiryRequest $request): RedirectResponse
    {
        $data = $request->validated();
        unset($data['website'], $data['captcha_answer']);

        ContactInquiry::query()->create($data);

        $request->session()->forget(['contact_captcha_question', 'contact_captcha_answer']);

        return back()->with('success', 'Thank you. Your inquiry has been received.');
    }
}
