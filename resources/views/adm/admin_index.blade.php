@extends('adm.layout.masterLayout')

@section('style')
    <!-- daterange picker -->
    <link rel="stylesheet" href="/adm/plugins/daterangepicker/daterangepicker.css">
    <!-- Tempusdominus Bootstrap 4 (datepicker) -->
    <link rel="stylesheet" href="/adm/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">

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
        table thead th { vertical-align:middle !important; }
        table tbody tr td {
            vertical-align:middle;
        }
        .card-header span { font-size:15px; font-weight:bold}
        #post_info tr td { vertical-align:middle; height:40px }
        #post_info tr td:nth-child(1) {width:15%;}
        #post_info tr td:nth-child(2) { width:20% }
        #post_info tr td:nth-child(3) {width:15%;}
        #post_info tr td:nth-child(2n+1) { font-weight:bold; background-color:#eeeeee  }
        
    </style>
@endsection

@section('title','DASH BOARD')

@section('body')


<!-- ============================================================== -->
<!-- Start Page Content -->
<!-- ============================================================== -->


<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h4>DASHBOARD</h4>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>
  
<section class="content">
    <div class="row">
    <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
                <div class="inner">
                    <h3>{{ $today_visitor }}</h3>
                    <p>금일 방문자</p>
                </div>
                <div class="icon">
                <i class="fas fa-calendar-week"></i>
                </div>
                <a href="#" id="visitor_btn" class="small-box-footer">더보기 <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>

        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
                <div class="inner">
                    <h3>{{ $today_exper }}</h3>
                    <p>체험신청</p>
                </div>
                <div class="icon">
                <i class="fas fa-user"></i>
                </div>
                <a href="/admin/user/experience" class="small-box-footer">더보기 <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>

        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
                <div class="inner">
                    <h3>{{ $today_post }}</h3>
                    <p>신규 게시글</p>
                </div>
                <div class="icon">
                <i class="fas fa-sticky-note"></i>
                </div>
                <a href="admin/bbs_manage" class="small-box-footer">더보기 <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>

        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
                <div class="inner">
                    <h3>{{ $today_user }}</h3>
                    <p>신규 회원</p>
                </div>
                <div class="icon">
                <i class="fas fa-users"></i>
                </div>
                <a href="/admin/user" class="small-box-footer">더보기 <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
    </div><!-- ./row END -->
    
    <div class="row">
        <div class="col-6">
            <div class="card card-primary card-outline">
                <div class="card-header">
                  <span><a href="/admin/user/experience">신규 체험신청 (7일)</a></span>
                    <div class="card-tools">
                        <!-- 창 줄이기 -->
                        <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                            <i class="fas fa-minus" style="margin-top:12px"></i>
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <table class="table table-bordered table-sm table-hover text-center" id="experience">
                                <thead class="bg-info">
                                    <th>NO</th>
                                    <th>이름</th>
                                    <th>번호</th>
                                    <th>IP</th>
                                    <th>신청일</th>
                                </thead>
                                <tbody>
                                    @foreach($experience as $exper_key => $exper_row)
                                        <tr>
                                            <td>{{ $experience->count() - $exper_key }}</td>
                                            <td>{{ $exper_row->name }}</td>
                                            <td>{{ preg_replace("/([0-9]{3})([0-9]{3,4})([0-9]{4})$/","\\1-\\2-\\3" ,$exper_row->phone) }}</td>
                                            <td>{{ long2ip($exper_row->ip) }}</td>
                                            <td>{{ $exper_row->created_at }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div><!-- ./card END -->

            <div class="card card-primary card-outline">
                <div class="card-header">
                  <span><a href="/admin/set/log">최근 Log (7일)</a></span>
                    <div class="card-tools">
                        <!-- 창 줄이기 -->
                        <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                            <i class="fas fa-minus" style="margin-top:12px"></i>
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <table class="table table-bordered table-sm table-hover text-center" id="log" >
                                <thead class="bg-info">
                                    <th>NO</th>
                                    <th>카테고리</th>
                                    <th>내용</th>
                                    <th>아이디</th>
                                    <th>IP</th>
                                    <th>일자</th>
                                </thead>
                                <tbody>
                                    @foreach($log as $log_key => $log_row)
                                        <tr>
                                            <td>{{ $log->count() - $log_key }}</td>
                                            <td>{{ $log_row->category }}</td>
                                            <td>{{ $log_row->msg }}</td>
                                            <td>{{ $log_row->account }}</td>
                                            <td>{{ long2ip($log_row->ip) }}</td>
                                            <td>{{ $log_row->created_at }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div><!-- ./card END -->
        </div><!-- ./col-6 END -->

        <div class="col-6">
            <div class="card card-primary card-outline">
                <div class="card-header">
                  <span><a href="/admin/bbs_manage">신규 게시글</a></span>
                    <div class="card-tools">
                        <!-- 창 줄이기 -->
                        <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                            <i class="fas fa-minus" style="margin-top:12px"></i>
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <table class="table table-bordered table-sm table-hover text-center" id="post" >
                                <thead class="bg-info">
                                    <th>NO</th>
                                    <th>게시판명</th>
                                    <th>닉네임</th>
                                    <th>제목</th>
                                    <th>작성일</th>
                                </thead>
                                <tbody>
                                    @foreach($post as $post_key => $post_row)
                                        <tr class="@if($post_row->is_view == 'C') bg-warning @endif">
                                            <td>{{ $post->count() - $post_key }}</td>
                                            <td>{{ $post_row->s_name }}</td>
                                            <td>{{ $post_row->nickname }}</td>
                                            <td style="cursor:pointer;" onclick="postInfo('{{ $post_row->id }}')">@if($post_row->is_view == 'C') [신규] @endif{{ $post_row->title }}</td>
                                            <td>{{ $post_row->create_date }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card card-primary card-outline">
                <div class="card-header">
                  <span><a href="/admin/bbs_manage">일별 방문자</a></span>
                    <div class="card-tools">
                        <!-- 창 줄이기 -->
                        <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                            <i class="fas fa-minus" style="margin-top:12px"></i>
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <canvas class="chart chartjs-render-monitor" id="line-chart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%; display: block; width: 627px;" width="627" height="250"></canvas>
                    </div>
                </div>
            </div>

        </div><!-- ./col END -->
    </div><!-- ./row END -->

<!-- ============================================================== -->
<!-- Start Modal Content -->
<!-- ============================================================== -->


  <!--게시물 Modal -->
  <div class="modal fade" id="post_modal" tabindex="-1" role="dialog" aria-hidden="true" onsubmit="return checkIt()">
        <form id="post_agree" action="/admin/get-info/post-agree" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="id" value="">
            @csrf
            <div class="modal-dialog modal-xl" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">게시글</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row" style="border-bottom:solid 1px #dddddd">
                            <table class="table table-sm table-bordered text-center" id="post_info">
                                <tr>
                                    <td>게시판</td>
                                    <td>
                                        <select class="form-control form-control-sm" id="post_board" disabled>
                                            @foreach($board as $board_row)
                                                <option value="{{ $board_row->id }}">{{ $board_row->name }}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td>작성일</td><td id="post_create_date"></td>
                                </tr>
                                <tr>
                                    <td>닉네임</td><td id="post_nickname"></td>
                                    <td>제목</td><td id="post_title"></td>
                                </tr>
                            </table>
                        </div>
                        <div class="row mt-3">
                            <div class="col-12" id="post_content" style="height:600px; width:100%; overflow:scroll;"></div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-info btn-sm float-left" id="post_agree_btn">승인</button>
                        <a href="" class="btn btn-primary btn-sm float-left" id="post_edit_btn">수정</a>
                        <button type="button" class="btn btn-secondary btn-sm float-right" data-dismiss="modal">닫기</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <!-- ./Modal -->

    <!--방문자수 Modal -->
    <div class="modal fade" id="visitor_modal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">방문자</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="form-group col-auto">
                            <div class="input-group" >
                                <div class="input-group-prepend">
                                    <span class="input-group-text" style="height:31px">
                                        <i class="far fa-calendar-alt"></i>
                                    </span>
                                </div>
                                <input type="text" class="form-control float-right" style="height:31px" name="daterange" id="daterange" value="">
                            </div><!-- /.input group -->
                        </div><!-- /.form group -->
                    </div>
                    <div class="row" id="visitor_chart_row">
                        <canvas class="chart chartjs-render-monitor" id="visitor-chart" style="" width="627" height="250"></canvas>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-sm float-right" data-dismiss="modal">닫기</button>
                </div>
            </div>
        </div>
    </div>
    <!-- ./Modal -->

</section>


<!-- ============================================================== -->
<!-- End PAge Content -->
<!-- ============================================================== -->

@endsection


@section('script')
<!-- daterangepicker -->
<script src="/adm/plugins/moment/moment.min.js"></script>
<script src="/adm/plugins/moment/moment-locale-ko.js"></script>
<script src="/adm/plugins/daterangepicker/daterangepicker.js"></script>

<!-- ChartJS -->
<script src="/adm/plugins/chart.js/Chart.min.js"></script>
<!-- Datatables -->
<script src="/adm/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="/adm/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
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

//Date range picker
$('#daterange').daterangepicker({
    locale: {
        "separator": " ~ ",                     // 시작일시와 종료일시 구분자
        "format": 'YYYY-MM-DD',     // 일시 노출 포맷
        "applyLabel": "확인",                    // 확인 버튼 텍스트
        "cancelLabel": "취소",                   // 취소 버튼 텍스트
        "daysOfWeek": ["일", "월", "화", "수", "목", "금", "토"],
        "monthNames": ["1월", "2월", "3월", "4월", "5월", "6월", "7월", "8월", "9월", "10월", "11월", "12월"]
    },
    showDropdowns: true,                     // 년월 수동 설정 여부
    autoApply: true,                         // 확인/취소 버튼 사용여부
}).on('change',function(e){ // 변경 상황 있을 때 사용 // When you want to do onchange with datetimepicker
    $("canvas#visitor-chart").remove();
    $("#visitor_chart_row").append('<canvas class="chart chartjs-render-monitor" id="visitor-chart" style="" width="627" height="250"></canvas>');
    getVisitor();
});


// 데이터 테이블
var title_arr = ['experience','post','log'];
$.each(title_arr, function(index,value){
    $("#"+value).DataTable({
        "language": {"emptyTable": "데이터가 없습니다.","lengthMenu": "페이지당 _MENU_ 개씩 보기","info": "현재 _START_ - _END_ / _TOTAL_건","infoEmpty": "데이터 없음","infoFiltered": "","search": "검색: ","zeroRecords": "일치하는 데이터가 없습니다.","loadingRecords": "로딩중...","processing": "잠시만 기다려 주세요...","paginate": {"next": "다음","previous": "이전"}},
        stateSave: true,
        ordering: false,  // 정렬 기능 숨기기
    });
});


$("#visitor_btn").click(function(){
    $("#visitor_modal").modal('show');  
    getVisitor();
});


function postInfo(id) {
    $.ajax({
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        url: "/admin/get-info",
        data: { 'id' : id, 'table' : 'board' },
        type: "GET",
        dataType: 'json',
        success:function(data){
            if(data.status == "success"){
                var res = data.data;
                $("#post_agree [name='id']").val(res.id);
                $("#post_create_date").html(res.create_date);
                $("#post_nickname").html(res.nickname);
                $("#post_title").html(res.title);
                $("#post_content").html(res.content);
                $("#post_board").val(res.board_id).prop("selected",true);   //게시판 설정
                $("#post_edit_btn").attr("href", "/admin/bbs_manage/"+res.id+"/edit"); // 수정버튼 누를시 수정 페이지로 이동

                res.is_view != 'C' ? $("#post_agree_btn").hide() : $("#post_agree_btn").show(); // 신규 게시물이 아니면 승인버튼 노출x
                
                $("#post_modal").modal("show");
            }
        },
        error:function(jqXHR, textStatus, errorThrown){
            alert("에러 발생~~ \n" + textStatus + " : " + errorThrown);
            console.log(data);
            self.close();
        }
    });
}


function checkIt(){
    if (confirm('게시판에 바로 노출됩니다. 승인처리 하시겠습니까') == false) return false
}


// 방문자 통계
function getVisitor(){  
    $.ajax({
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        url: "/admin/get-info",
        data: { 'table' : 'visitors','date' :  $("#daterange").val() },
        type: "GET",
        dataType: 'json',
        success:function(data){
            if(data.status == "success"){
                /////////차트 그리기///////////
                var visit_cnt = [];
                var visit_date = [];

                $.each(data.data,function(key,value){
                    visit_cnt.push(value.count);
                    visit_date.push(value.date);
                });

                var ctx1 = document.getElementById("visitor-chart").getContext('2d');
                
                var myChart = new Chart(ctx1, {
                    type: 'bar',
                    data: {
                        labels: visit_date,
                        datasets: [{
                            label: '방문자',
                            data: visit_cnt,
                            borderWidth: 1
                        }]
                    },
                    options: {
                        maintainAspectRatio: true, // default value. false일 경우 포함된 div의 크기에 맞춰서 그려짐.
                        scales: {
                            yAxes: [{
                                ticks: {
                                    beginAtZero:true
                                }
                            }]
                        }
                    }
                });
                /////////차트 그리기 END///////////
              
            }
        },
        error:function(jqXHR, textStatus, errorThrown){
            alert("에러 발생~~ \n" + textStatus + " : " + errorThrown);
            console.log(data);
            self.close();
        }
    });
};








////////////////일별 방문자 그래프//////////////////////
var ctx = document.getElementById("line-chart").getContext('2d');
/*
- Chart를 생성하면서, 
- ctx를 첫번째 argument로 넘겨주고, 
- 두번째 argument로 그림을 그릴때 필요한 요소들을 모두 넘겨줍니다. 
*/

var arr = {!! json_encode($visitor) !!}; 
console.log(arr);

var visit_cnt = [];
var visit_date = [];

$.each(arr,function(key,value){
    visit_cnt.push(value.count);
    visit_date.push(value.date);
});

var myChart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: visit_date,
        datasets: [{
            label: '방문자',
            data: visit_cnt,
            backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(153, 102, 255, 0.2)',
                'rgba(255, 159, 64, 0.2)',
                'rgba(150, 150, 150, 0.2)',
            ],
            borderColor: [
                'rgba(255,99,132,1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 159, 64, 1)',
                'rgba(150, 150, 150, 1)',
            ],
            borderWidth: 1
        }]
    },
    options: {
        maintainAspectRatio: true, // default value. false일 경우 포함된 div의 크기에 맞춰서 그려짐.
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero:true
                }
            }]
        }
    }
});



</script>


@endsection