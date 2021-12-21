<html lang="ko">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title')</title>

    <!-- Font Awesome -->
    <link rel="stylesheet" href="/adm/plugins/fontawesome-free/css/all.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="/adm/css/adminlte.min.css">
    
    @yield('style')    
    <style>
        .nav-treeview .nav-item a { font-size:13px }
        .nav-treeview .nav-item a i { margin-left:5px; margin-right:5px }
    </style>
    
</head>

<!-- <body class="hold-transition sidebar-mini"> -->
<body class="sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
    
    <div class="wrapper">

        @include('adm.layout.topNavi')

        @include('adm.layout.sidebar2')

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper" style="height:auto;">
            @yield('body')
        </div>
        <!-- /.content-wrapper -->

        <footer class="main-footer">
            <div class="float-right d-none d-sm-block">
                <b>Version</b> 3.1.0
            </div>
            <strong>Copyright &copy; 2021~ <a href="/admin">ginvestADM</a>.</strong> All rights reserved
        </footer>
    </div>

<!-- ./wrapper -->

<!-- jQuery -->
<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script> -->
<script src="/adm/js/jquery/3.6.0/jquery.min.js"></script>

<!-- Bootstrap 4 -->
<!-- <script src="/plugins/bootstrap/js/bootstrap.bundle.min.js"></script> -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>

<!-- AdminLTE App -->
<script src="/adm/js/adminlte.min.js"></script>

<script>
    getNewEvent();

    // 메뉴 active
    $(function () {
        var url = window.location.pathname,
        urlRegExp = new RegExp(url.replace(/\/$/, '') + "$");  
        $('a').each(function () {
            if (urlRegExp.test(this.href.replace(/\/$/, ''))) {
                $(this).addClass('active');
            }
        });
    });

    // 신규 게시글 알림창
    function getNewEvent() {
        $.ajax({
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            url: "{{ route('new.event') }}",
            type: "GET",
            dataType: 'json',
            success:function(data){
                if(data.status == "success"){
                    var res = data.data;
                    if(res.post > 0){
                        // 메뉴 상단에 메세지 띄우기
                        $("#tot_event").text(res.post);
                        $("#tot_event_under").text(res.post+"개의 알람이 있습니다.");
                        var post_cnt = '<a href="/admin/bbs_manage" class="dropdown-item">';
                        post_cnt += '<i class="fas fa-sticky-note mr-2"></i>';
                        post_cnt += '신규 게시글';
                        post_cnt += '<span id="" class="float-right text-muted text-sm">'+res.post+'건</span>';
                        post_cnt += '</a>';
                        $("#event_list").html(post_cnt);

                        //사이드바 메뉴에 띄우기
                        $("a[href$='/admin/bbs_manage']").children(".event-cnt").text(res.post);
                    } else {
                        $("#tot_event").text();
                        $("#tot_event_under").text("알람이 없습니다.");
                        $("#event_list").html('');
                    }
                }
            },
            error:function(jqXHR, textStatus, errorThrown){
                alert("에러 발생~~ \n" + textStatus + " : " + errorThrown);
                console.log(data);
                self.close();
            }
        });
    }

</script>

@yield('script')

</body>
</html>
