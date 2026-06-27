<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class EnsureSingleAdminSession
{
    public function handle(Request $request, Closure $next): Response
    {
        $user = $request->user();

        if (! $user?->is_admin) {
            return $next($request);
        }

        $activeSessionId = (string) ($user->active_admin_session_id ?? '');
        $currentSessionId = $request->session()->getId();

        if ($activeSessionId !== '' && $activeSessionId !== $currentSessionId) {
            Auth::logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();

            return redirect()
                ->route('admin.login')
                ->withErrors(['email' => 'Your admin session was logged out because this account signed in on another device.']);
        }

        return $next($request);
    }
}
