
  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="/admin" class="brand-link">
      <img src="/design/img/h_logo.png" class="brand-image" style="margin-left:45px;">
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        
        <div class="info col-12">
          <a href="#" style="font-size:13px">{{ Auth::user()->name }}님 환영합니다.</a>            
          <a href="#" class="float-right" style="font-size:13px" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">[로그아웃]</a>
          <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" class="d-none">@csrf</form>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- 회원관리 -->
          <li class="nav-item menu-open">
            <a href="#" class="nav-link" >
              <i class="nav-icon fas fa-book"></i>
              <p>
                회원 관리
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="/admin/user" class="nav-link">
                  <i class="far fa-circle"></i>
                  <p>회원 관리</p>
                </a>
              </li>
            </ul>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="/admin/user/experience" class="nav-link">
                  <i class="far fa-circle"></i>
                  <p>체험회원 관리</p>
                </a>
              </li>
            </ul>
          </li>
          <!-- 회원관리 END -->
     

          <!-- 게시판관리 -->
          <li class="nav-item menu-open">
            <a href="#" class="nav-link" >
              <i class="nav-icon fas fa-book"></i>
              <p>
                게시판 관리
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="/admin/bbs_manage" class="nav-link">
                  <i class="far fa-circle"></i>
                  <p>게시글 관리</p>
                  <span class="badge badge-warning right event-cnt"></span>
                </a>
              </li>
            </ul>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="/admin/bbs_manage/board" class="nav-link">
                  <i class="far fa-circle"></i>
                  <p>게시판 관리</p>
                </a>
              </li>
            </ul>
          </li>
          <!-- 게시판관리 END -->

          <!-- 기본정보 -->
          <li class="nav-item menu-open">
            <a href="#" class="nav-link" >
              <i class="nav-icon fas fa-book"></i>
              <p>
                기본 정보 관리
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <!-- <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="far fa-circle"></i>
                  <p>기본정보 설정</p>
                </a>
              </li>
            </ul>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="far fa-circle"></i>
                  <p>이용약관 설정</p>
                </a>
              </li>
            </ul>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="far fa-circle"></i>
                  <p>개인정보처리방침</p>
                </a>
              </li>
            </ul> -->
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="/admin/set" class="nav-link">
                  <i class="far fa-circle"></i>
                  <p>기본 정보 설정</p>
                </a>
              </li>
            </ul>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="/admin/set/popup" class="nav-link">
                  <i class="far fa-circle"></i>
                  <p>팝업 설정</p>
                </a>
              </li>
            </ul>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="/admin/set/log" class="nav-link">
                  <i class="far fa-circle"></i>
                  <p>로그</p>
                </a>
              </li>
            </ul>
          </li>
          <!-- 게시판관리 END -->

           <!-- 기본정보 -->
           <li class="nav-item menu-open">
            <a href="#" class="nav-link" >
              <i class="nav-icon fas fa-book"></i>
              <p>
                관리자 페이지 관리
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="/admin/adm-set/acl" class="nav-link">
                  <i class="far fa-circle"></i>
                  <p>접속 IP 관리</p>
                </a>
              </li>
            </ul>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="/admin/adm-set/member" class="nav-link">
                  <i class="far fa-circle"></i>
                  <p>관리자 계정 관리</p>
                </a>
              </li>
            </ul>
          </li>
          <!-- 게시판관리 END -->

        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>