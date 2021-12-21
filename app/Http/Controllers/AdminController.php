<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
use App\Models\sidebarSub;
use App\Models\board;
use App\Models\Popup;
use App\Models\ExperUser;
use App\Models\User;
use App\Models\Acl;
use App\Models\Log;
use Mews\Purifier\Purifier;
use Auth;
use DB;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    /**
     *  어드민 로그인 페이지
     */
    public function loginIndex(Request $request) {
        // 로그인 되어 있다면 메인 페이지로 이동
        if(auth()->check()) return redirect('/admin');
        
        return view('adm/admin_login');
    }

    /**
     *  관리자 페이지 로그인
     */
    public function login(Request $request) {
        // 로그인 성공시
        if( auth()->attempt([ 'account' => request()->input('account'), 'password' => request()->input('password'), 'rank' => 1 ])) {
            //성공시 로그 저장 
            DB::table('log')->insert([
                'category' => '관리자로그인',
                'flag' => 'Y',
                'account' => $request->input('account'),
                "ip" => ip2long($_SERVER['REMOTE_ADDR']),
                "msg" => "성공",
                'created_at' => now(),
                'updated_at' => now()
            ]);
            return redirect('/admin');
        } else {
            // 아이디가 틀린 경우
            $chk_account = DB::table('users')->where('account',$request->input('account'))->first();
            if(!$chk_account) {
                $msg = "존재하지 않는 아이디 입니다.";
                $type = "account";
            }
            else if($chk_account->rank == 0) {
                $msg = "관리자용 아이디가 아닙니다.";
                $type = "account";
            }
            // 잠겨있거나 미사용 처리된 아이디일 경우
            else if($chk_account->is_use == 'L' || $chk_account->is_use == 'N'){
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
                'category' => '관리자로그인',
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

    /**
     *  로그아웃auth()->check()
     */
    public function logout(Request $request) {
        auth()->logout();
        return redirect('admin/login');
    }

    /**
     *  관리자 페이지 대시보드
     */
    public function adminIndex(Request $request) {

        $today = date("Y-m-d H:i:s");   // 현재시간
        $minus = date("Y-m-d H:i:s",strtotime('-1 week'));   // 1주일동안의 데이터
        // 오늘 체험 신청
        $data['today_exper'] = ExperUser::where('created_at','<',date("Y-m-d",strtotime('+1 day')))->where('created_at','>',date("Y-m-d"))->count();
        // 오늘 기준 신규 게시글
        $data['today_post'] = board::where('created_at','<',date("Y-m-d",strtotime('+1 day')))->where('created_at','>',date("Y-m-d"))->where('is_view','C')->count();
        // 오늘 기준 가입한 회원
        $data['today_user'] = User::where('created_at','<',date("Y-m-d",strtotime('+1 day')))->where('created_at','>',date("Y-m-d"))->count();
        // 오늘 방문자
        $data['today_visitor'] = DB::table('visitors')->where('date',date("Y-m-d"))->value('count');
        /////////

        // 체험회원 리스트
        $data['experience'] = ExperUser::where('created_at','<',$today)->where('created_at','>',$minus)->orderby('created_at','desc')->get();
        // 게시글 리스트
        $data['post'] = board::select('board.*','sidebar_sub.name as s_name')->leftJoin('sidebar_sub','board.board_id','=','sidebar_sub.id')->where('is_view','C')->orderby('board.create_date','desc')->get();
        // 로그 리스트
        $data['log'] = Log::orderby('created_at','desc')->where('created_at','<',$today)->where('created_at','>',$minus)->get();
        // 게시판 리스트
        $data['board'] = sidebarSub::get();
        // 일별 방문자 리스트
        $visitor_query = DB::table('visitors')->select('date','count')->orderby('date','desc')->limit(7);
        $data['visitor'] = DB::table(DB::raw("({$visitor_query->tosql()}) as visitors"))
                    ->mergeBindings($visitor_query)
                    ->orderby('date','asc')->get();
        
        
        //return dd($data);

        return view('adm/admin_index', $data);
    }

    /**
     *  대시보드에서 필요한 모달 데이터
     *  @param string $table    : 테이블명
     *  @param int $id          : row ID (게시글 불러올 때 사용)
     *  @param string $date     : 방문자 조회시 사용 (daterangepicker 'Y-m-d ~ Y-m-d')
     */
    public function adminGetInfo(Request $request) {
        $table = $request->input('table');
        
        // 신규 게시글 불러올시
        if($table == 'board'){
            $id = $request->input('id');
            $data = DB::table($table)->whereId($id)->first();    
        }
        // 방문자수 불러올시
        if($table == 'visitors'){
            $date = explode(" ~ ",$request->input('date'));
            $start_date = $date[0]; // 조회 시작일
            $end_date = date("Y-m-d",strtotime("{$date[1]} +1day"));    // 조회 마지막 일

            $data = DB::table($table)->where('date','<',$end_date)->where('date','>=',$start_date)->orderby('date','asc')->get();
        }
        
        return response()->json(["status"=>"success", "data"=>$data],200);
    }
    /**
     *  대시보드에서 신규 게시물 승인처리
     *  @param int $id  : 게시물 id
     */
    public function adminPostAgree(Request $request) {
        $id = $request->input('id');
        // 승인이 필요한 신규 게시물은 is_view = 'C'
        DB::table('board')->whereId($id)->update([ 'is_view' => 'Y']);

        return redirect()->back()->with('message','승인되었습니다.');    
    }

    /**
     * 메뉴 상단 알림창
     */
    public function getNewEvent(Request $request) {
        $data['post'] = DB::table('board')->where('is_view', 'C')->count();

        return response()->json(["status"=>"success", "data" => $data ],200);
    }

    //////////////////////////////////////////////////////////////////////
    

    /**
     *  게시글 관리
     *  @param int $board_id    : 게시판 id값
     *  @param boolen $new_post : 새로운 게시글만 확인
     */
    public function bbsManage(request $request){
        // 게시판 목록
        $data['board_list'] = sidebarSub::where('is_board','Y')->get();

        // 게시글 가져올 DB
        $query = DB::table('board');

        // 검색
        if(!empty($request->input('board_id'))) {
            $board_id = $request->input('board_id');
            $query->where('board_id',$board_id);
            $data['board_id'] = $board_id;

            // 선택된 게시판 폼
            $data['select_board'] = sidebarSub::where('id',$board_id)->first();
        }
        // 새로운 게시글만 확인
        if(!empty($request->input('new_post') && $request->input('new_post') == 'Y')) {
            $new_post = $request->input('new_post');
            $query->where('is_view','C');
            $data['new_post'] = 'Y';
        }
        // 게시글 목록
        $data['post_list'] = DB::table(DB::raw("({$query->tosql()}) as board"))
            ->mergeBindings($query)
            ->select('board.*','sidebar_sub.name as board_name','sidebar_sub.title as s_title','users.nickname')
            ->leftJoin('sidebar_sub','board.board_id','sidebar_sub.id')
            ->leftJoin('users','board.user_id','users.id')
            ->orderBy('board.id','desc')
            ->paginate(20)
            ->appends($request->query());
      
        return view('adm/bbs_manage', $data);
    }
        
    /**
     *  게시글 생성 페이지
     */
    public function postWrite(Request $request) {
        // 게시판 목록
        $data['board_list'] = sidebarSub::where('is_board','Y')->get();

        
        if($request->has('prev_url')){
            $data['prev_url'] = $request->input('prev_url');
        } else {
            $data['prev_url'] = URL::previous();
        }

        // 게시판 선택시
        if($request->has('board_id')){
            $board_id = $request->input('board_id');
            $data['select_board'] = sidebarSub::where('id',$board_id)->first();
            $data['board_id'] = $board_id;
        }   
        
        return view('adm/bbs_post_write', $data);
    }

    /**
     *  게시글 수정 페이지
     *  @param int $id    : 게시물 id값
     */
    public function postEdit(Request $request, $id) {

        $data['post_info'] = board::select('board.*','sidebar_sub.title as board_title','sidebar_sub.use_thumb','sidebar_sub.option_key','sidebar_sub.use_notice')
        ->where('board.id',$id)->leftJoin('sidebar_sub','board.board_id','=','sidebar_sub.id')->first();

        return view('adm/bbs_post_edit', $data);
    }

    /**
     *  게시글 수정 쿼리
     */
    public function postUpdate(Request $request) {
        //return dd($request->all());
        $id = $request->input('id');

        $board_name = $request->input('board_name');
        $prev_thumb = $request->input('prev_thumb');

        // purifer filter 적용한 게시물 내용
        $input_content = \Purifier::clean($request->input('content'), function (HTMLPurifier_Config $config) {
            $config->set('HTML.AllowedElements','div[style]');  // div -> style tag 허용
        });
        

        // 게시글 내용에서 이미지명 추출하여 저장.
        $imgArr = array();
        preg_match_all("/<img[^>]*src=[\"']?([^>\"']+)[\"']?[^>]*>/i", $input_content, $match);
        foreach ($match[1] as $row) {
            $img_name = explode("/",$row);
            $img_name = end($img_name);
            if(file_exists("se2/upload_temp/".$img_name)){
                // temp 디렉토리에 파일이 있을 경우 temp->img 경로 변경
                rename ("se2/upload_temp/".$img_name, "se2/upload_img/".$img_name);
            }
        }
        // 실제 게시판 내용에서도 경로 변경 후 저장
        $content = str_replace ("/upload_temp/", "/upload_img/", $input_content);

        // 썸네일 있을 경우
        if($request->hasFile('thumbnail')){

            $file_path = $board_name."/".$prev_thumb;

            if(file_exists($file_path) && $prev_thumb != null) unlink($file_path);  // 기존 이미지 삭제

            $imageName = time().'.'.$request->thumbnail->extension();  
            $request->thumbnail->move(public_path($board_name), $imageName);
            $path = $imageName; // DB에 입력될 파일명
        } else {
            $path = $prev_thumb;
        }

        $option = $request->has('option_value') ? implode('$$$', $request->input('option_value')) : null;

        $is_view = $request->input('is_view') == 'on' ? 'Y' : 'N';

        board::whereId($id)->update([
            'title' => $request->input('title'),
            'view_count' => $request->input('view_count'),
            'create_date' => $request->input('create_date'),
            'nickname' => $request->input('nickname'),
            'thumbnail' => $path,
            'option' => $option,
            'is_view' => $is_view,
            'content' => $content,
            'notice' => $request->input('notice','N'),
        ]);
        // return redirect($request->input('prev_url'))->with('message','수정되었습니다.');        
        return redirect()->back()->with(['message'=>'수정되었습니다.','prev_url'=>$request->input('prev_url')]);        
    }

    /**
     *  게시글 삭제
     */
    public function postDelete(Request $request) {

        $id = $request->input('id');
        
        // 배열이 아니면 배열로 만들어줌
        $idArr = explode(',',$id);

        $res = board::select('board.*','sidebar_sub.title as path')->whereIn('board.id',$idArr)->leftJoin('sidebar_sub','board.board_id','=','sidebar_sub.id')->get();
        foreach ($res as $row) {

            // 게시글의 이미지도 삭제
            $imgArr = array();
            // 이미지 이름 추출
            preg_match_all("/<img[^>]*src=[\"']?([^>\"']+)[\"']?[^>]*>/i", $row->content, $match);
            foreach ($match[1] as $row_match) {
                $img_name = explode("/",$row_match);
                $img_name = end($img_name);
                if(file_exists("se2/upload_img/".$img_name)) unlink ("se2/upload_img/".$img_name);
            }

            // 썸네일이 있는 경우 삭제
            if($row->thumbnail != NULL || $row->thumbnail != ""){
                $file_path = $row->path."/".$row->thumbnail;
                if(file_exists($file_path)) unlink($file_path);  // 기존 이미지 삭제
            }
            board::whereId($row->id)->delete();
        }
        return redirect()->back()->with('message','삭제되었습니다.');
    }

    /**
     *  게시글 썸네일 삭제
     *  @param int $id          : 게시글 id
     *  @param string $thumb    : 썸네일 경로
     */
    public function postThumbDelete(Request $request) {

        $id = $request->input('id');
        $thumb = $request->input('thumb');
        // 썸네일 파일 존재하면 삭제 후 DB에 업데이트
        if(file_exists($thumb)) unlink($thumb);
        $res = board::whereId($id)->update(['thumbnail'=>null]);

        return response()->json(['status'=>"success"],200);
    }

    /**
     *  게시글 생성페이지 (본사페이지에서 고객이 작성시)
     *  현재는 고객감사후기 (review) 페이지에서만 작성하도록 되어 있음
     */
    public function bbsWirteForm(request $request, $board){

        $data['board_info'] = sidebarSub::where("title",$board)->where("is_board","Y")->first();

        if(!isset($data['board_info']) || !in_array($board,['review'])) return redirect()->back()->with('msg', '존재하지 않는 게시판입니다.');

        return view('/bbs/bbs_write',$data);
    }

    /**
     *  게시글 생성
     *  @param int $board_id        : 게시판 id
     *  @param string $board_name   : 게시판 title (이미지 업로드시 경로에 추가해야함)
     *  @param int $user_id         : 작성자 id
     *  @param int $view_count      : 조회수
     *  @param date $create_date    : 작성일
     *  @param string $nickname     : 작성자 별명
     *  @param string $title        : 게시글 제목
     *  @param string $content      : 게시글 내용
     *  @param string $thumbnail    : 썸네일 업로드시 파일명
     *  @param arrray $option_value : 게시판별로 추가되는 내용들. 
     *  @param ENUM $notice         : 공지사항 
     */
    public function postCreate(Request $request) {
        $board_id = $request->input('board_id');
        $board_name = $request->input('board_name');
        $user_id = $request->input('user_id');
        $view_count = $request->input('view_count',0);
        $create_date = $request->input('create_date', date("Y-m-d H:i:s"));
        $nickname = $request->input('nickname');
        $title = $request->input('title');

        // purifer filter 적용한 게시물 내용
        $input_content = \Purifier::clean($request->input('content'), function (HTMLPurifier_Config $config) {
            $config->set('HTML.AllowedElements','div[style]');  // div -> style tag 허용
        });

        $user_rank = User::whereId($user_id)->value('rank');

        // 회원이 작성한 경우 승인이 필요함
        if($user_rank == 0){
            $is_view = "C";
        } else {
            $is_view = $request->input('is_view','Y') == 'Y' ? 'Y' : 'N';
        }

        // 게시글 내용에서 이미지 추출하여 저장.
        // smarteditor 에서 사진 첨부시 'se2/upload_temp'에 저장이 됨.
        $imgArr = array();
        preg_match_all("/<img[^>]*src=[\"']?([^>\"']+)[\"']?[^>]*>/i", $input_content, $match);
        foreach ($match[1] as $row) {
            $img_name = explode("/",$row);
            $img_name = end($img_name);
            if(file_exists("se2/upload_temp/".$img_name)){
                // 파일이 있을 경우 temp 에서 경로 변경
                rename ("se2/upload_temp/".$img_name, "se2/upload_img/".$img_name);
            }
        }
        // 실제 게시글 내용에서도 경로 변경 후 저장
        $content = str_replace ("/upload_temp/", "/upload_img/", $input_content);

        // 썸네일 있을 경우
        if($request->hasFile('thumbnail')){
            $imageName = time().'.'.$request->thumbnail->extension();  
            $request->thumbnail->move(public_path($board_name), $imageName);
            $path = $imageName; // DB에 입력될 파일명
        } else {
            $path = null;
        }

        // 옵션 사용시
        $option = $request->has('option_value') ? implode('$$$', $request->input('option_value')) : null;
        
        board::create([
            'board_id' => $board_id,
            'user_id' => $user_id,
            'view_count' => $view_count,
            'nickname' => $nickname,
            'title' => $title,
            'content' => $content,
            'create_date' => $create_date,
            'thumbnail' => $path,
            'option' => $option,
            'is_view' => $is_view,
            'notice' => $request->input('notice','N')
        ]);

         // 로그 남기기
         Log::create([
            "category" => "게시글작성",
            "flag" => "Y",
            "ip" => ip2long($_SERVER['REMOTE_ADDR']),
            "account" => auth()->user()->account,
            "msg" => $board_name."_성공"
        ]);

        return redirect()->back()->with('message','생성되었습니다.');
    }

    /**
     *  게시판 관리
     */
    public function boardIndex(Request $request) {
        $data['list'] = SidebarSub::select('sidebar_sub.*','sidebar_main.name as main_name')->leftJoin('sidebar_main','sidebar_sub.main_title','=','sidebar_main.id')->get();
        return view('adm/board_index', $data);
    }
    
    /**
     * 게시판 정보 모달(ajax)
     */
    public function boardInfo(Request $request) {
        $id = $request->input('id');
        $data = sidebarSub::select('sidebar_sub.*','sidebar_main.name as main_name')->leftJoin('sidebar_main','sidebar_sub.main_title','=','sidebar_main.id')->where('sidebar_sub.id',$id)->first();

        return response()->json(['status'=>"success", "data"=>$data],200);
    }

    /**
     *  게시판 정보 수정
     */
    public function boardUpdate(Request $request) {
        $id = $request->input('id');       
        
        DB::table('sidebar_sub')->where('id',$id)->update([
            'name' => $request->input('name'),
            'desc' => $request->input('desc'),
            'paginate' => $request->input('paginate'),
            'is_use' => $request->input('is_use','N'),
            'use_thumb' => $request->input('use_thumb','N'),
            'use_apply' => $request->input('use_apply','N'),
            'use_notice' => $request->input('use_notice','N'),
        ]);

        return redirect()->back()->with('message','수정되었습니다.');
    }


      /////////////////////
     //  기본 정보 관리  //
    /////////////////////

    /**
     * 기본정보 설정
     */
    public function infoIndex(Request $request) {
        $title = $request->input('title','terms_use');

        $data['title'] = $title;

        $data['info'] = DB::table('company_info')->where('title', $title)->first();

        return view('adm/info_index', $data);
    }

    /**
     * 기본정보 모달
     */
    public function infoUpdate(Request $request) {
        $title = $request->input('title');
        $content = $request->input('content');

        DB::table('company_info')->where('title',$title)->update(['content'=>$content]);

        return redirect()->back()->with('message','수정되었습니다.');
    }

    /**
     *  팝업관리
     */
    public function popupIndex(Request $request) {
        $data['pop_list'] = Popup::orderby('order_id','asc')->get();
        
        return view('adm/popup_index',$data);
    }

    /**
     *  팝업 modal (ajax)
     */
    public function popupInfo(Request $request) {
        $id = $request->input('id');
        $data = Popup::whereId($id)->first();
        
        return response()->json(['status'=>"success", "data"=>$data],200);
    }

    /**
     *  팝업 생성
     */
    public function popupStore(Request $request) {
       // 팝업이미지 있을 경우
       if($request->has('img')){
            $imageName = time().'.'.$request->img->extension();  
            $request->img->move(public_path('popup'), $imageName);
            $img = $imageName; // DB에 입력될 파일명
        } else {
            $img = null;
        }

        Popup::create([
            'desc' => $request->input('desc',null),
            'img' => $img,
            'link' => $request->input('link',null),
            'start_date' => $request->input('start_date',null),
            'end_date' => $request->input('end_date',null),
            'width' => $request->input('width'),
            'height' => $request->input('height'),
            'left' => $request->input('left'),
            'top' => $request->input('top'),
        ]);

        return redirect()->back()->with('message','생성되었습니다.');
    }

    public function popupOrderUpdate(Request $request) {
        $popup_list = $request->input('popup_list');
        foreach ($popup_list as $key => $value) {
            Popup::whereId($value)->update(['order_id' => $key+1]);
        }
        return redirect()->back()->with('message','수정되었습니다.');
    }

    /**
     *  팝업 업데이트
     */
    public function popupUpdate(Request $request) {
        $id = $request->input('id');

        //팝업이미지 있을 경우
        if($request->has('img') || $request->input('img') != ""){
            unlink("popup/".$request->input('img_name'));  // 기존 이미지 삭제

            $imageName = time().'.'.$request->img->extension();  
            $request->img->move(public_path('popup'), $imageName);
            $img = $imageName; // DB에 입력될 파일명
        } else {
            $img = $request->input('img_name');
        }

        Popup::whereId($id)->update([
            'desc' => $request->input('desc',null),
            'img' => $img,
            'link' => $request->input('link',null),
            'start_date' => $request->input('start_date',null),
            'end_date' => $request->input('end_date',null),
            'width' => $request->input('width',null),
            'height' => $request->input('height',null),
            'left' => $request->input('left',null),
            'top' => $request->input('top',null),
            'is_use' => $request->input('is_use') == 'on' ? 'Y' : 'N'
        ]);

        return redirect()->back()->with('message','수정되었습니다.');
    }

    /**
     *  팝업 삭제
     */
    public function popupDelete(Request $request) {
        $id = $request->input('id');

        Popup::whereId($id)->delete();
        
        return redirect()->back()->with('message','삭제되었습니다.');
    }


    /**
     *  Access List 목록 조회
     *  @param int $id  : acl 한개만 조회시
     */
    public function getAcl(Request $request) {
        // modal 한개만 조회 했을 때
        $where = $request->has('id') ? 'WHERE id = '.$request->input('id') : '';

        $data = DB::select('SELECT INET_NTOA(ip) AS ip, name, id, created_at, IF(is_use = "Y","사용중","미사용") as is_use FROM acl '.$where.'');

        return response()->json(['status'=>"success", "data"=>$data],200);
    }

    /**
     *  Access List 수정
     *  @param int $id      : acl 번호
     *  @param string $name : 이름(설명)
     *  @param enum $is_use : 사용여부 (on->Y, off->N)
     */
    public function aclCreate(Request $request) {

        Acl::whereId($request->input('id'))->create([
            'ip' => ip2long($request->input('ip')),
            'name'=>$request->input('name'),
            'is_use' => 'Y'
        ]);

        return response()->json(['status'=>"success"],200);
    }

    /**
     *  Access List 수정
     *  @param int $id      : acl 번호
     *  @param string $name : 이름(설명)
     *  @param enum $is_use : 사용여부 (on->Y, off->N)
     */
    public function aclUpdate(Request $request) {
        $is_use = $request->input('is_use') == "on" ? "Y" : "N";
        Acl::whereId($request->input('id'))->update([
            'name'=>$request->input('name'),
            'is_use'=>$is_use
        ]);

        return response()->json(['status'=>"success"],200);
    }

    /**
     *  Access List 삭제
     *  @param int $id      : acl 번호
     */
    public function aclDelete(Request $request) {
        Acl::whereId($request->input('id'))->delete();
        return response()->json(['status'=>"success"],200);
    }

    /**
     *  로그 확인 페이지
     *  검색시 아래 paramer 참고
     *  @param string $category : 검색 카테고리
     *  @param string $type : 검색 카테고리 (content:내용, account:아이디, ip:아이피)
     *  @param string $value : 검색 내용
     */
    public function logIndex(Request $request) {
        
        $data = $request->all();

        // 카테고리 필드의 ENUM LIST불러오기
        $cate_query = DB::select(DB::raw('SHOW COLUMNS FROM log WHERE Field = "category"'))[0]->Type;
        preg_match('/^enum\((.*)\)$/', $cate_query, $matches);
        $data['category_val'] = array();
        foreach(explode(',', $matches[1]) as $category_value){
            $data['category_val'][] = trim($category_value, "'");
        }
        
        // 쿼리문 시작
        $query = Log::orderby('created_at','desc');

        // 카테고리 검색시
        if(!empty($data['category'])){
            $query->where('category', $data['category']);
        }

        // 실패 로그만 검색
        if(isset($data['flag']) && $data['flag'] == 'N') $query->where('flag','N');

        // 검색시
        if(!empty($data['value'])){
            switch ($data['type']) {
                case 'ip': $value = ip2long($data['value']);
                    break;
                case 'msg': $value = $data['value'].'%';
                    break;
                default: $value = $data['value'];
                    break;
            }
            $query->where($data['type'],'like',$value);
        }
        
        $data['list'] = $query->paginate(20)->appends($request->query());

        // 블랙리스트
        $data['blacklist'] = DB::table('black_list')->orderby('created_at')->get();

        return view('adm/log_index', $data);
    }

}