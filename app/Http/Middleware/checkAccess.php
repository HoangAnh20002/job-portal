<?php

namespace App\Http\Middleware;

use App\Enums\Base;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class checkAccess
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle($request, Closure $next)
    {
        $user = Auth::user();

        if (Auth::check() && $user->role_id == Base::ADMIN) {
            return $next($request);
        }

        if ($request->route()->parameter('jobseeker')) {
            $jobseeker = $request->route()->parameter('jobseeker');
            if ($user->role_id == Base::JOBSEEKER && $user->id == $jobseeker->user_id) {
                return $next($request);
            }
        }

        if ($request->route()->parameter('employer')) {
            $employer = $request->route()->parameter('employer');
            if ($user->role_id == Base::EMPLOYER && $user->id == $employer->user_id) {
                return $next($request);
            }
        }

        return redirect('/')->with('error', 'Bạn không có quyền truy cập vào trang này.');
    }
}
