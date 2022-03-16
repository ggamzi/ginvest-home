<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Acl;
use App\Models\User;
use App\Models\BlackList;
use Illuminate\Http\Request;
use Auth;


class BlacklistChk
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

        // 블랙리스트면 404페이지 띄우고 차단
        $blacklist_chk = DB::table('black_list')->where('ip',$ip)->count();
        if ($blacklist_chk > 0) die(header("HTTP/1.1 404 Not Found"));

        return $next($request);
    }
}
