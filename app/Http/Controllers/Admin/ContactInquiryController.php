<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactInquiry;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Validation\Rule;

class ContactInquiryController extends Controller
{
    public function index(): View
    {
        $query = ContactInquiry::query()->latest();

        if (request('status')) {
            $query->where('status', request('status'));
        }

        $inquiries = $query->paginate(25)->withQueryString();

        return view('admin.inquiries.index', compact('inquiries'));
    }

    public function show(ContactInquiry $inquiry): View
    {
        if (! $inquiry->read_at) {
            $inquiry->update(['read_at' => now(), 'status' => $inquiry->status === 'new' ? 'read' : $inquiry->status]);
        }

        return view('admin.inquiries.show', compact('inquiry'));
    }

    public function update(ContactInquiry $inquiry): RedirectResponse
    {
        $data = request()->validate([
            'status' => ['required', Rule::in(['new', 'read', 'replied', 'closed'])],
        ], [
            'status.required' => 'Choose the inquiry status.',
            'status.in' => 'Choose a valid inquiry status.',
        ], [
            'status' => 'inquiry status',
        ]);

        $inquiry->update($data + ['read_at' => $inquiry->read_at ?: now()]);

        return back()->with('success', 'Inquiry status updated successfully.');
    }

    public function destroy(ContactInquiry $inquiry): RedirectResponse
    {
        $inquiry->delete();

        return redirect()->route('admin.inquiries.index')->with('success', 'Inquiry deleted successfully.');
    }
}
