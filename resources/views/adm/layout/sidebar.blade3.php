
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
          <a href="#" style="font-size:13px">{{ Auth::user()->name }}({{Auth::user()->rank}},{{Auth::user()->branch}})님 환영합니다.</a>
          <a href="{{ route('logout') }}" class="float-right" style="font-size:13px" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">[로그아웃]</a>
          <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">@csrf</form>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->

          @php $chk_mtitle = 0; @endphp

          @foreach (getSidebar() as $row)
            @if ($chk_mtitle != $row->mtitle_id)
            </li>
              <li class="nav-item menu-open">
                <a href="#" class="nav-link" >
                  <i class="nav-icon {{$row->mtitle_icon}}"></i>
                  <p>
                    {{$row->mtitle_name}}
                    <i class="fas fa-angle-left right"></i>
                  </p>
                </a>
            @endif
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route($row->stitle_route) }}" class="nav-link">
                  <i class="{{$row->stitle_icon}}"></i>
                  <p>{{$row->stitle_name}}</p>
                </a>
              </li>
            </ul>
            @php $chk_mtitle = $row->mtitle_id @endphp
          @endforeach
          
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>