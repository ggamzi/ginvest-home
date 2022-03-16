<?php

namespace App\Http\Middleware;

use Closure;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;


class VistorCnt
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
        
        // 쿠키에 ip값이 없을 때 count up (3시간)
        if($request->hasCookie($ip) != true){
            Cookie::queue($ip, 'value', 180);
            // 해당일 데이터 없으면 새로 만듦
            if(DB::table('visitors')->where('date',date("Y-m-d"))->count() == 0){
                DB::table('visitors')->insert(['date'=>date("Y-m-d"), 'count'=> 1, 'created_at' => date("Y-m-d H:i:s")]);
            } else {
                DB::table('visitors')->where('date',date("Y-m-d"))->update(['count' => DB::raw('count + 1'), 'updated_at' => date("Y-m-d H:i:s")]);
            }
        };

        return $next($request);
    }
}
