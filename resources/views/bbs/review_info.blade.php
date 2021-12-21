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

        <style>
            .scbd {margin-top:45px;}
            .scbd .det .hgroup {background-color:#fff; border:0;}
            .scbd .det .hgroup .title {text-align:center; font-size:20px; padding-bottom:30px; border-bottom:1px solid #dcdcdc;}
            .scbd .det .hgroup dl {margin:10px 0;}
            .scbd .det .hgroup dl dt span {border-right:0;}

            @media screen and (max-width:1023px){
            .scbd .det .hgroup .title {font-size:16px;}
            }
            @media screen and (max-width:767px){
            .scbd .det .hgroup .title {font-size:14px;}
            }
        </style>
    <div id="scbd" class="scbd co-basic-simple">
        <!-- category and board list -->

        <!-- // category and board list -->

        <div class="det">
            <!-- Head -->
            <div class="hgroup">
                <div class="title">
                    <strong>{{ $content->title }}</strong>
                </div>
                <dl>
                    <dt>
                        <span>
                            <span id='mem_galaxygroup_'></span>닉네임
                        </span>
                        <span>조회수:22575</span>
                    </dt>
                    <dd>
                        <span>{{ $content->created_at }}</span>
                    </dd>
                </dl>
            </div>
            <!-- // Head -->

            <!-- url copy -->
            <div class="copyurl">
                <a href="{{ URL::current() }}" target="_blank">{{ URL::current() }}</a>
                <a href="javascript:clip('{{ URL::current() }}')" class="btn" title="URL COPY">URL COPY</a>
                <input type="text" id="current_url" value="{{ URL::current() }}" style="position:absolute;top:-9999em;"/>
            </div>
            <!-- // url copy -->
            
            <!-- contents body -->
            <div id="conbody" class="conbody">
                {!! $content->content !!}
            </div>
            <!-- // contents body -->
            
            <div class="mid_design">
            </div>

            <div class="clr">
                <div class="sbtns">
                </div>
            </div>

            <!-- buttons -->
            <div class="bbs_btn_wrap">
                <a href="javascript:history.back()" class="btn_list">목록</a>
            </div>
            <!-- // buttons -->
        </div>
    </div>
</div>

@endsection


@section('script')

<script type="text/javascript">
    
    function clip(val){
        $("#current_url").select();
        document.execCommand("copy"); //복사
    }

</script>

@endsection