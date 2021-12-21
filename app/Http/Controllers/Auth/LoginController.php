<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Hash;

use DB;

use Illuminate\Support\Facades\Auth;

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

    public function login(Request $request){
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
            return redirect('/');
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
            // 비밀번호가 틀린 경우
            else if(!Hash::check($request->input('password'), $chk_account->password)){
                $msg = "비밀번호가 틀립니다.";
                $type = "password";
            }

            // 로그 저장 
            DB::table('log')->insert([
                'category' => '로그인',
                'flag' => 'N',
                'account' => $request->input('account'),
                "ip" => ip2long($_SERVER['REMOTE_ADDR']),
                "msg" => $msg,
                'created_at' => now(),
                'updated_at' => now()
            ]);
            return redirect()->back()->withInput($request->input())->withErrors([ $type => $msg ]);
        }
    }


}
