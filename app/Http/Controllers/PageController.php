<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\boardReview;
use App\Models\Popup;
use App\Models\board;
use App\Models\User;
use App\Models\sidebarSub;
use App\Models\ExperUser;
use App\Models\Log;
use App\Models\BlackList;

use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Cookie;
use Mews\Purifier\Purifier;
use DB;
use Auth;
use Session;

class PageController extends Controller
{
    /**
     *  메인 페이지
     */
    public function mainIndex(Request $request) {
        
        // 팝업 시간 체크를 위한 오늘 일짜
        $today = date("Y-m-d H:i:s");
        // 팝업
        $data['pop'] = Popup::where('start_date','<',$today)->where('end_date','>',$today)->where('is_use','Y')->orderby('order_id','desc')->get();

        return view('index',$data);
    }

    /**
     *  팝업창
     *  @param int $id  : popup id
     */
    public function popupWindow(Request $request, $id) {

        $data['pop_info'] = Popup::whereId($id)->first();

        return view('popup_window',$data);
    }

    /**
     *  팝업 "하루 동안 열지 않기" 누를시 쿠키 생성
     *  @param int $id  : popup id
     */
    public function popupWindowCookieSet(Request $request, $id) {
        $minutes = 60;
        $response = new Response('Set Cookie');
        $response->withCookie(cookie('popup_'.$id, 'none', $minutes));
        return $response;
    }

    /**
     *  회원가입 페이지
     *  이용약관 동의 안할시 return back
     */
    public function joinIndex(Request $request) {
        // 이용
        if(!$request->has('terms_use') || !$request->has('privacy'))  return print("<script>alert('잘못된 접근입니다.'); location.href='/join/agree';</script>");

        $data['s_title'] = '회원가입';
        return view('join',$data);
    }


    /**
     *  게시판 리스트
     *  @param string $board        : 게시판 title
     *  @param string $search_key   : 검색어
     */
    public function listIndex(request $request, $board){
        // 게시판 정보
        $board_info = sidebarSub::select('sidebar_sub.*','sidebar_main.name as m_title')->where('title',$board)->leftJoin('sidebar_main','sidebar_sub.main_title','=','sidebar_main.id')->first();
        if(!isset($board_info)) print "<script type='text/javascript'>alert('존재하지 않는 게시판입니다.'); history.back();</script>";

        $paginate = $board_info->paginate;  // 페이지당 게시물 수
        $url = $board_info->url;            // view url
        $board_id = $board_info->id;        // 게시판 id

        // 메인 타이틀명
        $data['m_title'] = $board_info->m_title;
        // 서브 타이틀명
        $data['s_title'] = $board_info->name;

        // 게시물 쿼리
        $query = DB::table("board")->where("board_id",$board_id)->where('is_view','Y');

        // 검색어가 있을 경우
        if(!empty($request->input('search_key'))) {
            $search_key = $request->input('search_key');
            $query->where('title','like','%'.$search_key.'%');
            $data['search_key'] = $search_key;
        }

        // 공지사항 리스트
        $data['notice_list'] = board::where("board_id",$board_id)->where("notice","Y")->orderBy('create_date','desc')->get();

        // 게시물 리스트
        $data['board_list'] = 
            DB::table(DB::raw("({$query->tosql()}) as board"))
            ->mergeBindings($query)
            ->select('board.*','users.nickname as nickname')
            ->leftJoin('users','board.user_id','=','users.id')
            ->orderBy('board.create_date','desc')
            ->paginate($paginate)->appends($request->query());

        // 포토리뷰일 경우 본문내용의 첫번째 이미지를 썸네일로 사용
        if($board == "photo") {
            $data['thumbnail'] = array();       // view로 보낼 변수
            foreach ($data['board_list'] as $key => $value) {
                // 내용중 첫번째 이미지를 추출하여 변수에 담음
                preg_match_all("/<img[^>]*src=[\"']?([^>\"']+)[\"']?[^>]*>/i", $value->content, $match);
                $thumb = isset($match[1][0]) ? $match[1][0] : '';
                $data['thumbnail'][$key] = $thumb;
            }
        }
        return view($url, $data);
    }

