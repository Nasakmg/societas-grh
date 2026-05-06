<?php
namespace App\Http\Middleware;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckRole
{public function handle(Request $request, Closure $next, string $role): mixed
{
    if (!Auth::check()) {
        return redirect()->route('login');
    }

    switch (Auth::user()->role) {
        case 'admin':
            if (!$request->routeIs('admin.dashboard')) {
                return redirect()->route('admin.dashboard');
            }
            break;
        case 'manager':
            if (!$request->routeIs('manager.dashboard')) {
                return redirect()->route('manager.dashboard');
            }
            break;
        case 'employe':
            if (!$request->routeIs('employe.dashboard')) {
                return redirect()->route('employe.dashboard');
            }
            break;
        case 'comptable':
            if (!$request->routeIs('comptable.dashboard')) {
                return redirect()->route('comptable.dashboard');
            }
            break;
        default:
            return redirect()->route('login');
    }

    return $next($request);
}
}
