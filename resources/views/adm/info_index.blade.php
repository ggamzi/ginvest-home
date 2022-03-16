@extends('adm.layout.masterLayout')

@section('style')
    <!-- Tempusdominus Bootstrap 4 (datepicker) -->
    <link rel="stylesheet" href="/adm/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">

    <!-- Toastr -->
    <link rel="stylesheet" href="/adm/plugins/toastr/toastr.min.css">
    
    <style>    
        .content {
            font-size:13px
        }
        .content input{
            font-size:13px
        }
        .content select {
            font-size:13px
        }
        .content textarea {
            font-size:13px
        }
        /* .chk_box_group {margin-top:-3px} */
        .chk_box_group input{
            display:none;
        }
        .content table {
            font-size:13px
        }
        .content table tbody tr td {
            vertical-align:middle;
        }
        .info_tab {cursor:pointer}
        .info_tab:hover {
            background-color:rgba(100, 104, 230, 0.8);
        }
    </style>
    <style>
        #footer_modify {
            border-top: 2px solid #26a1e0;
        }
        #footer_modify div{
            margin: 0;
            padding: 0;
            border: 0;
            font-size: 100%;
            font: inherit;
            vertical-align: baseline;
        }
        #footer_modify .f_sc1 {
            background: #2f2f2f;
            padding: 55px 0;
        }
        #footer_modify .f_sc1 li {
            width: 33.3333%;
            float: left;
        }
        #footer_modify .f_sc1 li>div .fc_txt01 {
    font-size: 15px;
    color: #fff;
    letter-spacing: .1em;
    font-family: 'Open Sans',sans-serif;
    margin-bottom: 20px;
}
#footer_modify .f_sc1 li>div .fc_txt02 {
    font-size: 18px;
    color: #fff;
    letter-spacing: -.04em;
    margin-bottom: 15px;
}
#footer_modify .f_sc1 li>div .fc_txt03 {
    font-size: 13px;
    color: #b4b4b4;
    letter-spacing: -.04em;
    font-weight: 300;
}
        #footer_modify .cont {
            max-width: 1660px;
            margin: 0 auto;
        }
        #footer_modify ul, li { list-style:none }
        #footer_modify .f_sc1 li>div .fc_txt01 {
            font-size: 15px;
            color: #fff;
            letter-spacing: .1em;
            font-family: 'Open Sans',sans-serif;
            margin-bottom: 20px;
        }
        #footer_modify .f_sc1 li>div .fc_txt02 {
    font-size: 18px;
    color: #fff;
    letter-spacing: -.04em;
    margin-bottom: 15px;
}
#footer_modify .f_sc1 li>div .fc_txt03 {
    font-size: 13px;
    color: #b4b4b4;
    letter-spacing: -.04em;
    font-weight: 300;
}
        .f_before {
    padding-left: 40px;
    position: relative;
}
        
    </style>
    

@endsection

@section('title','기본정보 설정')

@section('body')


<!-- ============================================================== -->
<!-- Start Page Content -->
<!-- ============================================================== -->


<section class="content-header">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-6">
                <h4>기본정보 설정</h4>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>