    // 지워야함
    public function photoIndex(Request $request) {
        // 메인 타이틀명
        $data['m_title'] = "이용후기";
        // 서브 타이틀명
        $data['s_title'] = "고객 감사 포토후기";

        $data['board_list'] = board::where("board_id",9)->orderBy('created_at','desc')->paginate(8);

        return view('/bbs/photo',$data);
    }

   
    /**
     *  게시물 view
     *  @param string $board    : 게시판 명 (ex: photo, review ...)
     *  @param int $id          : 게시물 id
     */
    public function boardView(Request $request, $board, $id) {  
        // 쿠키가 없는 경우 생성 후 조회수 증가
        if($request->hasCookie("board_{$id}") != true){
            board::whereId($id)->update(['view_count' => DB::raw('view_count + 1') ]);
            Cookie::queue("board_{$id}", 'value', 60);
        };

        // 게시글 내용
        $data['content'] = board::select('board.*','sidebar_sub.title as title_n','sidebar_sub.desc','sidebar_sub.name as s_title','sidebar_sub.main_title','sidebar_sub.use_apply')
            ->where('board.id',$id)
            ->where('sidebar_sub.title',$board)
            ->leftJoin('sidebar_sub','board.board_id','=','sidebar_sub.id')
            ->first();

        // 해당 게시글 없을시
        if(!isset($data['content'])) print "<script type='text/javascript'>alert('존재하지 않는 게시글입니다.'); history.back();</script>";

        $data['s_title'] = $data['content']['s_title']; // 서브 타이틀명
        $data['m_title'] = DB::table('sidebar_main')->whereId($data['content']['main_title'])->value('name');   // 메인 타이틀명        

        return view('bbs/view',$data);
    }

    /**
     *  체험회원 생성
     *  @param string $name         : 이름
     *  @param string $phone        : 핸드폰번호
     *  @param string $event_code   : 폼 요청 이벤트 코드 (혹시 필요할까봐)
     *  @param ENUM $marketing      : 야간광고 수신 동의여부
     */
    public function experCreate(Request $request) {

        $ip = ip2long($_SERVER['REMOTE_ADDR']);
        
        // 해당 ip로 오늘 신청한 기록 있는지 확인.
        $exper_chk = ExperUser::where('ip',$ip)->where('created_at','<',date("Y-m-d",strtotime('+1 day')))->where('created_at','>',date("Y-m-d H:i:s",strtotime('-1 day')))->count();

        $account = auth()->check() ? auth()->user()->account : NULL;    //로그인 했다면 id 기록

        if($exper_chk > 0) {
            Log::create([
                'ip'=> $ip,
                'category'=>'체험회원',
                'flag'=>'N',
                'msg'=>'하루 1회만 신청 가능',
                'account' => $account
            ]);   
            return response()->json(['status'=>"error",'msg'=> '죄송합니다. 하루 1회만 신청 가능합니다.'],200);
        }

        // // 블랙 리스트 조회 (빼도 될 듯 함)
        // if(BlackList::where('ip',$ip)->count() > 0) return response()->json(['status'=>"error",'msg'=> '죄송합니다. 체험회원신청 시도횟수 초과로 인해 차단되었습니다.'],200);
        
        // $today = date("Y-m-d H:i:s");   // 현재시간
        // $minus = date("Y-m-d H:i:s",strtotime('-5 minutes'));   // 현재시간에서 5분전

        // // 지금 시간으로부터 -5분동안 10번 이상 시도 기록이 있을 경우 블랙리스트 추가하여 차단
        // if(Log::where('ip',$ip)->where('created_at','<',$today)->where('created_at','>',$minus)->count() > 10){
        //     BlackList::create([ 'ip' => $ip, 'desc' => '체험회원 5분동안 10회 이상 시도' ]);
        //     Log::create([
        //         'ip'=> $ip,
        //         'category'=>'블랙리스트',
        //         'flag'=>'Y',
        //         'msg'=>'블랙리스트 추가'
        //     ]);   // 로그 기록
        //     return response()->json(['status'=>"error",'msg'=> '시도횟수를 초과했습니다.'],200);
        // }

        // 중복 연락처 체크
        $phoneChk = ExperUser::where('phone',$request->input('phone'))->count();
        if($phoneChk > 0) {
            Log::create([
                'ip' => $ip,
                'category' => '체험회원',
                'flag' => 'N',
                'msg' => "연락처 중복 ({$request->input('phone')})",
                'account' => $account
            ]);   // 로그 기록
            return response()->json(['status'=>"error",'msg'=> '중복되는 연락처가 있습니다.'],200);
        }
                
        ExperUser::create([
            "name" => $request->input('name'),
            "phone" => $request->input('phone'),
            "event_code" => $request->input('event_code', null),
            "marketing" => $request->input('marketing'),
            "ip" => $ip,
            "account" => $account
        ]);

        Log::create([ 'ip'=> $ip, 'category'=>'체험회원', 'flag'=>'Y', 'msg'=>'성공', 'account' => $account ]);   // 로그 기록
        
        return response()->json(['status'=>"success"],200);
    }

    /**
     *  마이페이지
     */
    public function mypageIndex(Request $request) {
        $id = auth()->user()->id;   // 회원 ID
        $info = User::whereId($id)->first();
        $data["info"] = $info;
        $hp = $info->phone;
        $data["info"]["hp1"] = substr($hp,0,3);
        $data["info"]["hp2"] = substr($hp,3,-4);
        $data["info"]["hp3"] = substr($hp,-4);

        return view('mypage', $data);
    }

}
