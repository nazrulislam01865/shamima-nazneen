<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdminAccountRequest;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class AccountController extends Controller
{
    public function edit(): View
    {
        return view('admin.account.edit', ['admin' => request()->user()]);
    }

    public function update(AdminAccountRequest $request): RedirectResponse
    {
        $data = $request->safe()->only(['name', 'email']);

        if ($request->filled('password')) {
            $data['password'] = $request->string('password')->toString();
        }

        $request->user()->update($data);

        return back()->with('success', 'Administrator account updated successfully.');
    }
}
