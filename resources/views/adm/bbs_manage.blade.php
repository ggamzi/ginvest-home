

@extends('adm.layout.masterLayout')

@section('style')

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
        #customer_list {
            font-size:13px
        }
        #customer_list tbody tr td {
            vertical-align:middle;
        }
    </style>
@endsection

@section('title','게시글 관리')

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
    <div class="card">

        <div class="card-header">
            <form style="margin:0" method="get" id="frm">
                <div class="row">
                    <div class="col-auto">
                        <select class="form-control form-control-sm" name="board_id" onchange="$('#frm').submit()">
                            <option value="">==게시판 선택==</option>
                            @foreach($board_list as $row)
                                <option value="{{ $row->id }}" {{ isset($board_id) && $row->id == $board_id ? 'selected':'' }} >{{ $row->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-auto">
                        <div data-toggle="buttons" class="chk_box_group">
                            <label class="btn btn-outline-success btn-sm">
                                <input type="checkbox" name="new_post"  value="Y" autocomplete="off" onclick="$('#frm').submit()" {{ isset($new_post) && $new_post == 'Y' ? 'checked':'' }}>
                                신규 게시글  <i class="fas fa-check"></i>
                            </label>
                        </div>
                    </div>
                    <div class="col-auto ml-3">
                        <a href="/admin/bbs_manage/write" class="btn btn-sm btn-outline-info col-auto">게시글 작성</a>
                    </div>
                    <div class="col-auto">
                        <a class="btn btn-sm btn-outline-danger col-auto" onclick="postDelete('chk')">선택 삭제</a>
                    </div>
                </div>
            </form>
        </div>
        

        <div class="card-body">
            <div class="row">
                <div class="col mb-2">
                    <spa><strong>총 게시글수 : {{ $post_list->total() }} 건</strong></span>
                </div>
            </div>
            <table class="table table-bordered table-sm text-center table-hover" id="customer_list">
                <thead class="bg-gray">
                    <th><input type="checkbox" id="list_allchk"></th>
                    <th>NO</th>
                    <th>게시판명</th>
                    <th>제목</th>
                    <th>작성자</th>
                    <th>작성일자</th>
                    <th>노출여부</th>
                    <th style="width:150px">관리</th>
                </thead>
                <tbody>
                    @if($post_list->total() == 0)
                    <tr>
                        <td colspan="8">검색결과가 없습니다.</td>
                    </tr>
                    @endif
                    @foreach($post_list as $key => $row)
                        <tr class="{{ $row->is_view == 'C' ? 'bg-warning':'' }}">
                            <td><input type="checkbox" name="list_chk" value="{{ $row->id }}"></td>
                            <td>{{ $post_list->total() - ($post_list->currentPage()-1)*20 - $key }}</td>
                            <td>{{ $row->board_name }}</td>
                            <td>{{ $row->title }}</td>
                            <td>{{ $row->nickname }}</td>
                            <td>{{ $row->create_date }}</td>
                            <td>{{ $row->is_view == 'C' ? '신규' : $row->is_view }}</td>
                            <td>
                                <a href="/bbs/{{ $row->s_title }}/{{ $row->id }}/info?mode=admin" class="btn btn-info btn-xs" target='_blank'>보기</a>
                                <a href="/admin/bbs_manage/{{ $row->id }}/edit" class="btn btn-primary btn-xs">수정</a>
                                <a class="btn btn-danger btn-xs" onclick="postDelete('{{ $row->id }}')">삭제</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <br>
            {{$post_list->links("pagination::bootstrap-4")}}
        </div>
    </div>

    <!-- 팝업 수정 Modal -->
    <div class="modal fade" id="post_form" tabindex="-1" role="dialog" aria-hidden="true" >
        <form name="pop_create" action="" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="id" value="">
            <input type="hidden" name="img_name" value="">
            @method('put')
            @csrf
            <div class="modal-dialog modal-xl" role="document">
                <div class="modal-content" >
                    <div class="modal-header">
                        <h5 class="modal-title">게시글 생성</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                        
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-info btn-sm float-left">수정</button>
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

@if(Session::has('message'))
<script>
    $(document).ready(function(){
        toastr.success("{{session('message')}}");
    });
</script>
@endif

<script>
    /** 고객 리스트 전체 선택.해제 */
    $('#list_allchk').click(function(){
        var state = $("#list_allchk").prop("checked");
        $("input:checkbox[name=list_chk]").prop("checked",state);
    });

    // 게시글 삭제 ajax
    function postDelete(id){
        
        // 체크하여 삭제할 경우
        if(id == "chk"){
            //수정될 게시글이 체크 되어 있지 않았을때 false
            if($("input:checkbox[name=list_chk]:checked").val()==null){
                alert ('삭제할 게시글을 선택해 주세요.');
                return false;
            };

            var id = new Array();    //회원 id 담을 변수 선언
            //선택된 리스트 변수에 삽입
            $("input:checkbox[name=list_chk]:checked").each(function(){
                id.push($(this).val());
            });
        }

        if (confirm('삭제 하시겠습니까?') == false) return false; //취소시 return

        location.href="{{ route('post.delete') }}?id="+id;
    }

    function postEdit(id) {
        $("#post_form").modal('show');
    }

</script>


@endsection