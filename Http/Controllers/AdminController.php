<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\boardSet;
use App\Models\board;

use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    // 게시판 관리
    public function bbsManage(request $request){
 
        return view('adm/bbs_manage');
    }

    public function bbsWirteForm(request $request, $board_name){
        //$data['board_info'] = $board_name;
        $data['board_info'] = boardSet::where("url",$board_name)->first();

        if(!isset($data['board_info'])) return redirect()->back()->with('msg', '존재하지 않는 게시판입니다.');

        return view('/bbs/bbs_write',$data);
    }

    public function boardCreate(Request $request) {
        $board_id = $request->input('board_id');
        $board_name = $request->input('board_name');
        $user_id = $request->input('user_id');
        $view_count = $request->input('view_count');
        $created_at = "2021-11-11";
        $nickname = $request->input('nickname');
        $title = $request->input('title');
        $content = $request->input('content');

        if($request->has('thumbnail')){
            $thumbnail = $request->file('thumbnail')->store("public/".$board_name);

            $path=Storage::putFile($board_name,$request->file('thumbnail'));
        }
        

        board::create([
            'board_id' => $board_id,
            'user_id' => $user_id,
            'view_count' => $view_count,
            'created_at' => $created_at,
            'nickname' => $nickname,
            'title' => $title,
            'content' => $content,
            'created_at' => $created_at,
            'thumbnail' => $path
        ]);
        return redirect()->back()->with('message','생성되었습니다.');
    }
}
