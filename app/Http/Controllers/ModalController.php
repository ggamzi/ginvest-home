<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\sidebarSub;
use App\Models\board;
use App\Models\Popup;
use App\Models\ExperUser;
use App\Models\User;
use DB;

use Illuminate\Support\Facades\Storage;

class ModalController extends Controller
{

    /**
     *  게시글 생성 페이지 modal
     */
    public function postWriteModal(Request $request) {
        
        // 게시판 목록
        $data['board_list'] = sidebarSub::where('is_board','Y')->get();
        
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
        $data['post_info'] = board::select('board.*','sidebar_sub.title as board_title')->where('board.id',$id)->leftJoin('sidebar_sub','board.board_id','=','sidebar_sub.id')->first();

        return view('adm/bbs_post_edit', $data);
    }

    /**
     *  게시글 수정 쿼리
     */
    public function postUpdate(Request $request) {
        $id = $request->input('id');

        $is_view = $request->input('is_view') == 'on' ? 'Y' : 'N';

        board::whereId($id)->update([
            'nickname' => $request->input('nickname'),
            'create_date' => $request->input('create_date'),
            'title' => $request->input('title'),
            'view_count' => $request->input('view_count'),
            'created_at' => $request->input('created_at'),
            'content' => $request->input('content'),
            'is_view' => $is_view
        ]);
        return redirect()->back()->with('message','수정되었습니다.');        
        

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
     *  게시글 생성페이지 (본사페이지에서 고객이 작성시)
     */
    public function bbsWirteForm(request $request, $board){

        $data['board_info'] = sidebarSub::where("title",$board)->where("is_board","Y")->first();

        if(!isset($data['board_info'])) return redirect()->back()->with('msg', '존재하지 않는 게시판입니다.');

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
     */
    public function boardCreate(Request $request) {
        $board_id = $request->input('board_id');
        $board_name = $request->input('board_name');
        $user_id = $request->input('user_id');
        $view_count = $request->input('view_count',0);
        $create_date = $request->input('create_date', date("Y-m-d H:i:s"));
        $nickname = $request->input('nickname');
        $title = $request->input('title');
        $content = $request->input('content');

        $user_rank = User::whereId($user_id)->value('rank');

        // 회원이 작성한 경우 승인이 필요함
        if($user_rank == 0){
            $is_view = "C";
        } else {
            $is_view = $request->input('is_view','Y') == 'Y' ? 'Y' : 'N';
        }

        // 썸네일 있을 경우
        if($request->has('thumbnail')){
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
            'is_view' => $is_view
        ]);
        return redirect()->back()->with('message','생성되었습니다.');
    }

    /**
     *  팝업관리
     */
    public function popupIndex(Request $request) {
        $data['pop_list'] = Popup::get();
        
        return view('adm/set/popup_index',$data);
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

    public function experienceIndex(Request $request) {
        $data['exper_user_list'] = ExperUser::get();
        return view('adm/user/experience',$data);
    }


}
