<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\ExperUser;
use App\Models\Log;
use DB;
use Auth;
use App\Mail\AmazonSes;

use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\View;

class UserController extends Controller
{
    /**
     *  ID, 닉네임 중복 검사
     *  @param string $type : account, nickname, email(정보수정)
     *  @param string $val  : value
     *  @param string $method   : create (회원가입), update(회원정보 수정일 때)
     */
    public function dupChk(Request $request) {
        $type = $request->input("type");
        $value = $request->input("val");

        switch ($type) {
            case 'account':
                $value_len = mb_strlen($value, "UTF-8");
                // 글자수
                if($value_len < 5 || $value_len > 20) { $msg = "아이디를 5자리 ~ 20자리 이내로 입력해주세요."; break; }
                // 영문, 숫자만 가능
                if (!preg_match ('/^[a-z0-9]+$/', $value)) { $msg = "아이디는 영문(소문자)+숫자만 입력 가능 합니다."; break; }
                $type_name = "아이디";
                break;
            case 'nickname':
                $type_name = "닉네임";
                break;
            case 'email':
                if (!preg_match("/^[_\.0-9a-zA-Z-]+@([0-9a-zA-Z][0-9a-zA-Z-]+\.)+[a-zA-Z]{2,6}$/i", $value))  { $msg = "이메일 형식을 확인해 주세요."; break; }
                $type_name = "이메일";
                break;
        }

        // valid 실패시
        if(isset($msg)) return response(["status"=>"error","msg"=>$msg],200);

        $query = User::where($type,$value);

        // 마이페이지에서 정보 수정시 현재 자신의 동일한 정보를 입력한 경우는 제외
        if($request->input('method')=='update') $query->where($type,'=',$value)->where($type,'!=',auth()->user()->email );

        $res = $query->count();
        if($res > 0)  return response(["status"=>"error","msg"=>"사용중인 {$type_name}입니다. 다시 입력해 주세요."],200);

        return response(["status"=>"ok"],200);
    }
    
    /**
     *  회원삭제 (탈퇴신청)
     */
    public function delete(Request $request){
        $id=$request->input('id');

        // 로그 남기기
        Log::create([
            "category" => "회원탈퇴",
            "flag" => "Y",
            "ip" => ip2long($_SERVER['REMOTE_ADDR']),
            "account" => auth()->user()->account,
            "msg" => "성공"
        ]);
        
        // 계정 잠금 (is_use -> L)
        User::whereId($id)->update([ 'is_use' => 'L' ]);
        
        // 로그아웃
        auth()->logout();

        return redirect('/')->with(['message'=>'탈퇴 되었습니다.']);
    }

    /**
     *  마이페이지 -> 정보수정
     *  @param string $password     : 변경될 패스워드
     *  @param string $cur_password : 현재 패스워드
     *  @param string $name         : 이름
     *  @param string $email        : 이메일
     *  @param string $hp1,$hp2,$hp3     : 핸드폰번호
     */
    public function mypageUpdate(Request $request) {
        $validator = validator(request()->all(), [
            'cur_password' => 'required',
            'email' => 'required|email',
            'name' => 'required',
        ], [
            'required' => '필수항목을 모두 입력해 주세요.',
            'email.email' => '이메일을 형식을 확인해 주세요',
        ]);

        if ($validator->fails())
            return redirect()->back()->withInput($request->input())->withErrors($validator->errors());

        $id = $request->input('id');

        $cur_password = User::where('id',$id)->value('password');      //현재암호

        // 입력한 현재 암호 check
        if(!Hash::check($request->input('cur_password'), $cur_password)) return redirect()->back()->withInput($request->input())->withErrors(['cur_password'=>'입력한 비밀번호가 일치하지 않습니다.']);
        
        $input['phone'] = $request->input('hp1').$request->input('hp2').$request->input('hp3');
        $input['name'] = $request->input('name');
        $input['email'] = $request->input('email');

        
        // 변경되는 정보 로그 남기기고 쿼리 작성
        $info = User::select('name','email','phone')->where('id',$id)->first()->toArray();
      

        // 입력된 정보와 현재 DB값이 다르면(수정된 컬럼) 로그 기록. 암호는 따로 체크
        $log_msg = array();
        foreach ($info as $key => $row) {
            if($row != $input[$key]) array_push($log_msg, "{$key} [{$row} -> {$input[$key]}]" );
        }
        if ($request->input('password') != NULL && !Hash::check($request->input('password'), $cur_password)) {
            array_push($log_msg, "password [*** -> ***]" );
            $input['password'] = Hash::make($request->input('password'));
        }
        
        // 변경된 내용이 없을 때
        if(empty($log_msg))
            return redirect()->back()->withInput($request->input())->withErrors("변경된 내용이 없습니다.");
        // 정보 수정
        User::where('id',$id)->update($input);
        // 로그 남기기
        Log::create([
            "category" => "회원정보수정",
            "flag" => "Y",
            "ip" => ip2long($_SERVER['REMOTE_ADDR']),
            "account" => auth()->user()->account,
            "msg" => implode("$$$",$log_msg)
        ]); 

        return redirect()->back()->with(['message'=>'성공하였습니다.']);
    }

