

@extends('layout.masterLayout')

@section('style')

    <!-- Toastr -->
    <link rel="stylesheet" href="/plugins/toastr/toastr.min.css">
    
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

@section('title','지점 관리')

@section('body')


<!-- ============================================================== -->
<!-- Start Page Content -->
<!-- ============================================================== -->


<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h4>지점 관리</h4>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>
  
<section class="content">
    <div class="card col-6">
        
        <div class="card-header">
            <div class="row">
                <div class="col">
                    <button class="btn btn-outline-info btn-sm mr-3" data-toggle="modal" data-target="#branch_create">지점 생성</button>
                </div>
            </div>
        </div>
        

        <div class="card-body">
            <table class="table table-bordered table-sm text-center" id="customer_list">
                <thead class="bg-gray">
                    <th>지점코드</th>
                    <th>지점명</th>
                    <th>관리</th>
                </thead>
                <tbody>
                    <tr>
                        <td>{{11}}</td>
                        <td>{{22}}</td>
                        <td>{{33}}</td>
                    </tr>
                </tbody>
            </table>
            <br>
            {{$branches->links("pagination::bootstrap-4")}}
        </div>
    </div>

    <!-- 지점 생성 Modal -->
    <div class="modal fade" id="branch_create" tabindex="-1" role="dialog" aria-hidden="true">
        <form name="branch_create" action="" method="POST">
            @csrf
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">지점 생성</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="form-group col-12">
                                <label for="inputName">지점코드</label>
                                <input type="text" class="form-control" name="code" onblur="codeChk()" id="create_code" required>
                            </div>
                            <div class="form-group col-12">
                                <label for="inputName">지점 명</label>
                                <input type="text" class="form-control" name="name" required>
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

    <!-- 지점 수정 Modal -->
    <div class="modal fade" id="branch_update" tabindex="-1" role="dialog" aria-hidden="true">
        <form name="branch_update" method="POST" id="branch_update">
            @csrf    
            @method('PUT')    
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">지점 수정</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="form-group col-12">
                                <label for="inputName">지점 코드</label>
                                <input type="text" class="form-control" name="code" id="update_code" readonly>
                            </div>
                            <div class="form-group col-12">
                                <label for="inputName">지점명</label>
                                <input type="text" class="form-control" name="name" id="update_name">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-info btn-sm float-left" >수정</button>
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
<script src="/plugins/toastr/toastr.min.js"></script>

@if(Session::has('message'))
<script>
    $(document).ready(function(){
        toastr.success("{{session('message')}}");
    });
</script>
@endif


@endsection