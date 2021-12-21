

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
    <div class="card col">
        
        <div class="card-header">
            <div class="row">
                <div class="col">
                    <button class="btn btn-outline-info btn-sm mr-3" data-toggle="modal" data-target="#pop_create">팝업 생성</button>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                <table class="table table-sm table-bordered text-center">
                    <thead class="bg-gray">
                        <th>No</th>
                        <th>설명</th>
                        <th>링크</th>
                        <th>노출시작</th>
                        <th>노출종료</th>
                        <th>사용여부</th>
                        <th>관리</th>
                    </thead>
                    <tbody>
                        @foreach($pop_list as $key => $row)
                            <tr>
                                <td>{{ $pop_list->count() - $key }}</td>
                                <td>{{ $row->desc }}</td>
                                <td><a href="{{ $row->link }}">{{ $row->link }}</a></td>
                                <td>{{ $row->start_date }}</td>
                                <td>{{ $row->end_date }}</td>
                                <td style="color:{{ $row->is_use == 'Y' ? 'blue':'red' }}">{{ $row->is_use == 'Y' ? '사용':'미사용' }}</td>
                                <td>
                                    <a class="btn btn-xs btn-primary" onclick="popupInfo('{{ $row->id }}')">수정</a>
                                    <a class="btn btn-xs btn-danger" onclick="popupDelete('{{ $row->id }}')">삭제</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- 팝업 생성 Modal -->
    <div class="modal fade" id="pop_create" tabindex="-1" role="dialog" aria-hidden="true" onsubmit="return checkIt('create')">
        <form name="pop_create" action="{{ route('popup.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">팝업 생성</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="form-group col-8">
                                <label for="inputName">설명</label>
                                <input type="text" class="form-control form-control-sm" name="desc" required>
                            </div>
                            <div class="form-group col-4">
                                <label for="inputName">사용여부</label>
                                <div>
                                    <input type="checkbox" name="is_use" id="create_is_use" data-toggle="toggle">
                                </div>
                            </div>
                            <div class="form-group col-12">
                                <label for="inputName">이미지</label>
                                <input type="file" class="form-control" name="img" required>
                            </div>
                            <div class="form-group col-12">
                                <label for="inputName">링크</label>
                                <input type="text" class="form-control form-control-sm" name="link">
                            </div>
                            <div class="form-group col-6">
                                <label for="inputName">노출 시작일</label>
                                <div class="input-group date" id="startdatetime" data-target-input="nearest">
                                    <input type="text" class="form-control form-control-sm datetimepicker-input" data-target="#startdatetime" name="start_date" value=""  required/>
                                    <div class="input-group-append" data-target="#startdatetime" data-toggle="datetimepicker">
                                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group col-6">
                                <label for="inputName">노출 종료일</label>
                                <div class="input-group date" id="enddatetime" data-target-input="nearest">
                                    <input type="text" class="form-control form-control-sm datetimepicker-input" data-target="#enddatetime" name="end_date" value=""  required/>
                                    <div class="input-group-append" data-target="#enddatetime" data-toggle="datetimepicker">
                                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group col-6">
                                <label for="inputName">팝업창 넓이 / 높이(px)</label>
                                <div class="row" style="margin:0; padding:0">
                                    <input type="text" class="form-control form-control-sm" style="width:48%; margin-right:4%" name="width"  required>
                                    <input type="text" class="form-control form-control-sm" style="width:48%;" name="height"  required>
                                </div>
                            </div>
                            <div class="form-group col-6">
                                <label for="inputName">팝업창 위치 "좌측" / "상단" (px)</label>
                                <div class="row" style="margin:0; padding:0">
                                    <input type="text" class="form-control form-control-sm" style="width:48%; margin-right:4%" name="left" placeholder="좌측에서"  required>
                                    <input type="text" class="form-control form-control-sm" style="width:48%;" name="top" placeholder="상단에서" required>
                                </div>
                            </div>
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

    <!-- 팝업 수정 Modal -->
    <div class="modal fade" id="pop_update" tabindex="-1" role="dialog" aria-hidden="true" onsubmit="return checkIt('update')">
        <form name="pop_create" action="{{ route('popup.update') }}" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="id" value="">
            <input type="hidden" name="img_name" value="">
            @method('put')
            @csrf
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">팝업 생성</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="form-group col-8">
                                <label for="inputName">설명</label>
                                <input type="text" class="form-control form-control-sm" name="desc">
                            </div>
                            <div class="form-group col-4">
                                <label for="inputName">사용여부</label>
                                <div>
                                    <input type="checkbox" name="is_use" id="update_is_use" data-toggle="toggle">
                                </div>
                            </div>
                            <div class="form-group col-12">
                                <label for="inputName">이미지</label>
                                <div style="width:100%;" class="mb-1 text-center">
                                    <img src="" id="pop_img" style="width:70%; margin:0 auto">
                                </div>
                                <input type="file" class="form-control" name="img">
                            </div>
                            <div class="form-group col-12">
                                <label for="inputName">링크</label>
                                <input type="text" class="form-control form-control-sm" name="link">
                            </div>
                            <div class="form-group col-6">
                                <label for="inputName">노출 시작일</label>
                                <div class="input-group date" id="startdatetime_up" data-target-input="nearest">
                                    <input type="text" class="form-control form-control-sm datetimepicker-input" data-target="#startdatetime_up" name="start_date" value=""/>
                                    <div class="input-group-append" data-target="#startdatetime_up" data-toggle="datetimepicker">
                                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group col-6">
                                <label for="inputName">노출 종료일</label>
                                <div class="input-group date" id="enddatetime_up" data-target-input="nearest">
                                    <input type="text" class="form-control form-control-sm datetimepicker-input" data-target="#enddatetime_up" name="end_date" value=""/>
                                    <div class="input-group-append" data-target="#enddatetime_up" data-toggle="datetimepicker">
                                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group col-6">
                                <label for="inputName">팝업창 넓이 / 높이(px)</label>
                                <div class="row" style="margin:0; padding:0">
                                    <input type="text" class="form-control form-control-sm" style="width:48%; margin-right:4%" name="width">
                                    <input type="text" class="form-control form-control-sm" style="width:48%;" name="height">
                                </div>
                            </div>
                            <div class="form-group col-6">
                                <label for="inputName">팝업창 위치 "좌측" / "상단" (px)</label>
                                <div class="row" style="margin:0; padding:0">
                                    <input type="text" class="form-control form-control-sm" style="width:48%; margin-right:4%" name="left" placeholder="좌측에서">
                                    <input type="text" class="form-control form-control-sm" style="width:48%;" name="top" placeholder="상단에서">
                                </div>
                            </div>
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


