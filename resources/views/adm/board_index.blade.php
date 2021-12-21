

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
        table {
            font-size:13px
        }
        table thead tr th { vertical-align:middle !important; }
        table tr td { vertical-align:middle; }
        
        #board_set tr td { vertical-align:middle; align:center; height:40px}
        #board_set tr td input[type=checkbox] { width:15px !important; height:15px !important }
        #board_set tr td input[type=text] { height:25px !important }
        #board_set tr td:nth-child(2n+1) { width:40%; font-weight:bold }
        #board_set tr td:nth-child(2n) { width:10%; }
    </style>
@endsection

@section('title','게시판 관리')

@section('body')


<!-- ============================================================== -->
<!-- Start Page Content -->
<!-- ============================================================== -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h4>게시판 관리</h4>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>
  
<section class="content">
    <div class="card">

        <div class="card-header">
            <form style="margin:0" method="get" id="frm">
                <div class="row">
                   
                </div>
            </form>
        </div>

        <div class="card-body">
            <table class="table table-bordered table-sm text-center table-hover" id="customer_list">
                <thead class="bg-gray">
                    <tr>
                        <th rowspan=2>대분류</th>
                        <th rowspan=2>게시판명</th>
                        <th rowspan=2>목적</th>
                        <th colspan=3>게시판 설정</th>
                        <th rowspan=2>노출여부</th>
                        <th style="width:150px" rowspan=2>관리</th>
                    </tr>
                    <tr>
                    <th>썸네일</th>
                    <th>공지사항</th>
                    <th>체험신청</th>
                    </tr>
                </thead>
                
                <tbody>
                    @foreach($list as $key => $row)
                    <tr>
                        <td>{{ $row->main_name }}</td>
                        <td>{{ $row->name }} ({{ $row->title }})</td>
                        <td>{{ $row->is_board == 'Y' ? '게시판' : '일반' }}</td>
                        <td>@if($row->use_thumb == 'Y') <i class="fas fa-check"></i> @endif</td>
                        <td>@if($row->use_notice == 'Y') <i class="fas fa-check"></i> @endif</td>
                        <td>@if($row->use_apply == 'Y') <i class="fas fa-check"></i> @endif</td>
                        <td class="{{ $row->is_use == 'N'? 'text-danger' :'text-primary' }}">{{ $row->is_use == 'Y' ? '노출' : '숨김' }}</td>
                        <td>
                            <a class="btn btn-xs btn-primary" onclick="boardInfo('{{$row->id}}')">수정</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <br>
            
        </div>
    </div>

    <!-- 게시판 수정 Modal -->
    <div class="modal fade" id="board_update" tabindex="-1" role="dialog" aria-hidden="true" >
        <form name="board_update" action="{{ route('board.update') }}" method="POST" enctype="multipart/form-data"  onsubmit="return checkIt('update')">
            <input type="hidden" name="id" value="">
            @csrf
            <div class="modal-dialog" role="document">
                <div class="modal-content" >
                    <div class="modal-header">
                        <h5 class="modal-title">게시판 수정</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="form-group col-6">
                                <label for="inputName">대분류</label>
                                <input type="text" class="form-control form-control-sm" name="main_name" value="" disabled>
                            </div>
                            <div class="form-group col-6">
                                <label for="inputName">게시판 이름</label>
                                <input type="text" class="form-control form-control-sm" name="name" value="">
                            </div>
                            <div class="form-group col-12">
                                <label for="inputName">설명</label>
                                <input type="text" class="form-control form-control-sm" name="desc" value="">
                            </div>
                            <div class="form-group col-6">
                                <label for="inputName">타이틀(key)</label>
                                <input type="text" class="form-control form-control-sm" name="title" value="" readonly>
                            </div>
                            <div class="form-group col-6">
                                <label for="inputName">노출여부</label>
                                <div>
                                    <input type="checkbox" name="is_use" id="update_is_use" data-toggle="toggle"  value="Y">
                                </div>
                            </div>

                            <div class="form-group col-6">
                                <label for="inputName">용도</label>
                                <select class="form-control form-control-sm" name="is_board" disabled >
                                    <option value="Y">게시판</option>
                                    <option value="N">일반</option>
                                </select>
                            </div>
                            <div class="form-group col-12" id="board_set_col">
                            <label for="inputName">설정</label>
                                <table class="table table-bordered table-sm text-center" id="board_set">
                                    <tr>
                                        <td class="">썸네일 사용</td><td><input name="use_thumb" type="checkbox" value="Y"></td>
                                        <td class="">공지사항 사용</td><td><input name="use_notice" type="checkbox"  value="Y"></td>
                                    </tr>
                                    <tr>
                                        <td class="">체험신청 삽입</td><td><input name="use_apply" type="checkbox"  value="Y"></td>
                                        <td class="">페이지당 게시물수</td><td><input name="paginate" type="text" class="form-control form-control-sm"></td>
                                    </tr>
                                    <tr>
                                        <td class="">추가 정보 입력 사용</td>
                                        <!-- <td><input name="use_option_key" type="checkbox" ></td> -->
                                        <td colspan="3">
                                            <div class="row justify-content-md-center"  style="margin:0" id="option_key"></div>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-info btn-sm float-left" onclick="">수정</button>
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

