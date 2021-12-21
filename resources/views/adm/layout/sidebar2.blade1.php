
  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="#" class="brand-link">
      <!-- <img src="../../dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8"> -->
      <span class="brand-text font-weight-bold" style="font-size:18px">관리자 페이지</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        
        <div class="info col-12">
          <a href="#" style="font-size:13px">{{ Auth::user()->name }}({{Auth::user()->code}},{{Auth::user()->branch}})님 환영합니다.</a>
          <a href="{{ route('logout') }}" class="float-right" style="font-size:13px" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">[로그아웃]</a>
          <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">@csrf</form>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->

          <!-- 알림판 -->
          <li class="nav-item menu-open">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                알림판
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('customer.customers') }}" class="nav-link">
                  <i class="far fa-circle"></i>
                  <p>회원 관리</p>
                </a>
              </li>
            </ul>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('branch.list') }}" class="nav-link">
                  <i class="far fa-circle"></i>
                  <p>지점 관리</p>
                </a>
              </li>
            </ul>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('customer-rank.list') }}" class="nav-link">
                  <i class="far fa-circle "></i>
                  <p>회원등급 관리</p>
                </a>
              </li>
            </ul>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('meche.list') }}" class="nav-link">
                  <i class="far fa-circle"></i>
                  <p>매체 관리</p>
                </a>
              </li>
            </ul>
            <ul class="nav nav-treeview">
              <li class="nav-item" >
                <a href="{{ route('member.list') }}" class="nav-link">
                  <i class="far fa-circle"></i>
                  <p>직원 관리</p>
                </a>
              </li>
            </ul>
          </li>
          <!-- ./알림판 END -->

          <li class="nav-item menu-open">
            <a href="#" class="nav-link" >
              <i class="nav-icon fas fa-book"></i>
              <p>
                설정
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('basic-conf') }}" class="nav-link">
                  <i class="far fa-circle"></i>
                  <p>기본환경설정</p>
                </a>
              </li>
            </ul>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('login_his') }}" class="nav-link">
                  <i class="far fa-circle"></i>
                  <p>로그인 이력조회</p>
                </a>
              </li>
            </ul>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('user_auth') }}" class="nav-link">
                  <i class="far fa-circle"></i>
                  <p>권한 설정</p>
                </a>
              </li>
            </ul>
          </li>
          
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>