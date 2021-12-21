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
                <!-- <li class="nav-item">
                    <a class="nav-link" id="custom-tabs-four-messages-tab" data-toggle="pill" href="#custom-tabs-four-messages" role="tab" aria-controls="custom-tabs-four-messages" aria-selected="false">Messages</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="custom-tabs-four-settings-tab" data-toggle="pill" href="#custom-tabs-four-settings" role="tab" aria-controls="custom-tabs-four-settings" aria-selected="true">Settings</a>
                </li> -->
            </ul>
        </div>
        <div class="card-body">
        <div class="tab-content" id="custom-tabs-four-tabContent">
            <div class="tab-pane fade active show" id="custom-tabs-four-home" role="tabpanel" aria-labelledby="custom-tabs-four-home-tab" style="height:900px">
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