<script>
    // bootstrap switch (노출여부)
    $("#update_is_use").bootstrapSwitch({
        state:true,
        size:'small',
        handleWidth:'45',
        labelWidth:'10',
        onText:'노출',
        offText:'숨김',
    });
    /** 고객 리스트 전체 선택.해제 */
    $('#list_allchk').click(function(){
        var state = $("#list_allchk").prop("checked");
        $("input:checkbox[name=list_chk]").prop("checked",state);
    });

    // 게시물 정보 수정 modal ajax
    function boardInfo(id){
        $.ajax({
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            url: "{{ route('board.info') }}",
            data: { 'id' : id },
            type: "GET",
            dataType: 'json',
            success:function(data){
                if(data.status == "success"){
                    console.log(data);
                    var res = data.data;
                    $("#board_update [name='id']").val(res.id);    // id
                    $("#board_update [name='main_name']").val(res.main_name);    // 대분류
                    $("#board_update [name='name']").val(res.name);    // 게시판 이름
                    $("#board_update [name='title']").val(res.title);    // 타이틀
                    $("#board_update [name='desc']").val(res.desc);    // 설명
                    $('#update_is_use').bootstrapSwitch('state', res.is_use == 'Y' ? 'checked' : '' ); //노출여부
                    $("#board_update [name='is_board']").val(res.is_board).prop("selected",true);   //게시판 설정

                    // 게시판으로 사용중이면 게시판 설정 테이블 보여줌
                    res.is_board == "N" ? $("#board_set_col").hide() : $("#board_set_col").show();

                    $("#board_update [name='use_thumb']").prop("checked", res.use_thumb == "Y" ? true : false );  //썸네일 사용여부
                    $("#board_update [name='use_notice']").prop("checked", res.use_notice == "Y" ? true : false );  //공지사항 사용여부
                    $("#board_update [name='use_apply']").prop("checked", res.use_apply == "Y" ? true : false );  //체험신청 삽입 사용여부
                    $("#board_update [name='paginate']").val(res.paginate);    // 페이지당 게시물 수
                    if(res.option_key){
                        var option_key_arr = res.option_key.split("$$$");
                        var option_key = "";
                        $.each(option_key_arr, function(i){
                            option_key += "<input type='text' class='form-control form-control mt-1 col-10' value='"+option_key_arr[i]+"'>\n";
                        });
                        $("#option_key").html(option_key);
                    } else {
                        $("#option_key").html("<input type='text' class='form-control form-control col-10 mt-1' placeholder='추가 기능은 추후 업데이트'>\n");
                    }

                    $("#board_update").modal("show");   // 모달 출력  
                }
            },
            error:function(jqXHR, textStatus, errorThrown){
                alert("에러 발생~~ \n" + textStatus + " : " + errorThrown);
                console.log(data);
                self.close();
            }
        });
    }

 
    function checkIt(method){
        method_str = method == 'create' ? '생성' : '수정';
        if (confirm(method_str+' 하시겠습니까?') == false) return false
    }

</script>


@endsection