    /**
     *  회원가입
     *  @param string $account  : 아이디
     *  @param string $nickname : 별명
     *  @param string $password : 비밀번호
     *  @param string $name     : 이름
     *  @param string $email    : 메일
     *  @param int $hp1,$hp2,$hp3   : 핸드폰번호
     */
    public function create(Request $request)
    {
        $validator = validator(request()->all(), [
            'email' => 'required|email|unique:users',
            'account' => 'required|unique:users',
            'nickname' => 'required|unique:users',
            'password' => 'required',
            'password_chk' => 'required',
            'name' => 'required',
        ], [
            'required' => '필수항목을 모두 입력해 주세요.',
            'email.email' => '이메일을 형식을 확인해 주세요',
            'email.unique' => '중복되는 이메일 입니다.',
            'account.unique' => '중복되는 아이디 입니다.',
            'nickname.unique' => '중복되는 별명 입니다.'
        ]);

        if ($validator->fails())
            return redirect()->back()->withInput($request->input())->withErrors($validator->errors());

        // 번호를 입력한 경우
        if(!empty($request->has('hp1')) && !empty($request->input('hp2')) && !empty($request->has('hp3'))){
            $phone = $request->input('hp1').$request->input('hp2').$request->input('hp3');
        } else {
            $phone = null;
        }
        
        User::create([
            'nickname' => $request->input('nickname'),
            'account' => $request->input('account'),
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
            'phone' => $phone
        ]);

        // 로그 남기기
        Log::create([ 'ip'=> ip2long($_SERVER['REMOTE_ADDR']),'account'=>$request->input('account'), 'category'=>'회원가입', 'flag'=>'Y', 'msg'=>'성공' ]);   // 로그 기록
        
        return redirect('/login')->with(['message'=>'성공하였습니다.']);
    }


    /**
     *  아이디 찾기
     *  @param string $email    : 이메일
     */
    public function searchAccount(Request $request) {
        $email = $request->input('email');

        $res = User::where('email',$email)->first();
        
        if(!$res) return redirect()->back()->withInput($request->input())->withErrors("조건에 맞는 아이디가 존재하지 않습니다.");

        return redirect()->back()->withInput($request->input())->with(['account'=>$res->account]);
    }

    /**
     *  아이디 찾기
     *  @param string $email    : 이메일
     *  @param string $account    : 아이디
     */
    public function searchPwd(Request $request) {
        $validator = validator(request()->all(), [
            'email' => 'required|email',
            'account' => 'required'
        ], [
            'required' => '필수항목을 모두 입력해 주세요.',
            'email' => '이메일 형식을 확인해 주세요.',
        ]);

        if ($validator->fails())
            return redirect()->back()->withInput($request->input())->withErrors($validator->errors());

        $email = $request->input('email');
        $account = $request->input('account');

        $res = User::where('email',$email)->where('account',$account)->first();
        
        if(!$res) return redirect()->back()->withInput($request->input())->withErrors("조건에 맞는 아이디가 존재하지 않습니다.");

        //랜덤 비밀번호 생성
        $str = 'abcdefghijklmnopqrstuvwxyz0123456789!@#$%&*ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $max = strlen($str) - 1;
        $pwd_chr = '';
        $len = 12;
        for($i=0; $i<$len; $i++) {
            $pwd_chr .= $str[random_int(0, $max)];
        }

        // 생성한 비밀번호로 update
        User::whereId($res->id)->update(['password'=>Hash::make($pwd_chr)]);

        // 로그 남기기
        Log::create([ 'ip'=> ip2long($_SERVER['REMOTE_ADDR']), 'category'=>'비밀번호찾기', 'flag'=>'Y', 'msg'=>'성공', 'account'=>$account ]);   // 로그 기록
        // 변경된 비밀번호 메일 보내기
        Mail::to($email)->send(new AmazonSes($pwd_chr));
        return redirect()->back()->withInput($request->input())->with(['pwd'=>'입력하신 이메일로 임시 비밀번호를 발급해 드렸습니다. 이메일을 확인해 주세요.']);
    }


