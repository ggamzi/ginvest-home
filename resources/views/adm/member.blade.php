

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
        table {
            font-size:13px
        }
        table tbody tr td {
            vertical-align:middle;
        }
    </style>
@endsection

@section('title','회원관리')

@section('body')


<!-- ============================================================== -->
<!-- Start Page Content -->
<!-- ============================================================== -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h4>회원관리</h4>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>
  
<section class="content">
    <div class="card">

        <div class="card-header">
            <form style="margin:0" method="get" id="frm">
                <div class="row">
                    <div class="col-3">
                        <div class="input-group input-group-sm">
                            <select class="form-control col-3" name="type">
                                @php
                                    $types = ["아이디" => "account", "이름"=>"name", "닉네임" => "nickname", "연락처" => "phone", "이메일" => "email"];
                                @endphp
                                @foreach($types as $key => $row)
                                    <option value="{{ $row }}" {{ isset($type) && $type == $row ? 'selected': '' }} >{{ $key }}</option>
                                @endforeach
                            </select>
                            <input type="search" name="value" class="form-control" placeholder="검색어를 입력해 주세요" value="{{ isset($value) ? $value : '' }}">
                            <div class="input-group-append">
                                <button type="submit" class="btn btn-default">
                                    <i class="fa fa-search"></i>
                                </button>
                            </div>
                        </div>
                    </div><!-- ./col END -->

                    <div class="col-1">
                        <select class="form-control form-control-sm" name="status" onchange="$('#frm').submit()">
                            <option value="">==상태==</option>
                            @php
                                $status_type = ["사용중" => "Y", "미사용"=>"N", "탈퇴" => "L"];
                            @endphp
                            @foreach($status_type as $key => $row)
                                <option value="{{ $row }}" {{ isset($status) && $status == $row ? 'selected': '' }} >{{ $key }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </form>
        </div>
        

        <div class="card-body">
            <div class="row">
                <div class="col mb-2">
                    <spa><strong>총 :  {{ $users->count() }}명</strong></span>
                </div>
            </div>
            <table class="table table-bordered table-sm text-center table-hover" id="customer_list">
                <thead class="bg-gray">
                    <th><input type="checkbox" id="list_allchk"></th>
                    <th>NO</th>
                    <th>아이디</th>
                    <th>이름</th>
                    <th>닉네임</th>
                    <th>등급</th>
                    <th>상태</th>
                    <th>연락처</th>
                    <th>이메일</th>
                    <th>가입일</th>
                    <th style="width:150px">관리</th>
                </thead>
                <tbody>
                    @if($users->count() == 0)
                    <tr>
                        <td colspan="11">검색결과가 없습니다.</td>
                    </tr>
                    @else
                        @foreach($users as $key => $row)
                            <tr>
                                <td><input type="checkbox"></td>
                                <td>{{ $users->total() - ($users->currentPage()-1)*20 - $key }}</td>
                                <td>{{ $row->account }}</td>
                                <td>{{ $row->name }}</td>
                                <td>{{ $row->nickname }}</td>
                                <td>{{ $row->rank == 0 ? '일반회원' : '관리자' }}</td>
                                @php 
                                    if($row->is_use == 'Y'){
                                        $is_use = "사용중";
                                        $is_use_class = "primary";
                                    } else if($row->is_use == 'N'){
                                        $is_use = "미사용";
                                        $is_use_class= "danger";
                                    } else if($row->is_use == 'L') {
                                        $is_use = "탈퇴";
                                        $is_use_class="warning";
                                    }
                                @endphp
                                <td class="text-{{ $is_use_class }}">{{ $is_use }}</td>
                                <td>{{ preg_replace("/([0-9]{3})([0-9]{3,4})([0-9]{4})$/","\\1-\\2-\\3" ,$row->phone) }}</td>
                                <td>{{ $row->email }}</td>
                                <td>{{ $row->created_at }}</td>
                                <td>
                                    @if($row->is_use == 'L')
                                        <a class="btn btn-danger btn-xs" onclick="userDel('{{ $row->id }}')">탈퇴</a>
                                    @endif
                                    <a class="btn btn-primary btn-xs" onclick="getInfo('{{ $row->id }}')">수정</a>
                                    <a class="btn btn-warning btn-xs" onclick="getLog('{{ $row->account }}')">로그</a>
                                </td>
                            </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>
            <br>
            {{$users->links("pagination::bootstrap-4")}}
        </div>
    </div>

    <!-- 로그 view Modal -->
    <div class="modal fade" id="log_view" tabindex="-1" role="dialog" aria-hidden="true" >
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content" >
                <div class="modal-header">
                    <h5 class="modal-title">로그 확인</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12" >
                            <table class="table table-bordered table-sm text-center table-hover" id="log_table">
                                <thead class="bg-gray">
                                    <th>NO</th>
                                    <th>카테고리</th>
                                    <th>내용</th>
                                    <th width="50px">IP</th>
                                    <th>일자</th>
                                </thead>
                                <tbody>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-sm float-right" data-dismiss="modal">닫기</button>
                </div>
            </div>
        </div>
    </div>
    <!-- ./Modal -->
    
   <!-- 팝업 수정 Modal -->
   <div class="modal fade" id="user_info" tabindex="-1" role="dialog" aria-hidden="true" onsubmit="return checkIt()">
        <form name="user_info" action="{{ route('user.update') }}" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="id">
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
                            <div class="form-group col-6">
                                <label for="inputName">아이디</label>
                                <input type="text" class="form-control form-control-sm" name="account" readonly>
                            </div>
                            <div class="form-group col-6">
                                <label for="inputName">닉네임</label>
                                <input type="text" class="form-control form-control-sm" name="nickname" readonly>
                            </div>
                            <div class="form-group col-6">
                                <label for="inputName">이름</label>
                                <input type="text" maxlength="5" class="form-control form-control-sm" name="name">
                            </div>
                            <div class="form-group col-6">
                                <label for="inputName">상태</label>
                                <div class="row">
                                    <div class="custom-control custom-radio col-4">
                                        <input class="custom-control-input" type="radio" id="is_use_y" name="is_use" value="Y">
                                        <label for="is_use_y" class="custom-control-label text-primary">사용중</label>
                                    </div>
                                    <div class="custom-control custom-radio col-4">
                                        <input class="custom-control-input custom-control-input-warning" type="radio" id="is_use_l" name="is_use" value="L">
                                        <label for="is_use_l" class="custom-control-label text-warning">탈퇴</label>
                                        </div>
                                    <div class="custom-control custom-radio col-4">
                                        <input class="custom-control-input custom-control-input-danger" type="radio" id="is_use_n" name="is_use" value="N">
                                        <label for="is_use_n" class="custom-control-label text-danger">미사용</label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group col-6">
                                <label for="inputName">비밀번호</label>
                                <input autocomplete="new-password" type="password" class="form-control form-control-sm" name="password" placeholder="변경시에만 입력해 주세요." value="">
                            </div>
                            <div class="form-group col-6">
                                <label for="inputName">비밀번호 확인</label>
                                <input type="password" class="form-control form-control-sm" name="password_confirm">
                            </div>
                       
                            <div class="form-group col-6">
                                <label for="inputName">연락처</label>
                                <input type="text" class="form-control form-control-sm" maxlength="13" name="phone" id="input_phone" onkeyup="phoneNumCk(this,'input_phone')">
                            </div>
                            <div class="form-group col-6">
                                <label for="inputName">이메일</label>
                                <input type="text" class="form-control form-control-sm" name="email" autocomplete="off" onchange="dupChk()">
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
    // 게시물 삭제 ajax
    function userDel(id){
        if (confirm('탈퇴시 아이디를 제외한 모든 정보가 삭제됩니다. 삭제 하시겠습니까?') == false) return false; //취소시 return     
       location.href="{{ route('user.del') }}?id="+id;
    }

    function getLog(account) {
        $('#log_table').DataTable({
        "language": {"emptyTable": "데이터가 없습니다.","lengthMenu": "페이지당 _MENU_ 개씩 보기","info": "현재 _START_ - _END_ / _TOTAL_건","infoEmpty": "데이터 없음","infoFiltered": "","search": "검색: ","zeroRecords": "일치하는 데이터가 없습니다.","loadingRecords": "로딩중...","processing": "잠시만 기다려 주세요...","paginate": {"next": "다음","previous": "이전"}},
        ajax : {
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            url : "{{ route('user.log') }}",
            data : { "account" : account },
            type: 'get',
            dataType : "json",
            dataSrc : "data", //json 에서 어떤 데이터를 가져 올건지 data:{}
        },
        columnDefs: [
            {
                "render": function(data) {
                return moment(data).format('YYYY-MM-DD HH:mm');
                },
                "targets": 4
            },
            { "width": "10%", "targets": 3 }
        ],
        columns:[
            {data:"id"},
            {data:"category"},
            {data:"msg"},
            {data:"ip"},
            {data:"created_at"}
        ],
        stateSave: true,
        orderable: false,
        ordering: false,  // 정렬 기능 숨기기
        destroy: true,
        paging: true,
        autoWidth : false,
        lengthChange : false,          // 페이지 조회 시 row를 변경할 것인지
        pageLength : 15,    
    });
        $("#log_view").modal('show');
    }

    // 게시물 삭제 ajax
    function getInfo(id){
        $("#user_info input").removeClass('is-invalid');  
        $.ajax({
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            url: "{{ route('user.info') }}",
            data: { 'id' : id },
            type: "get",
            dataType: 'json',
            success:function(data){
                if(data.status == "success"){
                    var res = data.data;
                    $("#user_info [name='id']").val(res.id);    // id
                    $("#user_info [name='account']").val(res.account);    // 아이디
                    $("#user_info [name='nickname']").val(res.nickname);    // 닉네임
                    $("#user_info [name='name']").val(res.name);    // 이름
                    var phone = res.phone;
                    phone = phone == null ? '' : phone.replace(/[^0-9]/g).replace(/(^02|^0505|^1[0-9]{3}|^0[0-9]{2})([0-9]+)?([0-9]{4})$/,"$1-$2-$3").replace("--", "-");
                    $("#user_info [name='phone']").val(phone);    // 연락처
                    $("#user_info [name='email']").val(res.email);    // 이메일
                    $("input:radio[name='is_use']:radio[value='"+res.is_use+"']").prop('checked', true); // 상태
                    $("#user_info").modal('show');  // 모달 띄우기
                }
            },
            error:function(jqXHR, textStatus, errorThrown){
                alert("에러 발생~~ \n" + textStatus + " : " + errorThrown);
                console.log(data);
                self.close();
            }
        });
    }
    
    // validate
    function checkIt(){
        // 암호 입력시 확인
        var pwd = $("#user_info [name='password']");
        var pwd_chk = $("#user_info [name='password_confirm']");
        if(pwd.val() != "" && pwd_chk.val() != pwd.val()){
            pwd.addClass('is-invalid');
            pwd_chk.addClass('is-invalid');
            alert('암호가 틀립니다.');
            return false;
        } else {
            pwd.removeClass('is-invalid');
            pwd_chk.removeClass('is-invalid');
        }

        // 연락처 형식 확인
        var phone = $("#user_info [name='phone']");
        if(phone.val() != "" && phone.val().length < 12) {
            alert('연락처 형식을 확인해 주세요.');
            phone.addClass('is-invalid');
            return false;
        } else {
            phone.removeClass('is-invalid');
        }

        if (confirm('수정하시겠습니까?') == false) return false; //취소시 return
    }

    //연락처 형식으로 자동 변경
    function phoneNumCk(obj,tagid) {
        // 선택된 노드의 핸드폰 번호 입력값
        var val = obj.value;
        $("#"+tagid).val( val.replace(/[^0-9]/g, "").replace(/(^02|^0505|^1[0-9]{3}|^0[0-9]{2})([0-9]+)?([0-9]{4})$/,"$1-$2-$3").replace("--", "-") );
    }

    // email 중복 체크
    function dupChk(){
        var email = $("#user_info [name='email']");
        $.ajax({
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            url: "/join/dup_chk",
            type: "GET",
            data: {
                'type': 'email' ,
                'val' : email.val(),
                'method' : 'update'
            },
            dataType: 'json',
            success:function(data){  
                if(data.status == "error") {
                    email.addClass("is-invalid");
                    email.focus();
                    alert(data.msg);
                } else {
                    email.removeClass("is-invalid");
                }
            }
        });
    }

</script>


@endsection