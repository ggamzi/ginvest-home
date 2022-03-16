<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;

use App\Mail\Alert;

use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\BlackListController;

use DB;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = "/";

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }


    public function username() {
        // 로그인시 id 활용
        return 'account';
    }

    /**
     *  로그인
     *  2022-01-20 : 블랙리스트 조건 (5분동안 10회 이상 로그인 시도 -> 3분동안 10회 이상 로그인 시도)
     */
    public function login(Request $request){
        $ip = ip2long($_SERVER['REMOTE_ADDR']);

        // 블랙리스트면 404페이지 띄우고 차단
        $blacklist_chk = DB::table('black_list')->where('ip',$ip)->count();
        if ($blacklist_chk > 0) die(header("HTTP/1.1 404 Not Found"));

        // 10분안에 비밀번호 실패한 기록이 있을시 로그 생성시간 가져오기
        $history_chk = DB::table('log')
            ->where('ip',$ip)
            ->where('account',$request->input('account'))
            ->where('category','로그인')
            ->where('flag','N')
            ->where('msg','비밀번호가 틀립니다.')
            ->where(DB::raw("TIMESTAMPDIFF(MINUTE,created_at,now())"),"<=",10)
            ->orderby('created_at','desc')
            ->value('created_at');
        
        // 10분 안에 실패한 로그기록 생성시간으로 부터 -10분동안 5회 이상 로그인 시도가 있는 경우 error
        if($history_chk) {
            $pwd_chk_cnt = DB::table('log')
            ->where('ip',$ip)
            ->where('account',$request->input('account'))
            ->where('category','로그인')
            ->where('flag','N')
            ->where('msg','비밀번호가 틀립니다.')
            ->where(DB::raw("TIMESTAMPDIFF(MINUTE,created_at,'{$history_chk}')"),"<=",10)
            ->count();

            if($pwd_chk_cnt > 5){
                // 로그 기록
                DB::table('log')->insert([
                    'ip'=> $ip,
                    'account' => $request->input('account'),
                    'category' => '로그인',
                    'flag'=>'N',
                    'msg'=>'비밀번호 5회 이상 틀림',
                    'created_at' => now(),
                    'updated_at' => now()
                ]);
                return redirect()->back()->withInput($request->input())->with(['message'=>'5회 이상 비밀번호가 틀렸습니다. 잠시후에 다시 시도해 주세요.']);
            }
        }

        // 지금 시간으로부터 -3분동안 10번 이상 시도, 실패 기록이 있을 경우 블랙리스트 추가하여 차단
        // 2022-01-20 : 5분동안 10회 이상 시도 -> 3분동안 10회 이상 시도 변경
        $check = DB::table('log')->where('ip',$ip)->where('category','로그인')->where('flag','N')->where(DB::raw("TIMESTAMPDIFF(MINUTE,created_at,now())"),"<=",3)->count();
        if($check > 10){
            // 블랙리스트 추가
            // DB::table('black_list')->insert([
            //     'ip' => $ip,
            //     'account' => $request->input('account'),
            //     'desc' => '로그인 3분동안 10회 이상 시도',
            //     'created_at' => now(),
            //     'updated_at' => now()
            // ]);
            //  // 로그 기록
            // DB::table('log')->insert([
            //     'ip'=> $ip,
            //     'account' => $request->input('account',NULL),
            //     'category'=>'블랙리스트',
            //     'flag'=>'Y',
            //     'msg'=>'블랙리스트 추가',
            //     'created_at' => now(),
            //     'updated_at' => now()
            // ]);

            // // 관리자에게 메일 발송
            // $mail['ip'] = $ip;
            // Mail::send(new Alert($mail));
            $req['account'] = $request->input('account', NULL);
            $req['desc'] = '로그인 3분동안 10회 이상 시도';
            $req['msg'] = '블랙리스트 추가';
            BlackListController::blackListMailSend($req);   

            return redirect()->back()->with(['message'=>'죄송합니다. 로그인 시도횟수 초과로 인해 차단되었습니다.']);
        }

        // 허용된 IP가 아닐 경우 관리자로 로그인 불가능 (2022.02.07 추가)
        $rank_flag = DB::table('users')->where('account',$request->input('account'))->value('rank');
        if($rank_flag > 0) {
            $ip_string = ip2long($ip);
            $admin_flag = DB::table('acl')->where('ip',$ip)->count();

            if($admin_flag == 0) {
                $msg_admin_chk = '관리자로 접속할 수 없는 IP입니다.';

                // 로그 기록
                DB::table('log')->insert([
                    'ip' => $ip,
                    'account' => $request->input('account'),
                    'category' => '로그인',
                    'flag' => 'N',
                    'msg' => $msg_admin_chk,
                    'created_at' => now(),
                    'updated_at' => now()
                ]);
                return redirect()->back()->with(['message'=>$msg_admin_chk]);
            }
        }
        //////

        $loginInfo = $request -> only(['account', 'password']);
    
        //로그인 성공
        if(auth() -> attempt([ 'account' => request()->input('account'), 'password' => request()->input('password'), 'is_use' => 'Y' ])){
            //성공시 로그 저장 
            DB::table('log')->insert([
                'category' => '로그인',
                'flag' => 'Y',
                'account' => $request->input('account'),
                "ip" => ip2long($_SERVER['REMOTE_ADDR']),
                "msg" => "성공",
                'created_at' => now(),
                'updated_at' => now()
            ]);
            return redirect('/')->with(['message'=>'성공하였습니다.']);
        } else {
            // 아이디가 틀린 경우
            $chk_account = DB::table('users')->where('account',$request->input('account'))->first();
            if(!$chk_account) {
                $msg = "존재하지 않는 아이디 입니다.";
                $type = "account";
            }
            // 탈퇴한 아이디일경우
            else if($chk_account->is_use == 'L' || $chk_account->is_use == 'N'){
                $msg = "탈퇴한 아이디 입니다.";
                $type = "account";
            }
            // 블랙리스트 아이디일경우
            else if($chk_account->is_use == 'B'){
                $msg = "사용할 수 없는 아이디 입니다.";
                $type = "account";
            }
            // 비밀번호가 틀린 경우
            else if(!Hash::check($request->input('password'), $chk_account->password)){
                $msg = "비밀번호가 틀립니다.";
                $type = "password";
            }

            // 로그 저장 
            DB::table('log')->insert([
                'category' => '로그인',                     // 카테고리
                'flag' => 'N',                              // 실패
                'account' => $request->input('account'),    // 계정
                "ip" => ip2long($_SERVER['REMOTE_ADDR']),   // 시도 ip
                "msg" => $msg,                              // 로그 내용
                'created_at' => now(),                      // 생성일 (기본)
                'updated_at' => now()                       // 수정일 (기본)
            ]);
            
            // 비밀번호 틀린 횟수 출력
            if($type == "password" && isset($history_chk)) $msg = $msg.' ('.$pwd_chk_cnt.'/5회 시도)';

            return redirect()->back()->withInput($request->input())->withErrors([ $type => $msg ]);
        }
    }


}
