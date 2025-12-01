<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @param  string  $role   // 'admin', 'student', or 'instructor'
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, $role)
    {
        // If user is not logged in → redirect to login
        if (!auth()->check()) {
            return redirect()->route('login');
        }

        // Map role name → numeric value
        $roleMap = [
            'admin'      => 0,
            'student'    => 1,
            'instructor' => 2,
        ];

        // Kung dili valid ang gi-pass nga role
        if (!array_key_exists($role, $roleMap)) {
            abort(500, 'Invalid role configuration.');
        }

        $requiredRoleValue = $roleMap[$role];

        // If user role is not the required one → block access
        if ((int) auth()->user()->role !== $requiredRoleValue) {
            abort(403, 'Unauthorized Access.');
        }

        return $next($request);
    }
}