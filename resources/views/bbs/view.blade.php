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

        /* 기사 */
        #container01  .post_link{text-align:left;}
        #container01  .post_link span{font-size:12px; color:#646464; letter-spacing:0; display:inline-block;}
        #container01  .post_link span.link{display:block; text-align:left;}
        
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

        /* 이벤트 VIP 서비스 신청 폼 */
        .free_apply {
            background: url("/design/img/vip_bbs_form.png");
            background-repeat:  no-repeat;
            padding-bottom: 10px;
            font-family:MalgunGothic;
        }
        .free_apply { margin:0 auto; width:360px; min-height: 440px; min-width: 360px;color:#fff;}

        .box1 { height:205px; }
        .frm_f1 { width:360px; }

        @media screen and (max-width:375px){
            .free_apply{ margin-left: -25px   }
        }
        @media screen and (min-width: 376px) and (max-width: 400px) {
            .free_apply{ margin-left: -15px   }
        }

        .frm_f1 ul { margin:0px 0 0 0px; }
        .frm_f1 li { list-style:none; margin:0px 0 0 0; padding:0 ;}

        .rowf { margin:0 auto; width:360px; text-align: center; height:45px;  }
        .rowf input { padding:8px; }

        .frm_f1 input { padding:8px; }
        .frm_f1 select { padding:8px; }
        .select_phone { width:58px;vertical-align: bottom; margin-top: 5px;  padding:8px 3px 8px 3px;  }
        .privacy_bbs { font-size:12px; padding:5px 0 0 95px; }
        .submit { padding:15px 0 0 0px; text-align: center }
        .vip_form  {
            width: 195px;
            height: 45px;
            line-height: 30px;
            font-size: 20px;
            font-weight:900;
            color: #000;
            letter-spacing: -.04em;
            background: #D19F6A; 
            border: 0;
            background-position: 83%;

        }
 
    </style>
@endsection

@section('body')
<div class="cont">
    <div class="sb">
        <div class="sb_title_box">
            {{-- 공증수익률 페이지에서는 `name` 컬럼 적용 --}}
            <h6 class="sb_title">{{ $content->title_n == 'larwer'? $content->s_title : strtoupper($content->title_n) }}</h6>
            <span>{{ $content->desc }}</span>
        </div>

        <style>
            .scbd {margin-top:45px;}
            .scbd .det .hgroup {background-color:#fff; border:0;}
            .scbd .det .hgroup .title {text-align:left; font-size:20px; padding-bottom:30px; border-bottom:1px solid #dcdcdc;}
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
        <script>
            
        </script>

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
                            <span id='mem_galaxygroup_'></span>{{ $content->nickname }}
                        </span>
                        <span>조회수:{{ $content->view_count }}</span>
                    </dt>
                    {{-- 공증수익률, 언론보도, 이벤트 게시판은 작성일/url 복사 노출 x --}}
                    @php $view_url_arr = ['larwer','press','event'] @endphp
                    @if(!in_array($content->title_n, $view_url_arr))
                    <dd>
                        <span>{{ $content->create_date }}</span>
                    </dd>
                    @endif
                </dl>
            </div>
            <!-- // Head -->

            <!-- url copy -->
            @if(!in_array($content->title_n, $view_url_arr))
            <div class="copyurl">
                <input type="text" id="current_url" value="{{ URL::current() }}" style="outline:none; border:none; display:inline-block; text-align:right; width:80%; font-size:12px" readonly />
                <a href="javascript:clip('{{ URL::current() }}')" class="btn" title="URL COPY">URL COPY</a>
            </div>
            @endif
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
            @if($s_title == "언론보도")
                @php
                    $option = explode('$$$',$content->option);
                @endphp
                <div class="post_link">
                    <span>{{ $option[0] }}</span>
                    <span>{{ $option[1] }} </span>
                    <a href="{{ $option[2] }}" target="_blank">
                        <span class="link">{{ $option[2] }}</span>
                    </a>
                </div>
            @endif

            @if($content->use_apply == 'Y')
                {{-- 무료체험신청 사용하는 게시판일 경우  --}} 
                <div class="free_apply" style="margin-top:15px;">
                    <form id="view" enctype="multipart/form-data" style="margin:0">
                        <input type="hidden" name="event_code" value="event_page">
                        <div class="box1">&nbsp;</div>

                        <div class="frm_f1">
                            <ul>
                                <li>
                                    <div class="rowf">
                                    이&nbsp;&nbsp;&nbsp;름&nbsp;&nbsp;
                                    <input type="text" name="s_v1" id="s_v1" style="width:190px"></div>
                                </li>
                            </ul>
                        </div>
                            
                        <li>
                            <div class="rowf">
                            연락처&nbsp;&nbsp;
                                <select name="s_v2_hp1" class="select_phone" title="휴대전화 첫번째">
                                <option value="">선택</option><option value="010">010</option>
                                <option value="011">011</option><option value="016">016</option>
                                <option value="017">017</option><option value="018">018</option>
                                <option value="019">019</option>
                                </select> <input type="text" name="s_v2_hp2" size="4" maxlength="4" value="" title="휴대전화 두번째" style="width:50px"> <input type="text" name="s_v2_hp3" size="4" maxlength="4" value="" title="휴대전화 세번째" style="width:50px">

                            </div>
                        </li>
                        
                        <div class="privacy_bbs" style="text-align:left;">
                            <label class="mkt"><label style="display:inline-block; cursor:pointer;"><input type="checkbox" name="s_v5_0" id="s_v5_0" value="동의"><span>동의</span></label>  개인정보취급방침동의</label><br>
                            <label class="mkt"><label style="display:inline-block; cursor:pointer;"><input type="checkbox" name="s_v6_0" id="s_v6_0" value="동의"><span>동의</span></label>  마케팅 수신동의</label><br>
                            <label class="mkt"><label style="display:inline-block; cursor:pointer;"><input type="checkbox" name="s_v7_0" id="s_v7_0" value="동의"><span>동의</span></label>  제3자 정보제공동의</label><br>
                            <label class="mkt"><label style="display:inline-block; cursor:pointer;"><input type="checkbox" name="s_v8_0" id="s_v8_0" value="동의"><span>동의</span></label>  야간광고 수신동의(20시~08시)</label>
                        </div>

                        <div class="submit">
                            <button type="button" class="vip_form" onclick="javascript:vip_chk('view')"><span>무료회원가입</span></button>
                        </div>
                    </form>
                </div>
            @endif
            <hr>

            <!-- buttons -->
            <div class="bbs_btn_wrap">
                @if(isset($_GET['mode']) && $_GET['mode']=='admin')
                    <a href="/bbs/{{ $content->title_n }}" class="btn_list">목록</a>
                @else
                    <a href="{{ url()->previous() }}" class="btn_list">목록</a>
                @endif
            </div>
            <!-- // buttons -->
        </div>
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

    // 메인화면 우측 VIP 무료체험 신청란
    function vip_chk(id) {

        // Validation Start
        if($("#"+id+" [name='s_v5_0']").is(':checked') == false){
            alert("개인정보 취급 방침에 동의 하셔야 합니다.");
            $("#"+id+" [name='s_v5_0']").focus();
            return;
        }
        if($("#"+id+" [name='s_v6_0']").is(':checked') == false){
            alert("마케팅 수신 동의 하셔야 합니다.");
            $("#"+id+" [name='s_v6_0']").focus();
            return;
        }
        if($("#"+id+" [name='s_v7_0']").is(':checked') == false){
            alert("제3자 정보제공동의 하셔야 합니다.");
            $("#"+id+" [name='s_v7_0']").focus();
            return;
        }
        if($("#"+id+" [name='s_v2_hp1']").val() == ""){
            alert('휴대폰 번호를 입력해주세요.');
            $("#"+id+" [name='s_v2_hp1']").focus();
            return;
        }
        if($("#"+id+" [name='s_v2_hp2']").val() == ""){
            alert('휴대폰 번호를 입력해주세요.');
            $("#"+id+" [name='s_v2_hp2']").focus();
            return;
        }
        if($("#"+id+" [name='s_v2_hp3']").val() == ""){
            alert('휴대폰 번호를 입력해주세요.');
            $("#"+id+" [name='s_v2_hp3']").focus();
            return;
        }

        var reg_name = /^[가-힣]{2,4}$/;
        var regexp = /^[0-9]*$/;

        if (!reg_name.test($("#"+id+" [name='s_v1']").val())) {
            alert("이름을 확인해주세요(한글2 ~ 4자 이내)");
            $("#"+id+" [name='s_v1']").focus();
            return false;
        }
        if (!regexp.test($("#"+id+" [name='s_v2_hp2']").val())) {
            alert("숫자만 입력하세요");
            $("#"+id+" [name='s_v2_hp2']").focus();
            return false;
        }
        if (!regexp.test($("#"+id+" [name='s_v2_hp3']").val())) {
            alert("숫자만 입력하세요");
            $("#"+id+" [name='s_v2_hp3']").focus();
            return false;
        }
        // Validation END

        var phone =  $("#"+id+" [name='s_v2_hp1']").val()+ $("#"+id+" [name='s_v2_hp2']").val() +  $("#"+id+" [name='s_v2_hp3']").val();
        var name =  $("#"+id+" [name='s_v1']").val();
        var marketing = $("#"+id+" [name='s_v8_0']").is(':checked') == false ? "N" : "Y";

        //ajax
        $.ajax({
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            url: "/exper/create",
            type: "post",
            data: {
                "_token": "{{ csrf_token() }}",
                "name": name,
                "phone" : phone,
                "marketing" : marketing,
                "event_code" : $("#"+id+" [name='event_code']").val()
            },
            dataType: 'json',
            success:function(data){   
                console.log(data);
                switch (data.status) {
                    
                    // 등록 성공시 formpage api 호출
                    case "success":

                        alert('등록되었습니다.');

                        // formpage api
                        let formData = new FormData
                        formData.append("name", name)
                        formData.append("phone", phone)
                        formData.append("utm_source", $.urlParam('utm_source'))
                        formData.append("utm_medium", $.urlParam('utm_medium'))

                        fetch("https://formpage.co.kr/api/inflow", {
                            method: "post",
                            body: formData,
                        })
                        .then(res => res.text())
                        .then(data => {
                            console.log(data)
                        })
                        _trk_flashEnvView("_TRK_CP=카테고리명","_TRK_PI=RGR","_TRK_SX=성별","_TRK_AG=특성");
                        // formpage api END

                        
                        location.reload();
                        break;
                    case "error":
                        alert(data.msg);
                        break;
                }   
            }
        });
    }

</script>



@endsection