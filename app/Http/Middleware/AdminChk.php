<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

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
        $red_flag = true;

        $user_ip = $request->ip();
        $allow_ip = DB::select("SELECT INET_NTOA(ip) as ip FROM acl");


        foreach ($allow_ip as $row) {
            if ($user_ip == $row->ip) {
                $red_flag = false;
                break;
            }
        }
        
        if ($red_flag) die(header("HTTP/1.1 404 Not Found"));

        return $next($request);
    }
}
