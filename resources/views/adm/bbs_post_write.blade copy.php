

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
        #info_table {
            font-size:13px;
        }
        #info_table tbody tr td {
            vertical-align:middle
        }
        #info_table tbody tr td .part{
            margin-top:5px;
        }
        #info_table tbody tr td:first-child{
            width:150px;
            font-weight:bold
        }
        #customer_list tbody tr td {
            vertical-align:middle;
        }
        #thumb {
            width:30%;
            border:solid 1px #dddddd;
        }
    </style>
@endsection

@section('title','게시물 생성')

@section('body')


<!-- ============================================================== -->
<!-- Start Page Content -->
<!-- ============================================================== -->


<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h4>게시글 관리</h4>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>
  
<section class="content">
  
<div class="row">
        <div class="col">
        <form method="POST" id="post_update" action="/board/create"  enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
            <input type="hidden" name="board_name" value="{{ !isset($select_board->title) ? '' : $select_board->title }}">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title font-weight-bold">기본정보</h3>
                    <!-- 카드 툴 -->
                    <div class="card-tools">
                        <!-- 창 줄이기 -->
                        <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                            <i class="fas fa-minus" style="margin-top:12px"></i>
                        </button>
                        <!-- <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
                            <i class="fas fa-times"></i>
                        </button> -->
                    </div>
                </div>
                <!-- ./card-header END -->
                
                <div class="card-body">
                    <div class="row">
                        <table class="table " id="info_table">
                            <tbody>
                                <tr>
                                    <td>게시판</td>
                                    <td>
                                        <select name="board_id" id="board_id" class="form-control form-control-sm col-3" onchange="boardForm()">
                                            <option value="">==게시판 선택==</option>
                                            @foreach($board_list as $row)
                                                <option value="{{ $row->id }}" {{ isset($board_id) && $row->id == $board_id ? 'selected':'' }} >{{ $row->name }}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td>제목</td>
                                    <td><input type="text" class="form-control form-control-sm col-3" name="title" value=""></td>
                                </tr>
                                <tr>
                                    <td>조회수</td>
                                    <td><input type="text" class="form-control form-control-sm col-3" name="view_count" value=""></td>
                                </tr>
                                <tr>
                                    <td>작성일</td>
                                    <td>
                                        <div class="form-group col-3" style="margin:0; padding:0">
                                            <div class="input-group input-group-sm date" id="reservationdatetime" data-target-input="nearest">
                                                <input type="text" class="form-control datetimepicker-input" data-target="#reservationdatetime" name="create_date" value=""/>
                                                <div class="input-group-append" data-target="#reservationdatetime" data-toggle="datetimepicker">
                                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>닉네임</td>
                                    <td>
                                        <div class="input-group input-group-sm col-3" style="margin:0; padding:0">
                                            <input type="text" class="form-control" name="nickname" value="">
                                            <span class="input-group-append">
                                                <button type="button" class="btn btn-info">검색</button>
                                            </span>
                                        </div>
                                    </td>
                                </tr>
                                @if(isset($select_board) && $select_board->use_thumb == 'Y')
                                    {{-- 썸네일 사용 여부--}}
                                    <tr id="thumb_tr" >
                                        <td>썸네일</td>
                                        <td>
                                            <div class="part"><input type="file" name="thumbnail" class="form-control col-2"></div>
                                        </td>
                                    </tr>
                                @endif

                                @if(isset($select_board) && $select_board->option_key != NULL)
                                    {{-- 옵션키 사용 여부--}}
                                    @php
                                        $option_key = $select_board->option_key;
                                        $option_array = explode('$$$',$option_key);
                                    @endphp

                                    @foreach($option_array as $row)
                                    <tr id="thumb_tr" >
                                        <td>{{ $row }}</td>
                                        <td>
                                            <input type="text" name="option_value[]" class="form-control form-control-sm col-3">
                                        </td>
                                    </tr>
                                    @endforeach
                                @endif
                                @if($select_board->use_notice == 'Y')
                                
                                @endif                                
                                <tr>
                                    <td>내용</td>
                                    <td>
                                        <textarea name='content' id='content' STYLE='width:100%;height:490px;'></textarea>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div><!-- /.card-body END -->

                <div class="card-footer">
                    <a id="update_confirm" class="btn btn-info">작성완료</a>
                    <a href="javascript:;" onclick="history.back()" class="btn btn-default float-right">목록으로</a>
                </div>
            </div><!-- /.card END-->
            </form>
        </div>
        <!-- ./col END -->

</section>


<!-- ============================================================== -->
<!-- End PAge Content -->
<!-- ============================================================== -->

@endsection


@section('script')

<!-- Datatables -->
<script src="/adm/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="/adm/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>

<!-- InputMask (moment.js 있어야 datepicker 함수 사용 가능) -->
<script src="/adm/plugins/moment/moment.min.js"></script>
<script src="/adm/plugins/moment/moment-locale-ko.js"></script>

<!-- Tempusdominus Bootstrap 4 (datepicker) -->
<script src="/adm/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>

<!-- toastr -->
<script src="/adm/plugins/toastr/toastr.min.js"></script>

@if(Session::has('message'))
<script>
    $(document).ready(function(){
        toastr.success("{{session('message')}}");
    });
</script>
@endif

<!-- SmartEditor 관련 -->
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
    </script>
<!-- SmartEditor END -->

<script>
    //Date picker
    $('#reservationdatetime').datetimepicker({
        format: 'YYYY-MM-DD HH:mm:ss',
        timepicker: true,
        icons: { time: 'far fa-clock' }
    });

    // 컴펌 후 수정
    $("#update_confirm").click(function(){
        if (confirm('수정 하시겠습니까?') == false) return false; //취소시 return

        // editor 내용
        oEditors.getById["content"].exec("UPDATE_CONTENTS_FIELD", []);
        $("#post_update").submit();
    });
    
    // 게시판 별 사용되는 포맷 가져오기
    function boardForm(){
        $board_id = $("#board_id").val();
        location.href="/admin/bbs_manage/write?board_id="+$board_id;
    }
</script>

@endsection