

@extends('adm.layout.masterLayout')

@section('style')
    <!-- DataTables CSS -->
    <link rel="stylesheet" href="/adm/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="/adm/css/buttons.bootstrap4.min.css">
    <link rel="stylesheet" href="/adm/css/responsive.bootstrap4.min.css">

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

@section('title','접속 IP 관리')

@section('body')


<!-- ============================================================== -->
<!-- Start Page Content -->
<!-- ============================================================== -->


<section class="content-header">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-6">
                <h4>접속 IP 관리</h4>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>
  
<section class="content">
    <div class="row">
        <div class="col-6">
            <div class="card">
                <div class="card-header">
                <button class="btn btn-sm btn-outline-primary _auth_create" data-toggle='modal' id="acl_create_btn" data-target='#acl_create_modal'>IP 추가</button>
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
                      <table class="table table-bordered table-sm text-center" id="acl_list" style="width:100%">
                          <thead class="bg-gray">
                              <th>명칭</th>
                              <th>IP</th>
                              <th>등록일</th>
                              <th>사용여부</th>
                              <th>관리</th>
                          </thead>
            
                      </table>
                    <!-- ./row END -->
                </div>
                <!-- /.card-body END -->
            </div>
            <!-- /.card END-->
        </div>
        <!-- ./col END -->      
    </div>
    <!-- ./card END -->


    <!-- ================== -->
    <!-- Modal -->
    <!-- ================== -->

    {{-- 접속 허용 ip 생성 Modal --}}
    <div class="modal fade" id="acl_create_modal" tabindex="-1" role="dialog" aria-hidden="true">
        <form id="acl_create">
            @csrf
            <div class="modal-dialog modal-sm" role="document" >
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">허용 IP 추가</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="form-group col-12">
                                <label for="inputName">명칭</label>
                                <input type="text" class="form-control form-control-sm" id="create_ipname" name="name" required autocomplete="off">
                            </div>
                            <div class="form-group col-12">
                                <label for="inputName">IP 주소</label> (예 : 1.234.56.78)
                                <input type="text" class="form-control form-control-sm" id="create_ip" name="ip" required autocomplete="off">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <a class="btn btn-info btn-sm float-left" onclick="aclCRUD('create')">생성</a>
                        <button type="button" class="btn btn-secondary btn-sm float-right" data-dismiss="modal">닫기</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
    {{-- ./Modal --}}

    {{-- 접속 허용 ip 수정 Modal --}}
    <div class="modal fade" id="acl_update_modal" tabindex="-1" role="dialog" aria-hidden="true">
        <form id="acl_update">
            <input type="hidden" name="id" id="update_ipid">
            @csrf
            <div class="modal-dialog modal-sm" role="document" >
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">허용 IP 추가</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="form-group col-12">
                                <label for="inputName">명칭</label>
                                <input type="text" class="form-control form-control-sm" id="update_ipname" name="name" required autocomplete="off">
                            </div>
                            <div class="form-group col-12">
                                <label for="inputName">IP 주소</label> (예 : 1.234.56.78)
                                <input type="text" class="form-control form-control-sm" id="update_ip" name="ip" required autocomplete="off" readonly>
                            </div>
                            <div class="form-group col-12">
                                <label for="inputName">사용여부</label>
                                <div>
                                    <input type="checkbox" name="is_use" id="update_is_use" data-toggle="toggle">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <a class="btn btn-info btn-sm float-left" onclick="aclCRUD('update')">수정</a>
                        <button type="button" class="btn btn-secondary btn-sm float-right" data-dismiss="modal">닫기</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
    {{-- ./Modal --}}
</section>


<!-- ============================================================== -->
<!-- End PAge Content -->
<!-- ============================================================== -->

@endsection


@section('script')
<!-- Datatables -->
<script src="/adm/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="/adm/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>

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
    
