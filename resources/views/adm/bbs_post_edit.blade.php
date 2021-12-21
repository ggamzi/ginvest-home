

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

@section('title','게시글 수정')

@section('body')


<!-- ============================================================== -->
<!-- Start Page Content -->
<!-- ============================================================== -->


<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h4>게시글 수정</h4>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>
  
<section class="content">
  
<div class="row">
        <div class="col">
        <form method="POST" id="post_update" action="/admin/bbs_manage/update" enctype="multipart/form-data">
            <input type="hidden" name="id" value="{{ $post_info->id }}">
            <input type="hidden" name="board_name" value="{{ $post_info->board_title }}" >
            <input type="hidden" name="prev_url" value="{{ Session::has('prev_url') ? session('prev_url') : URL::previous() }}">
            <input type="hidden" name="prev_thumb" value="{{ $post_info->thumbnail }}"> {{-- 썸네일 이미지 --}}
            @csrf
            @method('PUT')
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
                                    <td>제목</td>
                                    <td><input type="text" class="form-control form-control-sm col-3" name="title" value="{{ $post_info->title }}"></td>
                                </tr>
                                <tr>
                                    <td>조회수</td>
                                    <td><input type="text" class="form-control form-control-sm col-3" name="view_count" value="{{ $post_info->view_count }}"></td>
                                </tr>
                                <tr>
                                    <td>작성일</td>
                                    <td>
                                        <div class="form-group col-3" style="margin:0; padding:0">
                                            <div class="input-group input-group-sm date" id="reservationdatetime" data-target-input="nearest">
                                                <input type="text" class="form-control datetimepicker-input" data-target="#reservationdatetime" name="create_date" value="{{ $post_info->create_date }}"/>
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
                                            <input type="text" class="form-control" name="nickname" value="{{ $post_info->nickname }}">
                                            <span class="input-group-append">
                                                <button type="button" class="btn btn-info">검색</button>
                                            </span>
                                        </div>
                                    </td>
                                </tr>
                                @if($post_info->use_thumb == 'Y')
                                <tr>
                                    <td>썸네일</td>
                                    <td>
                                        <div class="part" id="thumb_part">
                                            @if($post_info->thumbnail == NULL)
                                                <span>업로드된 이미지가 없습니다.</span>
                                            @else
                                                <img src="/{{$post_info->board_title }}/{{ $post_info->thumbnail }}" id="thumb">
                                            @endif
                                        </div>
                                        <div class="row mt-2">
                                            <div class="col-3"><input type="file" name="thumbnail" class="form-control form-control-sm"></div>
                                            @if($post_info->thumbnail != NULL)
                                                <div class="col-2"><a class="btn btn-sm btn-danger" id="thumb_del">썸네일 삭제</a></div>
                                            @endif
                                        </div>
                                        
                                    </td>
                                </tr>
                                @endif
                                <tr>
                                    <td>{{ $post_info->is_view == 'C' ? '승인' : '노출 여부' }}</td>
                                    <td>
                                        <div>
                                            <input type="checkbox" name="is_view" id="update_is_view" data-toggle="toggle" {{ $post_info->is_view == 'Y' ? 'checked':'' }}>
                                        </div>
                                    </td>
                                </tr>
                                @if($post_info->option_key != NULL)
                                    {{-- 옵션키 사용 여부--}}
                                    @php
                                        $option_key = explode('$$$',$post_info->option_key);
                                        $option_value = explode('$$$',$post_info->option);
                                        $row_num = 0;
                                    @endphp

                                    @for ($i = 0; $i < count($option_key); $i++)
                                    <tr id="thumb_tr" >
                                        <td>{{ $option_key[$i] }}</td>
                                        <td>
                                            <input type="text" name="option_value[]" value="{{ $option_value[$i] }}" class="form-control form-control-sm col-3">
                                        </td>
                                    </tr>
                                    @endfor
                                @endif
                                @if($post_info->use_notice == 'Y')
                                    {{-- 공지사항 사용 여부--}}
                                    <tr id="thumb_tr" >
                                        <td>공지사항 등록</td>
                                        <td>
                                            <input type="checkbox" name="notice" value="Y" style="width:20px; height:20px" @if($post_info->notice == 'Y') checked @endif>
                                        </td>
                                    </tr>
                                @endif  
                                <tr>
                                    <td>내용</td>
                                    <td>
                                        <textarea name='content' id='content' STYLE='width:100%;height:600px;'>{{ $post_info->content }}</textarea>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- /.card-body END -->

                <div class="card-footer">
                    <a id="update_confirm" class="btn btn-info">수정완료</a>
                    <a href="{{ Session::has('prev_url') ? session('prev_url') : URL::previous() }}" class="btn btn-default float-right">목록으로</a>
                </div>
            </div>
            <!-- /.card END-->
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

<!-- Bootstrap Switch -->
<script src="/adm/plugins/bootstrap-switch/js/bootstrap-switch.min.js"></script>

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

    @if(isset($post_info) && $post_info->title != 'review')
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
                //oEditors.getById["content"].exec("PASTE_HTML", ["로딩이 완료된 후에 본문에 삽입되는 text입니다."]);
            },
            fCreator: "createSEditor2"
        });
    </script>
    @else
        <script>
            $("#info_table [name='content']").addClass('form-control');
        </script>
    @endif
<!-- SmartEditor END -->

<script>
    //Date picker
    $('#reservationdatetime').datetimepicker({
        format: 'YYYY-MM-DD HH:mm:ss',
        timepicker: true,
        icons: { time: 'far fa-clock' }
    });

    // bootstrap switch (노출 여부)
    $("#update_is_view").bootstrapSwitch({
        size:'small',
        handleWidth:'45',
        labelWidth:'10',
        onText:"{{ $post_info->is_view == 'C' ? '승인' : '노출' }}",
        offText:'숨김',
    });

//     function pasteHTML(filepath) {

// var sHTML = '';

// oEditors.getById["content"].exec("PASTE_HTML", [sHTML]);

// }
    // 썸네일 삭제
    $("#thumb_del").click(function(){
        if (confirm('썸네일 이미지를 삭제 하시겠습니까?') == false) return false; //취소시 return
        // 썸네일 경로
        var thumb = $("#post_update [name='board_name']").val()+'/'+$("#post_update [name='prev_thumb']").val();
        $.ajax({
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            url: "{{ route('post.thumb.delete') }}",
            data: {
                'id' : $("#post_update [name='id']").val(),
                'thumb' : thumb
            },
            type: "GET",
            dataType: 'json',
            success:function(data){
                if(data.status="success") {
                    $("#post_update [name='prev_thumb']").val('');
                    $("#thumb_part").html("<span style='color:red'>썸네일 이미지가 삭제 되었습니다</span>");
                }
            },
            error:function(jqXHR, textStatus, errorThrown){
                alert("에러 발생~~ \n" + textStatus + " : " + errorThrown);
                console.log(data);
                self.close();
            }
        });
    })

    // 컴펌 후 수정
    $("#update_confirm").click(function(){
        if (confirm('수정 하시겠습니까?') == false) return false; //취소시 return

        @if(isset($select_board) && $select_board->use_notice == 'Y')
            // editor 내용
            oEditors.getById["content"].exec("UPDATE_CONTENTS_FIELD", []);
        @endif

        $("#post_update").submit();
    });
    

</script>

@endsection