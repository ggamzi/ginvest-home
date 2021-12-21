<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Acl;
use Illuminate\Http\Request;

class AdminCheck
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        // 로그인이 되어있지 않다면 로그인 페이지로 리다이렉트
        if(auth()->check()){
            return $next($request);
        } else {
            return redirect('/admin/login');
        }
    }
}