<section class="content">
    <div class="card card-primary card-outline card-outline-tabs">
        <div class="card-header p-0 border-bottom-0">
            <ul class="nav nav-tabs" id="custom-tabs-four-tab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link @if($title == 'terms_use') active @endif" href="/admin/set?title=terms_use">
                        이용약관 수정
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link @if($title == 'privacy') active @endif" href="/admin/set?title=privacy">
                        개인정보처리방침 수정
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link @if($title == 'footer') active @endif" href="/admin/set?title=footer">
                        하단 회사정보 수정
                    </a>
                </li>
                <!-- <li class="nav-item">
                    <a class="nav-link" id="custom-tabs-four-settings-tab" data-toggle="pill" href="#custom-tabs-four-settings" role="tab" aria-controls="custom-tabs-four-settings" aria-selected="true">Settings</a>
                </li> -->
            </ul>
        </div>
        <div class="card-body">
        <div class="tab-content" id="custom-tabs-four-tabContent">
            @if($title != 'footer')
            <div class="tab-pane fade active show" id="custom-tabs-four-home" role="tabpanel" aria-labelledby="custom-tabs-four-home-tab" style="height:auto">
                <form action="{{ route('info.update') }}" method="post" id="terms_use_frm" onsubmit="return checkIt()">
                    <input type="hidden" name="title" value="{{ $title }}">
                    @csrf
                    <!-- 1 -->
                    <div class="row">
                        <textarea name='content' id='content' STYLE='width:100%; height:550px'>
                            {{ $info->content }}
                        </textarea>
                    </div>
                    <div class="row mt-3">
                        <button type="submit" class="btn btn-primary col-auto" >수정</button>
                    </div>
                </form>
            </div>
            @else
            <div class="tab-pane fade active show" id="custom-tabs-four-home" role="tabpanel" aria-labelledby="custom-tabs-four-home-tab" style="height:auto">
                {{-- 하단 회사정보 수정 --}}
                <div id="footer_modify">
                    <div class="f_sc1">
                        <div class="cont">
                            <ul>
                                <li>
                                    <div style="height: 118px;">
                                        <p class="fc_txt01">CUSTOMER CENTER</p>
                                        <p class="fc_txt02">갤럭시 투자그룹 고객센터&nbsp;&nbsp;<span class="blue_txt">1644.1870 /
                                                1544.8959</span>
                                        </p>
                                        <p class="fc_txt03">평　　일 &nbsp;&nbsp;&nbsp;09:00 - 18:00</p>
                                        <p class="fc_txt03">점심시간 &nbsp;&nbsp;&nbsp;11:30 - 13:00</p>
                                    </div>
                                </li>
                                <li>
                                    <div class="f_before" style="height: 118px;">
                                        <p class="fc_txt01">BANK INFO</p>
                                        <p class="fc_txt02">계좌 국민은행<span class="blue_txt">&nbsp;&nbsp; 421701-04-216870</span>
                                        </p>
                                        <p class="fc_txt03">예금주<br>㈜머니랩솔루션즈</p>
                                    </div>
                                </li>
                                <li>
                                    <div class="f_before" style="height: 118px;">
                                        <p class="fc_txt01">COMPANY INFO</p>
                                        <p class="fc_txt02">
                                            <span class="blue_txt">㈜머니랩솔루션즈</span>
                                        </p>
                                        <p class="fc_txt03" style="font-size:15px">
                                            <span>서울 금천구 가산디지털1로 168,우림라이온스밸리B동 209, 210, 1211, 1212호</span>
                                        </p>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="f_sc2">
                        <div class="cont clr">
                            <h1>
                                <img src="/design/img/f_logo.png">
                            </h1>
                            <div class="copy_box">
                                <p class="copy01">
                                    <span style="color:#fff;">㈜머니랩솔루션즈</span>
                                </p>
                                <p class="copy01">대표자 : 김영진</p>
                                <p class="copy01">사업자등록번호 : 831-81-01343</p>
                                <p class="copy01">개인정보담당자 : 이재인</p>
                                <p class="copy01">본사 : 1644.1870</p>
                                <p class="copy01">지사 : 1544.8959</p>
                                <p class="copy01">Fax : 02.6929.1743</p>
                                <p class="copy01">E-mail : thefirstinvestment@naver.com</p>
                                <p class="copy02">소재지 : 인천광역시 남동구 예술로 174, 10층 / COPYRIGHT Ⓒ 갤럭시투자그룹. All rights reserved</p>
                                <p class="copy02">본 사이트에서 제공되는 모든 정보는 투자판단의 참고자료이며, 서비스 이용에 따른 최종 책임은 이용자에게 있습니다.</p>
                            </div>
                            <div class="goTop">
                                <a href="#"><img src="/design/img/go_top.jpg"></a>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- ./content END -->
            </div>
            @endif
        </div>
        <!-- /.card -->
    </div>

    <!-- 푸터 정보 Modal -->
    <div class="modal fade" id="footer_info" tabindex="-1" role="dialog" aria-hidden="true" onsubmit="return checkIt('create')">
        <form name="footer_info" action="{{ route('popup.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">정보 수정</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                         
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-info btn-sm float-left">생성</button>
                        <button type="button" class="btn btn-secondary btn-sm float-right" data-dismiss="modal">닫기</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <!-- ./Modal -->

</section>


<!-- ============================================================== -->
<!-- End PAge Content -->
<!-- ============================================================== -->

@endsection


@section('script')
<!-- toastr -->
<script src="/adm/plugins/toastr/toastr.min.js"></script>
<!-- SmartEditor 관련 -->
<script type="text/javascript" src="/se2/js/HuskyEZCreator.js" charset="utf-8"></script>

@if(Session::has('message'))
<script>
    $(document).ready(function(){
        toastr.success("{{session('message')}}");
    });
</script>
@endif

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
            // oEditors.getById["privacy_content"].exec("PASTE_HTML", []);
        },
        fCreator: "createSEditor2"
    });

    function checkIt(){
        if (confirm('수정 하시겠습니까?') == false) return false;
        // editor 내용
        oEditors.getById["content"].exec("UPDATE_CONTENTS_FIELD", []);        
    }
</script>



@endsection