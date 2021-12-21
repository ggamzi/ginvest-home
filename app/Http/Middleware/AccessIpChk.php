<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Acl;
use App\Models\User;
use Illuminate\Http\Request;
use Auth;


class AccessIpChk
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
        // IP 주소 불러옴
        $ip = ip2long($_SERVER['REMOTE_ADDR']);

        // 관리자가 아닌 계정으로 로그인되어 있는 경우 404 페이지
        if(Auth::check() && Auth::user()->rank == 0) die(header("HTTP/1.1 404 Not Found"));

        // Access List에 IP가 존재하지 않는다면 404 페이지 띄움
        $allow_ip = Acl::where('ip',$ip)->count();
        if ($allow_ip == 0) die(header("HTTP/1.1 404 Not Found"));

        return $next($request);
    }
}
