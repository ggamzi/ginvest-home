<?php

namespace App\Http\Middleware;

use Closure;
use DB;
use App\Mail\Alert;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Http\Controllers\BlackListController;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Cookie\Middleware\EncryptCookies;

class GlobalAuth
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
        $ckID = $ip.'7';
        $DateTime = date('Y-m-d h:i:s', time());  
        $ipArr[] = strtotime($DateTime);
        $ipArrJson = json_encode($ipArr);
        $arrCnt = 0;    //단기간 반복접속 시도 횟수 카운트
        $arrValCnt = [];    //시간별 접속시도 중복건 카운트
        
        // 블랙리스트면 404페이지 띄우고 차단
        $blacklist_chk = DB::table('black_list')->where('ip',$ip)->count();
        if ($blacklist_chk > 0) die(header("HTTP/1.1 404 Not Found"));
        if($_SERVER['HTTP_SEC_FETCH_DEST'] != 'iframe'){ //iframe 이면 실행안함
        if(!empty(Cookie::get($ckID)) && is_array(json_decode(Cookie::get($ckID))) == true){
            $getCookie = json_decode(Cookie::get($ckID));
            $getCookie[] = strtotime($DateTime);
            $arrValCnt = array_count_values($getCookie);
        
            $lastKey = array_key_last($arrValCnt);
            foreach($arrValCnt as $key => $val){    //key : 시간, val : 중복카운트
                    if($val > 2){   //초당 3회 이상 접속시도 시 카운트 +1
                        $arrCnt = $arrCnt + 1;
                    }
                    if(count($getCookie)> 15){  //쿠키 용량 제한으로 접속시도 중복 아닌 건은 삭제처리
                        if((int)$key < (int)$lastKey){
                            if($val < 3){
                                $cookieKey = array_search($key, $getCookie);
                                array_splice( $getCookie, $cookieKey, 1 );
                            }
                        }
                    }
                }
                Cookie::queue($ckID, json_encode($getCookie), 3);
        }else{
            Cookie::queue($ckID, $ipArrJson, 3);
           var_dump($ckID, Cookie::get($ckID));
        }
       
        }
        if($arrCnt > 2){
            // 블랙리스트 추가
            $req['desc'] = '3분동안 초당 3회 이상 접속시도를 5회 이상 시도';
            $req['msg'] = '디도스 블랙리스트 추가';
            BlackListController::blackListMailSend($req);       

            die(header("HTTP/1.1 404 Not Found"));
        }

        return $next($request);
    }
}
