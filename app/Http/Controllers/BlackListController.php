<?php

namespace App\Http\Controllers;

use App\Mail\Alert;
use App\Models\Popup;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Cookie;
use DB;
use Auth;
use Session;
use Illuminate\Support\Facades\Mail;

class BlackListController extends Controller
{
    /**
     *  메인 페이지
     */
    public function mainIndex(Request $request) {
        // IP 주소 불러옴
        $ip = ip2long($_SERVER['REMOTE_ADDR']);
        $ckID = $ip.'6';
        $data['m_title'] = '회사소개';
        $data['s_title'] = '미션과 비전';
        $DateTime = date('Y-m-d h:i:s', time());  
        $data['dateTime'] = $DateTime;
        $data['ip'] = $ip;

        $ipArr[] = strtotime($DateTime);
        $ipArrJson = json_encode($ipArr);
        $arrCnt = 0;
        $arrValCnt = [];

        if(!empty(Cookie::get($ckID)) && is_array(json_decode(Cookie::get($ckID))) == true){

            $getCookie = json_decode(Cookie::get($ckID));
            $getCookie[] = strtotime($DateTime);
            $CookieArrJson = json_encode($getCookie);
            
            Cookie::queue($ckID, $CookieArrJson, 2);
            $arrValCnt = array_count_values(json_decode(Cookie::get($ckID)));
            $lastKey = array_key_last($arrValCnt);
            // $getCookie = json_decode(Cookie::get($ckID));
            foreach($arrValCnt as $key => $val){
                    if($val > 2){
                        $arrCnt = $arrCnt + 1;
                    }
                    if(count($getCookie)> 15){
                      
                        if((int)$key < (int)$lastKey){
                            if($val < 3){
                                $cookieKey = array_search($key, $getCookie);
                                array_splice( $getCookie, $cookieKey, 1 );
                            }
                        }
                    }
                }
                Cookie::queue($ckID, json_encode($getCookie), 2);
        }else{
            Cookie::queue($ckID, $ipArrJson, 2);
        }

        // Cookie::queue(Cookie::forget($ip));
        // if(!empty(Cookie::get($ckID)) && is_array(json_decode(Cookie::get($ckID))) == true){
        //     var_dump(Cookie::get($ckID));
        // }else{
        //     return '2';
        // }
        // var_dump($ckID, Cookie::get($ckID));
        var_dump($arrValCnt);
        // return view('visit/visit_chk',$data);

    }
    /**
     *  블랙리스트 등록 및 메일전송
     *  account : 유저 아이디   $req['account'] = 'test';
     *  desc : 블랙리스트 등록 사유 (black_list)    $req['desc'] = '3분동안 초당 3회 이상 접속시도를 5회 이상 시도';
     *  msg : 로그 메시지 (log)     $req['msg'] = '디도스 블랙리스트 추가';
     */
    public function blackListMailSend($req) {
        $ip = ip2long($_SERVER['REMOTE_ADDR']);
        if(empty($req['account'])){
            $req['account'] = null;
        }
        if(empty($req['desc'])){
            $req['desc'] = null;
        }
        if(empty($req['msg'])){
            $req['msg'] = null;
        }
        // 블랙리스트 추가
        DB::table('black_list') -> insert([
            'ip' => $ip,
            'account' => $req['account'], 
            'desc' => $req['desc'],
            'created_at' => now(),
            'updated_at' => now()
        ]);
        // 로그 기록
        DB::table('log') -> insert([
            'ip' => $ip,
            'account' => $req['account'], 
            'category' => '블랙리스트',
            'flag' => 'Y',
            'msg' => $req['msg'], 
            'created_at' => now(),
            'updated_at' => now()
        ]);

        // 관리자에게 메일 발송
        $mail['ip'] = $ip;
        Mail::send(new Alert($mail));

    }

}