      ////////////////////
     //  관리자 페이지  //
    ////////////////////
    /**
     *  회원관리
     */
    public function userIndex(Request $request) {
        $query = User::orderby("created_at","desc")->where('rank','0');

        // 검색시
        if($request->has('value') && !empty($request->input('value'))){
            $data = $request->only(['value','type']);
            // ip검색시 string으로
            $value = in_array($data['type'],['email']) ? $data['value'].'%' : $data['value'];

            $query->where($data['type'],'like',$value);
        }

        // 상태별 검색
        if($request->has('status') && !empty($request->input('status'))){
            $data['status'] = $request->input('status');

            $query->where('is_use',$data['status']);
        }

        $data['users'] = $query->paginate(20)->appends($request->query());
        return view('adm/user_index', $data);
    }

    /**
     *  회원별 Log 확인 (ajax & DataTable)
     *  @param string $account  : 회원 계정
     */
    public function getLog(Request $request) {
        $account = $request->input('account');
        $data = Log::select('id','category','msg',DB::raw('INET_NTOA(ip) as ip'),'created_at')->where('account',$account)
            ->orderby('created_at','desc')->get();
        return response()->json(['status'=>"success", "data"=>$data],200);
    }

    /**
     *  회원별 정보 모달 (ajax)
     *  @param string $account  : 회원 계정
     */
    public function getUserInfo(Request $request) {
        $id = $request->input('id');
        $data = User::whereId($id)->first();
        return response()->json(['status'=>"success", "data"=>$data],200);
    }

    /**
     *  회원정보 수정
     */
    public function userUpdate(Request $request) {
        $data = $request->all();
        
        $id = $data['id'];
        $input['is_use'] = $data['is_use'];
        $input['phone'] = $data['phone'] != NULL ? str_replace("-","",$data['phone']) : NULL;
        $input['email'] = $data['email'];
        if(!empty($data['password'])) {
            $input['password'] = Hash::make($data['password']);
        }
        
        User::whereId($id)->update($input);

        return redirect()->back()->with(['message'=>'성공하였습니다.']);
    }

    /**
     *  회원 탈퇴처리 (정확히는 탈퇴한 회원들의 개인정보 삭제임. 아이디는 삭제 x)
     */
    public function userDelete(Request $request) {
        $id = $request->input('id');
        
        User::whereId($id)->update([
            'name' => null,
            'nickname' => null,
            'is_use' => 'N',
            'phone' => null,
            'email' => null,
        ]);

        return redirect()->back()->with(['message'=>'탈퇴처리 되었습니다.']);
    }

    ///////////////////////////////////////////////////
    /**
     *  체험회원
     */
    public function experienceIndex(Request $request) {
        
        $query = ExperUser::orderby('created_at','desc');
        // 검색시
        if($request->has('value') && !empty($request->input('value'))){
            $data = $request->all();
            // ip검색시 string으로
            $value = $data['type'] == 'ip' ? ip2long($data['value']) : $data['value'];
            
            $query->where($data['type'],$value);
        }

        $data['list'] = $query->paginate(20)->appends($request->query());
        return view('adm/user/experience', $data);
    }
    
    /**
     *  체험회원 삭제
     */
    public function experienceDelete(Request $request) {
        $id = $request->input('id');
        Experuser::whereId($id)->delete();

        return redirect()->back()->with(['message'=>'삭제되었습니다.']);
    }

    /**
     *  관리자 계정 관리
     */
    public function memberIndex(Request $request) {
        $query = User::orderby("created_at","desc")->where('rank','>','0');

        // 검색시
        if($request->has('value') && !empty($request->input('value'))){
            $data = $request->only(['value','type']);
            // ip검색시 string으로
            $value = in_array($data['type'],['email']) ? $data['value'].'%' : $data['value'];

            $query->where($data['type'],'like',$value);
        }

        // 상태별 검색
        if($request->has('status') && !empty($request->input('status'))){
            $data['status'] = $request->input('status');

            $query->where('is_use',$data['status']);
        }

        $data['users'] = $query->paginate(20)->appends($request->query());
        return view('adm/member_index', $data);
    }

}
