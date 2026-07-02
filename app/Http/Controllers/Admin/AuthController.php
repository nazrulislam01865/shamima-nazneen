<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdminLoginRequest;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function create(): View|RedirectResponse
    {
        if (Auth::check() && Auth::user()?->is_admin) {
            return redirect()->route('admin.dashboard');
        }

        return view('admin.auth.login');
    }

    public function store(AdminLoginRequest $request): RedirectResponse
    {
        $credentials = $request->safe()->only(['email', 'password']);

        if (! Auth::attempt($credentials, $request->boolean('remember'))) {
            return back()->withErrors(['email' => 'The email address or password is not correct. Please check and try again.'])->onlyInput('email');
        }

        $request->session()->regenerate();

        if (! $request->user()?->is_admin) {
            Auth::logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();

            return back()->withErrors(['email' => 'This account cannot access the admin panel. Please use an authorized administrator account.']);
        }

        $user = $request->user();
        $previousSessionId = (string) ($user->active_admin_session_id ?? '');
        $currentSessionId = $request->session()->getId();
        $hadPreviousSession = $previousSessionId !== '' && $previousSessionId !== $currentSessionId;

        $user->forceFill([
            'active_admin_session_id' => $currentSessionId,
            'active_admin_login_at' => now(),
        ])->save();

        $redirect = redirect()->intended(route('admin.dashboard'));

        if ($hadPreviousSession) {
            $redirect->with('success', 'Previous admin session was logged out.');
        }

        return $redirect;
    }

    public function destroy(): RedirectResponse
    {
        $user = request()->user();
        $currentSessionId = request()->session()->getId();

        if ($user?->is_admin && $user->active_admin_session_id === $currentSessionId) {
            $user->forceFill([
                'active_admin_session_id' => null,
                'active_admin_login_at' => null,
            ])->save();
        }

        Auth::logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();

        return redirect()->route('admin.login');
    }
}