$(document).ready(function(){
    // bootstrap switch (팝업 사용 여부)
    $("#update_is_use").bootstrapSwitch({
        state:true,
        size:'small',
        handleWidth:'45',
        labelWidth:'10',
        onText:'사용',
        offText:'미사용',
    });

    $("#acl_list").DataTable({
        //datatable 세팅
        "language": {"emptyTable": "데이터가 없습니다.","lengthMenu": "페이지당 _MENU_ 개씩 보기","info": "현재 _START_ - _END_ / _TOTAL_건","infoEmpty": "데이터 없음","infoFiltered": "","search": "검색: ","zeroRecords": "일치하는 데이터가 없습니다.","loadingRecords": "로딩중...","processing": "잠시만 기다려 주세요...","paginate": {"next": "다음","previous": "이전"}},
        "lengthMenu": [10], //페이지당 노출 갯수
        ajax : {
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            url : "{{ route('acl.list') }}",
            type: 'get',
            dataType : "json",
            dataSrc : "data", //json 에서 어떤 데이터를 가져 올건지 data:{}
        },
        'columnDefs': [
            {
                'targets': 4,
                'render': function (data, type, full, meta){
                    var return_btn = "<button class='btn btn-primary btn-xs _auth_update' data-toggle='modal' data-target='#acl_update_modal' onclick='aclInfo("+$('<div/>').text(data).html()+")'>수정</button>";
                    return_btn += "<button class='btn btn-danger ml-1 btn-xs _auth_delete' onclick=aclCRUD('delete',"+$('<div/>').text(data).html()+")>삭제</button>";
                    return return_btn;
                }
            }
        ],
        columns:[
            {data:"name"},
            {data:"ip"},
            {data:"created_at"},
            {data:"is_use"},
            {data:"id"},
        ],
        //각 버튼 위치 customizing (dom)
        dom: 'Blfrtip',
        "dom":  
        "<'row'<'col-sm-6 col-md-6'B>B<'col-sm-6 col-md-6'f>>" + //페이지당 노출 갯수, 검색
        "<'row'<'col-sm-12't>>" +  //테이블
        "<'row'<'col-sm-6 col-md-6'i><'col-sm-6 col-md-6'p>>", //페이지당 노출 갯수, 검색
        stateSave: true,
        orderable: false,
        ordering: false,  // 정렬 기능 숨기기
        processing: true, //로딩 기능
    });
});

function aclInfo(id){
    $.ajax({
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        url: "{{ route('acl.list') }}",
        type: "GET",
        data: { 'id':id },
        dataType: 'json',
        success:function(data){   
            if(data.status == "success"){
                $("#update_ipname").val(data.data[0].name); //hidden -> id값
                $("#update_ip").val(data.data[0].ip);
                $("#update_ipid").val(data.data[0].id);
                var use_chk = data.data[0].is_use == '사용중' ? 'checked' : '';   //사용.미사용 여부
                $('#update_is_use').bootstrapSwitch('state',use_chk);
            }
        },
        error:function(jqXHR, textStatus, errorThrown){
            alert("에러 발생~~ \n" + textStatus + " : " + errorThrown);
            console.log(data);
            self.close();
        }
    });
}


/**
 *  메모 생성,수정,삭제 (Ajax)
 */
function aclCRUD(method,id){
    switch (method) {
        // 허용 ip 생성
        case 'create':
            if($("#create_ipname").val()=='' || $("#create_ip").val()==''){
                alert('빈칸을 모두 채워주세요');
                return false;
            }
            if (confirm('생성 하시겠습니까?') == false) return false;
            //카테고리가 선택되어 있지 않을 때 리턴
            var url = "{{ route('acl.create') }}";
            var data = $("#acl_create").serialize();
            break;
        //허용된 ip 수정
        case 'update':
            if (confirm('수정 하시겠습니까?') == false) return false;
            var url = "{{ route('acl.update') }}";
            var type = "post";
            var data = $("#acl_update").serialize();
            break;
        // 허용 ip 삭제
        case 'delete':
            if (confirm('삭제 하시겠습니까?') == false) return false;
            var url = "{{ route('acl.delete') }}";
            var data = {
                'id': id,
                '_token' : "{{ csrf_token() }}"
            };
            break;
    }

    $.ajax({
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        url: url,
        type: "post",
        data: data,
        dataType: 'json',
        success:function(data){   
            if (data.status == "success"){             
                // 완료 toast message
                toastr.success("성공하였습니다.");
                if(method != 'delete') $("#acl_"+method+"_modal").modal('hide');
                $('#acl_list').DataTable().ajax.reload( null, false );
            } else if(data.status == "error") {
                    alert (data.msg);
            };
        },
        error:function(jqXHR, textStatus, errorThrown){
            alert("에러 발생~~ \n" + textStatus + " : " + errorThrown);
            console.log(data);
            self.close();
        }
    });
}/////memoCud END

</script>


@endsection