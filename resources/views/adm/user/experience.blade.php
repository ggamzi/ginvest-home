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
        .content table {
            font-size:13px
        }
        .content table tbody tr td {
            vertical-align:middle;
        }
    </style>
@endsection

@section('title','체험회원 관리')

@section('body')


<!-- ============================================================== -->
<!-- Start Page Content -->
<!-- ============================================================== -->


<section class="content-header">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-6">
                <h4>체험회원 관리</h4>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>
  
<section class="content">
    <div class="card col">
        
        <div class="card-header">
            <form method="GET" id="frm" style="margin:0" name="frm">
                <div class="row">
                    <div class="col-3">
                        <div class="input-group input-group-sm">
                            <select class="form-control col-4" name="type">
                                @php
                                    $types = ["이름" => "name", "핸드폰 번호" => "phone", "IP"=>"ip"];
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
                    </div>
                </div><!-- ./row END -->
            </form>
        </div><!-- ./card-header END -->

        <div class="card-body">
            <div class="row">
                <div class="col mb-2">
                    <spa><strong>총 {{ $list->total() }} 건</strong></span>
                </div>
                <div class="col-auto float-right"><span>※일주일치 데이터만 보관됩니다.</span></div>
            </div>
            <table class="table table-bordered table-sm text-center" id="exper_list" style="width:100%">
                <thead class="bg-gray">
                    <th>No</th>
                    <th>이름</th>
                    <th>핸드폰 번호</th>
                    <th>IP</th>
                    <th>등록일</th>
                    <th>관리</th>
                </thead>
                <tbody>
                    @php
                        // acl 리스트에 있다면 표시해주기 위함 (helper함수)
                        $acl_list = getAcl();
                    @endphp
                    @foreach($list as $key => $row)
                        <tr>
                            <td>{{ $list->total() - ($list->currentPage()-1)*20 - $key }}</td>
                            <td>{{ $row->name }}</td>
                            <td>{{ preg_replace("/([0-9]{3})([0-9]{3,4})([0-9]{4})$/","\\1-\\2-\\3" ,$row->phone) }}</td>
                            <td>{{ long2ip($row->ip) }}
                                @if(isset($acl_list[$row->ip]))
                                    <span style="color:blue">[{{ $acl_list[$row->ip] }}]</span>
                                @endif
                            </td>
                            <td>{{ $row->created_at }}</td>
                            <td>
                                <a class="btn btn-xs btn-danger" onclick="experUserDel('{{ $row->id }}')">삭제</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <br>
            {{$list->links("pagination::bootstrap-4")}}
        </div>
    </div>

   

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
    
    // 체험신청 삭제
    function experUserDel(id){
        if (confirm('삭제 하시겠습니까?') == false) return false; //취소시 return
        location.href="{{ route('exper.delete') }}?id="+id;
    }

</script>


@endsection