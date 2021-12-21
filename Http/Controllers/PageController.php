<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\boardReview;
use App\Models\board;
use App\Models\User;

class PageController extends Controller
{
    // 이용후기 -> 고객 감사 후기
    public function reviewIndex(request $request){
        
        // 메인 타이틀명
        $data['m_title'] = "이용후기";
        // 서브 타이틀명
        $data['s_title'] = "고객 감사 후기";

        // $data['board_list'] = boardReview::orderBy('created_at','desc')->get();
        $data['board_list'] = board::where("board_id",1)->orderBy('created_at','desc')->get();

        return view('bbs/review',$data);
    }

    // 이용후기 -> 고객 감사 후기 -> 작성
    public function reviewCreate(request $request){
    
        // 메인 타이틀명
        $data['m_title'] = "이용후기";
        // 서브 타이틀명
        $data['s_title'] = "고객 감사 후기";

        return view('bbs/review_create',$data);
    }

    // 이용후기 -> 고객 감사 후기
    public function reviewInfo(request $request, $id){
    
        // 메인 타이틀명
        $data['m_title'] = "이용후기";
        // 서브 타이틀명
        $data['s_title'] = "고객 감사 후기";

        $data['content'] = board::whereId($id)->first();

        return view('bbs/review_info',$data);
    }


    public function reviewStore(Request $request) {
        boardReview::create([
            'user_id' => $request->input('user_id'),
            'title' => $request->input('title'),
            'content' => $request->input('content')
        ]);
        
        return redirect()->route('review');
    }

    public function photoIndex(Request $request) {
        // 메인 타이틀명
        $data['m_title'] = "이용후기";
        // 서브 타이틀명
        $data['s_title'] = "고객 감사 포토후기";

        $data['board_list'] = board::where("board_id",2)->orderBy('created_at','desc')->get();

        return view('bbs/photo',$data);
    }

   


}
