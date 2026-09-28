<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class SecureAdminSession
{
    public function handle(Request $request, Closure $next): Response
    {
        $timeoutSeconds = max(60, (int) config('admin.session_timeout', 15) * 60);
        $lastActivity = (int) $request->session()->get('admin_last_activity', 0);

        if ($lastActivity > 0 && (time() - $lastActivity) > $timeoutSeconds) {
            Auth::guard('web')->logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();

            return redirect()
                ->route('login')
                ->with('status', 'Your admin session expired due to inactivity. Please sign in again.');
        }

        $request->session()->put('admin_last_activity', time());

        $response = $next($request);

        $response->headers->set('Cache-Control', 'no-store, no-cache, must-revalidate, max-age=0');
        $response->headers->set('Pragma', 'no-cache');
        $response->headers->set('Expires', '0');
        $response->headers->set('X-Frame-Options', 'DENY');
        $response->headers->set('X-Content-Type-Options', 'nosniff');
        $response->headers->set('Referrer-Policy', 'same-origin');
        $response->headers->set('Permissions-Policy', 'camera=(), microphone=(), geolocation=()');

        return $response;
    }
}
