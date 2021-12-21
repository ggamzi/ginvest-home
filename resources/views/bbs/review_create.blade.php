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
            .scbd .det,
            .scbd .write  {border-top:2px solid #646464;}  
        </style>
        <div id="scbd" class="scbd co-basic-simple">
            <!-- category and board list -->
           
            <!-- // category and board list -->
            <form id="frmWrite" method="post" style='margin:0' action="{{ route('review.store') }}"  enctype="multipart/form-data">
                <input type="hidden" name="user_id">
                @csrf
                <div class="write">
                    <fieldset>
                        <legend class="blind">게시글 쓰기</legend>
                        <dl>
                            <dt><label>게시판</label></dt>
                            <dd><span class="ui-input ipt-dis"><input type="text" readonly="readonly" value="고객 감사 후기"></span></dd>
                        </dl>
                        <dl>
                            <dt><label for="fbd_nick">닉네임</label></dt>
                            <dd>
                                <input type="hidden" name="write_name" value="">
                                닉네임
                            </dd>
                        </dl>
                        <dl>
                            <dt><label for="subject">제목</label></dt>
                            <dd>
                                <span class="ui-input ipt-block"><input type="text" name="title" value=""></span>
                            </dd>
                        </dl>
                        <dl>
                            <dt><label for="content">내용</label></dt>
                            <dd>
                                <!-- <div>
                                    <a href="javascript:editor_img_pop('content','ENC_XoFPZ0QkT4TyiSY92MvhbpvuoHXIrbluBfwNWFgG6wU=','')" class="ui-btn btn-sml">이미지첨부</a>
                                    <a href="javascript:bbs_add_file()" class="ui-btn btn-sml">파일첨부</a>
                                </div> -->
                                <textarea name='content' id='content' STYLE='width:100%;height:490px;'>11</textarea>                        
                                
                                <!-- <div class="attachFileList">
                                    <strong>첨부파일</strong>
                                    <div>
                                        <select size="3" name="attachfilelist" id="attachfilelist" class="multiSelect">
                                            <option value="">첨부된 파일목록</option>
                                        </select>
                                        <a onclick="removeAttach('w')" class="ui-btn">삭제</a>
                                    </div>
                                    <p>
                                        <span class="ui-input ipt-sml"><input type="text" name="totsize_k" value="" size="8" readonly="readonly"></span>
                                        <span>KB / 2,000KB</span>
                                    </p>
                                </div> -->
                            </dd>
                        </dl>
                        <ul class="etc">
                            <li>
                                <label class="txt">
                                    <input type="checkbox" name="secret" value="1">다른 사용자가 볼 수 없도록 비밀글로 등록합니다.
                                </label>
                            </li>
                        </ul>
                    </fieldset>

                    <div class="bbs_btn_wrap">
                        <a href="javascript:;" onclick="submit()" class="btn_write">글쓰기</a>
                        <a href="javascript:;" onclick="history.back()" class="btn_cancel">취소</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>   


@endsection


@section('script')
<script src="{{ asset('ckeditor/ckeditor.js')}}"></script>
<script type="text/javascript" src="/se2/js/HuskyEZCreator.js" charset="utf-8"></script>


<script type="text/javascript">
    
    var oEditors = [];
    var sLang = "ko_KR";	// 언어 (ko_KR/ en_US/ ja_JP/ zh_CN/ zh_TW), default = ko_KR



nhn.husky.EZCreator.createInIFrame({
	oAppRef: oEditors,
	elPlaceHolder: "content",
	sSkinURI: "/se2/SmartEditor2Skin.html",	
	htParams : {
		bUseToolbar : true,				// 툴바 사용 여부 (true:사용/ false:사용하지 않음)
		bUseVerticalResizer : true,		// 입력창 크기 조절바 사용 여부 (true:사용/ false:사용하지 않음)
		bUseModeChanger : true,			// 모드 탭(Editor | HTML | TEXT) 사용 여부 (true:사용/ false:사용하지 않음)
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

//     // ckeditor config
//     CKEDITOR.replace('conten1t', {
//         filebrowserUploadUrl: "{{route('upload', ['_token' => csrf_token()])}}",
//         filebrowserUploadMethod: 'form',
//         //extraPlugins: 'easyimage',
//         // extraPlugins : 'simage',
//         // removePlugins: 'image',
    

// // dataParser: func(data)


//     });

     //CKEDITOR.config.extraPlugins = 'simage'  //to enable to plugin
    // CKEDITOR.config.imageUploadURL = '/bbs/review/upload'
    // CKEDITOR.config.dataParser = func(data)
    
    // CKEDITOR.on('instanceReady', function(e){
    //     var url = 'editor_img_pop("content,"/tt/","")';
    //     $('#cke_content a.cke_button__image')
    //         .attr('onclick', url)
    //         .attr('onkeydown', '')
    //         .attr('onfocus', '')
    //         .attr('onmousedown', '')
    //         .attr('onmouseup', '')
    //     ;
    // });


    //]]>

    CKEDITOR.on( 'dialogDefinition', function( ev ) {
        var dialogName = ev.data.name;
        var dialogDefinition = ev.data.definition;
        var dialog = ev.data.definition.dialog;

        if ( dialogName == 'image' ){
            dialogDefinition.onLoad = function () {
                var dialog = CKEDITOR.dialog.getCurrent(); 
                
                // show upload tab 
                this.selectPage('Upload');
                
                // optional:
                dialog.hidePage( 'Link' ); 
                dialog.hidePage( 'advanced' ); 
                
                var uploadTab = dialogDefinition.getContents('Upload');
                var uploadButton = uploadTab.get('uploadButton');
                uploadButton['filebrowser']['onSelect'] = function( fileUrl, errorMessage ) {
                    //$("input.cke_dialog_ui_input_text").val(fileUrl);
                    dialog.getContentElement('info', 'txtUrl').setValue(fileUrl);
                    $(".cke_dialog_ui_button_ok span").click();
                }
            };
        }
    });


    function editer_mode_save(ed_mode){
        if(ed_mode.value == 'ckeditor'){
            if(!confirm('HTML 편집기 모드로 전환 하시겠습니까?\n\n주의! 현재 작성하셨던 내용이 초기화 됩니다.')){
                auto_select('content_editer_mode','ckeditor');
                return;
            }

        }else if(ed_mode.value == 'text'){
            if(!confirm('TEXT 모드로 전환 하시겠습니까?\n\n주의! 현재 작성하셨던 내용이 초기화 됩니다.')){
                auto_select('content_editer_mode','ckeditor');
                return;
            }
        }
        location.href='/bbs_shop/write_form.htm?list_mode=board&mode=write&board_code=review&html_editer_mode='+ed_mode.value;
    }

    // ‘저장’ 버튼을 누르는 등 저장을 위한 액션을 했을 때 submitContents가 호출된다고 가정한다.
    function submit(elClickedObj) {
    // 에디터의 내용이 textarea에 적용된다.
    oEditors.getById["content"].exec("UPDATE_CONTENTS_FIELD", []);

    // 에디터의 내용에 대한 값 검증은 이곳에서
    // document.getElementById("ir1").value를 이용해서 처리한다.


        $("#frmWrite").submit();
    }
</script>

@endsection