<script>
    //Date picker
    $('#startdatetime').datetimepicker({
        format: 'YYYY-MM-DD HH:mm:ss',
        timepicker: true,
        icons: { time: 'far fa-clock' }
    });
    //Date picker
    $('#enddatetime').datetimepicker({
        format: 'YYYY-MM-DD HH:mm:ss',
        timepicker: true,
        icons: { time: 'far fa-clock' }
    });
    //Date picker
    $('#startdatetime_up').datetimepicker({
        format: 'YYYY-MM-DD HH:mm:ss',
        timepicker: true,
        icons: { time: 'far fa-clock' }
    });
    //Date picker
    $('#enddatetime_up').datetimepicker({
        format: 'YYYY-MM-DD HH:mm:ss',
        timepicker: true,
        icons: { time: 'far fa-clock' }
    });
    // bootstrap switch (팝업 사용 여부)
    $("#create_is_use").bootstrapSwitch({
        state:true,
        size:'small',
        handleWidth:'45',
        labelWidth:'10',
        onText:'사용',
        offText:'미사용',
    });
    // bootstrap switch (팝업 사용 여부)
    $("#update_is_use").bootstrapSwitch({
        state:true,
        size:'small',
        handleWidth:'45',
        labelWidth:'10',
        onText:'사용',
        offText:'미사용',
    });

    function popupInfo(id){
        $.ajax({
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            url: "{{ route('popup.info') }}",
            data: { 'id' : id },
            type: "GET",
            dataType: 'json',
            success:function(data){
                if(data.status == "success"){
                    var res = data.data;
                    $("#pop_update [name='id']").val(res.id);    // 설명
                    $("#pop_update [name='img_name']").val(res.img);    // 설명
                    $("#pop_update [name='desc']").val(res.desc);    // 설명
                    $("#pop_update [name='link']").val(res.link);    // 링크
                    $("#pop_update [name='start_date']").val(res.start_date);    // 시작일
                    $("#pop_update [name='end_date']").val(res.end_date);    // 종료일
                    $("#pop_update [name='width']").val(res.width);    // 넓이
                    $("#pop_update [name='height']").val(res.height);    // 높이
                    $("#pop_update [name='left']").val(res.left);    // 좌측
                    $("#pop_update [name='top']").val(res.top);    // 우측
                    $("#pop_img").attr("src", "/popup/"+res.img);
                    var use_chk = res.is_use == 'Y' ? 'checked' : '';   //사용.미사용 여부
                    $('#update_is_use').bootstrapSwitch('state',use_chk);
                    $("#pop_update").modal('show');
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

    // 팝업 삭제 ajax
    function popupDelete(id){
        if (confirm('삭제 하시겠습니까?') == false) return false; //취소시 return
        location.href="{{ route('popup.delete') }}?id="+id;
    }


</script>


@endsection