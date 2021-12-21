<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
            <a href="/admin" class="nav-link">Home</a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
            <a href="/" class="nav-link">홈페이지 바로가기</a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
            <a href="/admin/user" class="nav-link">회원 관리</a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
            <a href="/admin/user/experience" class="nav-link">체험회원 관리</a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
            <a href="/admin/bbs_manage" class="nav-link">게시글 관리</a>
        </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
        <!-- Navbar Search -->
        <li class="nav-item">

        </li>

        <!-- Messages Dropdown Menu -->
        <li class="nav-item dropdown">
            <a class="nav-link" data-toggle="dropdown" href="#">
            <i class="far fa-comments"></i>
            <!-- <span class="badge badge-danger navbar-badge">3</span> -->
            </a>
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right" style="display:none">
            <a href="#" class="dropdown-item">
                <!-- Message Start -->
                <div class="media">
                    <img src="" alt="User Avatar" class="img-size-50 mr-3 img-circle">
                    <div class="media-body">
                        <h3 class="dropdown-item-title">
                        Brad Diesel
                        <span class="float-right text-sm text-danger"><i class="fas fa-star"></i></span>
                        </h3>
                        <p class="text-sm">Call me whenever you can...</p>
                        <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
                    </div>
                </div>
                <!-- Message End -->
            </a>
            <div class="dropdown-divider"></div>
            <a href="#" class="dropdown-item">
                <!-- Message Start -->
                <div class="media">
                <img src="" alt="User Avatar" class="img-size-50 img-circle mr-3">
                <div class="media-body">
                    <h3 class="dropdown-item-title">
                    Nora Silvester
                    <span class="float-right text-sm text-warning"><i class="fas fa-star"></i></span>
                    </h3>
                    <p class="text-sm">The subject goes here</p>
                    <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
                </div>
                </div>
                <!-- Message End -->
            </a>
            <div class="dropdown-divider"></div>
            <a href="#" class="dropdown-item dropdown-footer">See All Messages</a>
            </div>
        </li>
        <!-- Notifications Dropdown Menu -->
        <li class="nav-item dropdown">
            <a class="nav-link" data-toggle="dropdown" href="#">
            <i class="far fa-bell"></i>
            <span class="badge badge-warning navbar-badge" id="tot_event"></span>
            </a>
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right" >
                <span class="dropdown-item dropdown-header" id="tot_event_under" ></span>
                <div class="dropdown-divider"></div>
                <div id="event_list">
                   
                </div>
                <!-- <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a> -->
            </div>
        </li>
    </ul>
</nav>
<!-- /.navbar -->