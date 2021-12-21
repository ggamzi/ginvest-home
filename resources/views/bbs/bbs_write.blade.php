@extends('layout.masterLayout')

@section('style')

    <!-- 게시판 css -->
    <link rel="stylesheet" type="text/css" href="/css/default_mobile.css" media="all">
    <link rel="stylesheet" type="text/css" href="/css/default_tablet.css" media="only all and (min-width:768px)">
    <link rel="stylesheet" type="text/css" href="/css/co-basic-simple.css" media="screen">
    <!--[if lt IE 9]><link rel="stylesheet" type="text/css" href="/img_up/shop_pds/galaxygroup/design/default_tablet.css" media="all"><![endif]-->
    <!--[if IE]><link rel="stylesheet" type="text/css" href="/img_up/shop_pds/galaxygroup/design/ie.css" media="all"><![endif]-->
    <!--[if lt IE 8]><link rel="stylesheet" type="text/css" href="/img_up/shop_pds/galaxygroup/design/ie7.css" media="all"><![endif]-->

    <style>
        /* 검색 */
        .bbs_search_wrap {width: 100%; margin:45px auto 20px;}
        .bbs_search_wrap:after {display:block; clear:both; content:'';}
        .bbs_search_wrap form {position:relative; float:right; padding: 0 50px 0 0;}
        .bbs_search_wrap input[type="text"] {height:50px; line-height:50px; box-sizing:border-box; width:350px; padding:.2em .5em; border:1px solid #dcdcdc;}
        .bbs_search_wrap button {position:absolute; right:0; bottom:0; border:0; background:url(/design/img/search_btn.png) center no-repeat; width:50px; height:50px; line-height:50px; color:#fff; border-radius:0; text-indent:-1000em; overflow:hidden;}
        
        /* 리스트 */
        .scbd .list_board {border-top:2px solid #646464;}
        .scbd .lst-board.lst-head li div {font-weight:400;}
        .scbd .lst-board.lst-body li {padding: 0;}
        .scbd .list_board .lst-board.lst-body li {display:table; width:100%;}
        .scbd .list_board .lst-board.lst-body li .td {padding:15px 10px; display:table-cell; vertical-align:middle;}
        .scbd .list_board .lst-board.lst-head li div {font-size:15px; color:#323232; background-color:#f8f8f8; padding:20px 10px;}

        .scbd .list_board .lst-board.lst-body li .col_no,
        .scbd .list_board .lst-board.lst-body li .col_subject a,
        .scbd .list_board .lst-board.lst-body li .inf {font-size:15px; color:#646464; font-weight:400;}
        .scbd .list_board .lst-board.lst-body li .col_subject a {text-align:left;}
        .scbd .list_board .lst-board.lst-body li .col_no {width: 8%; text-align:center;}
        .scbd .list_board .lst-board.lst-body li .col_hit {width: 7%;}
        .scbd .list_board .lst-board.lst-body li .col_date {width: 12%;}
        
        /* 공지사항 */
        .scbd .lst-board.lst-body.lay-notice li {background-color:#fff;}
        .scbd .lst-board.lst-body.lay-notice li .col_subject a {font-weight:700;}
        .scbd .lst-board.lst-body.lay-notice li .col_no {color:#ff5f00;}
        
        /* 페이지 */
        .scbd .paginate {text-align:left;}
        .scbd .paginate strong {background:#0197cf;color:#fff;border-color:#0197cf}
        
        /* 버튼 */
        .bbs_btn_wrap {text-align:right;margin-top:20px;}
        .bbs_btn_wrap a {display:inline-block; padding:15px 65px; color:#fff; background:#0197cf;border-radius:3px;font-size:18px;}
        .bbs_btn_wrap a.btn_cancel {background-color:#646464;}
        
        @media screen and (max-width:1020px){
            .bbs_search_wrap form {padding:0 35px 0 0;}
            .bbs_search_wrap input[type="text"],
            .bbs_search_wrap button {height:35px;line-height:35px;}
            .bbs_search_wrap button {width:35px; background-size:cover;}
            
            .scbd .list_board .lst-board.lst-head {display:none;}
            .scbd .list_board .lst-board.lst-body li {width:auto;}
            .scbd .list_board .lst-board.lst-body li .td {padding:10px;}
            .scbd .list_board .lst-board.lst-body li .inf,
            .scbd .list_board .lst-board.lst-body li .col_no,    
            .scbd .list_board .lst-board.lst-body li .col_subject a {font-size:13px;}
            .scbd .list_board .lst-board.lst-body li .inf {float:none; border-right:none;}
            .scbd .list_board .lst-board.lst-body li .col_hit {display: none;}
            .scbd .list_board .lst-board.lst-body li .col_date {font-size:11px;}
            
            .scbd .lst-board.lst-body.lay-notice li {background:#f8f8f8;}
            
            /* 버튼 */
            .bbs_btn_wrap a {font-size:14px; padding:10px 30px;}
        }
        
        @media screen and (max-width:767px){
            .bbs_search_wrap {width:auto;}
            .bbs_search_wrap input[type="text"] {width:200px;}
            
            .scbd .list_board .lst-board.lst-body li,
            .scbd .list_board .lst-board.lst-body li .td {display:block;}
            .scbd .list_board .lst-board.lst-body li {padding:10px;}
            .scbd .list_board .lst-board.lst-body li .td {padding:0;}
            .scbd .list_board .lst-board.lst-body li .col_hit,
            .scbd .list_board .lst-board.lst-body li .col_no {display:none;}
            .scbd .list_board .lst-board.lst-body li .col_date {width:auto;}
            .scbd .lst-board.lst-body.lay-notice li .col_subject a:before {display:inline;margin-right:5px;color:#ff5f00;font-weight:700; vertical-align:middle; content:'[공지]';}
            
            .scbd .paginate {text-align:center;}
            
            /* 버튼 */
            .bbs_btn_wrap {margin-top:10px;}
            .bbs_btn_wrap a {font-size:12px;}
        }
    </style>
@endsection

@section('body')
<div class="cont">
    <div class="sb">
        <div class="sb_title_box">
            <h6 class="sb_title">{{ $board_info->name }}</h6>
            <span>VIP회원님의 감사 후기입니다.</span>
        </div>

        <style>
            .scbd {margin-top:45px;}
            .scbd .det,
            .scbd .write  {border-top:2px solid #646464;}  
        </style>
        <div id="scbd" class="scbd co-basic-simple">
            <!-- category and board list -->
           
            <!-- // category and board list -->
            <form id="frmWrite" method="post" style='margin:0' action="{{ route('post.create') }}"  enctype="multipart/form-data">
                <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                <input type="hidden" name="board_id" value="{{ $board_info->id }}">
                <input type="hidden" name="board_name" value="{{ $board_info->title }}">
                @csrf
                <div class="write">
                    <fieldset>
                        <legend class="blind">게시글 쓰기</legend>
                        <dl>
                            <dt><label>게시판</label></dt>
                            <dd><span class="ui-input ipt-dis"><input type="text" readonly="readonly" value="{{ $board_info->name }}"></span></dd>
                        </dl>
                        {{-- 관리자 전용--}}
                        @if(Auth::user()->rank > 0)
                        <dl>
                            <dt><label for="view_count">조회수</label></dt>
					        <dd><span class="ui-input"><input type="text" name="view_count" id="view_count" size="5" value="0"></span></dd>
                        </dl>
                        <!-- <dl>
                            <dt><label>작성일</label></dt>
                            <dd>
                                <p>
                                    <label>날짜 : <span class="ui-input"><input type="text" name="reg_y" size="5" value="2021"></span> 년</label>&nbsp;
                                    <label><span class="ui-input"><input type="text" name="reg_m" size="3" value="11"></span> 월</label>&nbsp;
                                    <label><span class="ui-input"><input type="text" name="reg_d" size="3" value="29"></span> 일</label>
                                </p>
                                <p>
                                    <label>시간 : <span class="ui-input"><input type="text" name="reg_h" size="3" value="11"></span> 시</label>&nbsp;
                                    <label><span class="ui-input"><input type="text" name="reg_i" size="3" value="21"></span> 분</label>&nbsp;
                                    <label><span class="ui-input"><input type="text" name="reg_s" size="3" value="41"></span> 초</label>
                                </p>
                            </dd>
                        </dl> -->
                        @endif
                        @if($board_info->use_thumb == 'Y')
                        <dl>
                            <dt><label for="view_count">썸네일이미지</label></dt>
					        <dd><span class="ui-input"><input type="file" name="thumbnail" ></span></dd>
                        </dl>
                        @endif
                        {{-- 관리자 전용--}}
                        <dl>
                            <dt><label for="fbd_nick">닉네임</label></dt>
                            <dd>
                                @if(Auth::user()->rank > 0)
                                <span class="ui-input"><input type="text" name="nickname" value=""></span>
                                @else
                                <span class="ui-input ipt-dis"><input type="text" name="nickname" value="{{ Auth::user()->nickname }}"  readonly="readonly" ></span>
                                @endif
                            </dd>
                        </dl>
                        <dl>
                            <dt><label for="subject">제목</label></dt>
                            <dd>
							    @if(Auth::user()->rank > 0 && $board_info->use_notice == 'Y')
                                    <label><input type="checkbox" name="notice" id="notice" value="Y" > 게시판공지</label>
                                @endif
                                <span class="ui-input ipt-block"><input type="text" name="title" value=""></span>
                            </dd>
                        </dl>
                        <dl>
                            <dt><label for="content">내용</label></dt>
                            <dd>
                                <span class="ui-input ipt-block">
                                    <textarea name='content' id='content' STYLE='width:100%;height:490px;'></textarea>                        
                                </span>
                            </dd>
                        </dl>
                        @if(Auth::user()->rank > 0)
                        <ul class="etc">
                            <li>
                                <label class="txt">
                                    <input type="checkbox" name="is_view" value="N">다른 사용자가 볼 수 없도록 비밀글로 등록합니다.
                                </label>
                            </li>
                        </ul>
                        @endif
                    </fieldset>

                    <div class="bbs_btn_wrap">
                        <a href="javascript:;" onclick="submit()" class="btn_write">글쓰기</a>
                        <a href="/bbs/{{ $board_info->title }}" class="btn_cancel">취소</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>   


@endsection


@section('script')

@if(Session::has('message'))
<script>
    $(document).ready(function(){
        alert("{{session('message')}}");
    });
</script>
@endif

<script src="{{ asset('ckeditor/ckeditor.js')}}"></script>
<script type="text/javascript" src="/se2/js/HuskyEZCreator.js" charset="utf-8"></script>


<script type="text/javascript">
    
    @if(isset($board_info) && $board_info->title != 'review')
        var oEditors = [];
        var sLang = "ko_KR";	// 언어 (ko_KR/ en_US/ ja_JP/ zh_CN/ zh_TW), default = ko_KR

        nhn.husky.EZCreator.createInIFrame({
            oAppRef: oEditors,
            elPlaceHolder: "content",
            sSkinURI: "/se2/SmartEditor2Skin.html",	
            htParams : {
                bUseToolbar : true,				// 툴바 사용 여부 (true:사용/ false:사용하지 않음)
                bUseVerticalResizer : true,		// 입력창 크기 조절바 사용 여부 (true:사용/ false:사용하지 않음)
                bUseModeChanger : false,			// 모드 탭(Editor | HTML | TEXT) 사용 여부 (true:사용/ false:사용하지 않음)
                //bSkipXssFilter : true,		// client-side xss filter 무시 여부 (true:사용하지 않음 / 그외:사용)
                //aAdditionalFontList : aAdditionalFontSet,		// 추가 글꼴 목록
                fOnBeforeUnload : function(){
                    //alert("완료!");
                },
                I18N_LOCALE : sLang
            }, //boolean
            fOnAppLoad : function(){
                //예제 코드
                //oEditors.getById["ir1"].exec("PASTE_HTML", ["로딩이 완료된 후에 본문에 삽입되는 text입니다."]);
            },
            fCreator: "createSEditor2"
        });
    @endif

    // ‘저장’ 버튼을 누르는 등 저장을 위한 액션을 했을 때 submitContents가 호출된다고 가정한다.
    function submit(elClickedObj) {
        if (confirm('게시글을 작성 하시겠습니까?') == false) return false; //취소시 return

        @if(isset($board_info) && $board_info->title != 'review')
            // 에디터의 내용이 textarea에 적용된다.
            oEditors.getById["content"].exec("UPDATE_CONTENTS_FIELD", []);
        @endif

        $("#frmWrite").submit();
    }
</script>

@endsection