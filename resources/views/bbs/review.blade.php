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
            <h6 class="sb_title">REVIEW</h6>
            <span>VIP회원님의 감사 후기입니다.</span>
        </div>

        <div id="scbd" class="scbd co-basic-simple">
	    <!-- category and board list -->
            <!-- // category and board list -->
            <div class="bbs_search_wrap">
                <form name='search_form' method='get' action=''>
                    <fieldset>
                        <input type="text" name="search_key" id="search_key" maxlength="30" value="{{ isset($search_key) ? $search_key : '' }}" placeholder="검색어를 입력해주세요.">
                        <button>검색</button>
                    </fieldset>
                </form>
            </div>

            <div id="list_board" class="list_board">
                <ul class="lst-board lst-head">
                    <li>
                        <div class="td col_no">번호</div>
                        <div class="td col_subject">제목</div>				
                        <div class="td col_name">이름</div>
                        <div class="td col_date">작성일</div>
                        <div class="td col_hit">조회수</div>
                    </li>
                </ul>

                <!-- Notice -->
                <ul class="lst-board lst-body lay-notice">
                </ul>
                <!-- // Notice -->

                <ul class="lst-board lst-body">
                    @if($board_list->count() == 0)
						<ul class="noneLst">
							<li class="empty">등록된 게시글이 없습니다.</li>
						</ul>
					@else
                        @foreach($board_list as $row)
                        <li class="clr">
                            <div class="td col_no">{{ $row->id }}</div>
                            <div class="td col_subject">
                                <div style="padding-left:0px;">
                                    <a href="/bbs/review/{{ $row->id }}/info">
                                        <span>{{ $row->title }}</span>
                                    </a>
                                </div>
                            </div>
                            <div class="td inf col_name">{{ $row->nickname }}</div>
                            <div class="td inf col_date">{{ date('Y-m-d', strtotime($row->created_at)) }}</div>
                            <div class="td inf col_hit"><span class="txt">조회수:</span>{{ $row->view_count }}</div>
                        </li>
                        @endforeach
                    @endif
                </ul>
            </div><!-- //list_board -->
            @if (Auth::check())
            <div class="bbs_btn_wrap">
                <a href="/bbs/review/write" class="btn_write">글쓰기</a>
            </div>
            @endif
            {{ $board_list->links('vendor.pagination.default') }}
        </div>
    </div>
</div>          


@endsection

@section('script')


<script type="text/javascript">
// var tmp_chk2=0;

// function div2_move_chk(){
// 	if(!tmp_chk2){
// 		tmp_div2.style.top = tmp_div2.offsetTop-230;
// 		tmp_chk2 = 1;
// 	}
// }


function writeArticle(){
			location.href="/bbs/review/write";
	}
// function readArticle(idx){

// 			location.href="/bbs_shop/read.htm?me_popup=0&auto_frame=&cate_sub_idx=0&search_first_subject=&list_mode=board&board_code=review&search_key=&key=&page=1&y=&m=&idx="+idx;
// 	}
// function reply_readArticle(idx){
// 			alert("본 게시판은  회원만 답변글을 읽을수 있습니다.\n\n회원 등급문의는 운영자에게 문의하시기 바랍니다.");
// 	}

// function no_write(){
// 	alert("본 게시판은 회원 전용 게시판입니다.\n\n로그인하신후 다시 이용하시기 바랍니다.");
// }


//게시글 출력에 필요한 함수
function ToggleAll1(){

	var i =0;
	while(i < document.board_form.elements.length){
		if(document.board_form.elements[i].name=='idx_chk[]'){
			if(document.board_form.elements[i].checked == true){
				document.board_form.elements[i].checked = false;
			}else{
				document.board_form.elements[i].checked = true;
			}
		}
		i++;
	}
}

function mem_secret_no_read(){
			alert("본 게시글은 [비밀글]로 설정되어 있으므로 볼수 없습니다.\n\n비밀글은 작성자만 볼 수 있습니다.");
	}

function secret_no_read2(idx){
	secret_read2(idx);
	//alert("본 게시글은 [회원 전용 비밀글]로 설정되어 있습니다.\n\n [회원 전용 비밀글]은 관리자 또는 작성자만 볼수 있습니다.");
}

function secret_read2(idx){
			var secret_read2_win = window.open('/bbs_shop/popup/pwd_chk_form.htm?pwd_mode=board_secret&me_popup=0&auto_frame=&cate_sub_idx=0&search_first_subject=&list_mode=board&board_code=review&search_key=&key=&page=1&idx='+idx,'secret_read2_win','top=150,left=300,width=330,height=200,scrollbars=no');
		secret_read2_win.focus();
	}

function tmp_div2_close(){
	tmp_div2.style.display = 'none';
}
</script>
@endsection