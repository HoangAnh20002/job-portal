<?php

namespace App\Http\Middleware;

use App\Enums\Base;
use Closure;
use Illuminate\Http\Request;

class EmployerMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if(auth()->check()&&auth()->user()->role_id==Base::EMPLOYER){
            return $next($request);
        }
        return redirect('/')->with('error', 'Bạn không có quyền truy cập vào trang này.');
    }
}
