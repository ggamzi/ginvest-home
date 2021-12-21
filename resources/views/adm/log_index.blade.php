

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

@section('title','로그')

@section('body')


<!-- ============================================================== -->
<!-- Start Page Content -->
<!-- ============================================================== -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h4>로그</h4>
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
                                    $types = ["내용" => "msg", "아이디" => "account", "IP"=>"ip"];
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

                    <div class="col-auto">
                        <select class="form-control form-control-sm" name="category" onchange="$('#frm').submit()">
                            <option value="">==카테고리==</option>
                            @foreach($category_val as $row)
                                <option {{ isset($category) && $category == $row ? 'selected' : '' }}>{{$row}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-auto">
                        <div data-toggle="buttons" class="chk_box_group">
                            <label class="btn btn-outline-danger btn-sm">
                                <input type="checkbox" name="flag"  value="N" autocomplete="off" onclick="$('#frm').submit()" {{ isset($flag) && $flag == 'N' ? 'checked':'' }}>
                                실패 로그
                                @if(isset($flag) && $flag == 'N')
                                    <i class="fas fa-check"></i> 
                                @endif
                            </label>
                        </div>
                    </div>

                    <div class="col-auto">
                        <a class="btn btn-sm btn-info" id="blacklist_btn">블랙리스트</a>
                    </div>
                </div><!-- ./row END -->
            </form>
        </div>

        <div class="card-body">
            <div class="row">
                <div class="col mb-2">
                    <spa><strong>총 :  {{ $list->total() }}건</strong></span>
                </div>
            </div>
            <table class="table table-bordered table-sm text-center table-hover" id="customer_list">
                <thead class="bg-gray">
                    <th>NO</th>
                    <th>카테고리</th>
                    <th>내용</th>
                    <th>아이디</th>
                    <th>IP</th>
                    <th>일자</th>
                </thead>
                
                <tbody>
                    @php
                        // acl 리스트에 있다면 표시해주기 위함 (helper함수)
                        $acl_list = getAcl();
                    @endphp
                    @if($list->count() == 0)
                        <tr>
                            <td colspan=6>검색 결과가 없습니다.</td>
                        </tr>
                    @endif
                    @foreach($list as $key => $row)
                    <tr>
                        <td>{{ $list->total()-($list->currentPage()-1)*20 - $key }}</td>
                        <td>{{ $row->category }}</td>
                        <td class="{{ $row->flag =='Y' ? 'text-primary' : 'text-danger' }}">{{ $row->msg }}</td>
                        <td>{{ $row->account }}</td>
                        <td>{{ long2ip($row->ip) }} 
                            @if(isset($acl_list[$row->ip]))
                                @php $fnt_color = $acl_list[$row->ip] == '블랙리스트' ? 'text-red' : 'text-primary' @endphp
                                <span class="{{ $fnt_color }}">[{{ $acl_list[$row->ip] }}]</span>
                            @endif
                        </td>
                        <td>{{ $row->created_at }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <br>
            {{$list->links("pagination::bootstrap-4")}}
        </div>
    </div>


    <!-- 블랙리스트 Modal -->
    <div class="modal fade" id="blacklist_modal" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">블랙리스트</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <table class="table table-bordered table-sm text-center table-hoverble">
                                <thead>
                                    <th>NO</th>
                                    <th>IP</th>
                                    <th>내용</th>
                                    <th>생성일</th>
                                </thead>
                                <tbody>
                                    @if($blacklist->count() == 0)
                                        <tr>
                                            <td colspan="4">검색결과가 없습니다.</td>
                                        </tr>
                                    @else
                                        @foreach($blacklist as $key => $black)
                                        <tr>
                                            <td>{{ $blacklist->count() - $key }}</td>
                                            <td>{{ long2ip($black->ip) }}</td>
                                            <td>{{ $black->desc }}</td>
                                            <td>{{ $black->created_at }}</td>
                                        </tr>
                                        @endforeach
                                    @endif
                                </tbody>
                            </table>
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
    $("#blacklist_btn").click(function(){
        $("#blacklist_modal").modal('show');
    });

</script>


@endsection