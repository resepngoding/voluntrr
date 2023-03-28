<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="/" class="brand-link">
      <img src="{{asset('backend/dist/img/AdminLTELogo.png')}}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">Voluntrr</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{asset('backend/dist/img/user2-160x160.jpg')}}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">{{ auth()->user()->role}}</a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">


        @can('admin')

        <ul class="nav nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
               <li class="nav-header">ADMIN MENU</li>
              <li class="nav-item">
                <a href="{{route('admin.users')}}" class="nav-link {{ (request()->is('admin/users')) ? 'active' :'' }}">
                    <i class="fa fa-user nav-icon"></i>
                  <p>Users</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('admin.teams')}}" class="nav-link {{ (request()->is('admin/teams')) ? 'active' :'' }}" >
                    <i class="fa fa-users nav-icon"></i>
                  <p>Teams</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('admin.accounts')}}" class="nav-link {{ (request()->is('admin/rekening')) ? 'active' :'' }}" >
                    <i class="nav-icon fas fa-book"></i>
                  <p>Accounts</p>
                </a>
              </li>

          <hr>
        </ul>
     @endcan
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <!-- Add icons to the links using the .nav-icon class
                 with font-awesome or any other icon font library -->

                 <li class="nav-header">DATA ENTRY MENU</li>
                 <li class="nav-item">
                    <a href="{{route('dashboard')}}" class="nav-link {{ (request()->is('dashboard')) ? 'active' :'' }}" >
                        <i class="nav-icon fas fa-chart-pie"></i>
                    <p>
                    DASHBOARD
                    </p>
                    </a>
                    </li>
                 <li class="nav-item">
                <a href="{{route('admin.donors')}}" class="nav-link {{ (request()->is('admin/donatur')) ? 'active' :'' }}" >
                <i class="fa fa-users nav-icon"></i>
                <p>
                  List Donatur
                  {{-- <span class="right badge badge-danger">New</span> --}}
                </p>
              </a>
            </li>

            <li class="nav-item">
                <a href="{{route('admin.donations-list')}}" class="nav-link {{ (request()->is('admin/list-donasi')) ? 'active' :'' }}" >
                <i class="nav-icon fas fa-copy"></i>
                <p>
                  List Donasi
                  {{-- <span class="right badge badge-danger">New</span> --}}
                </p>
              </a>
            </li>
            <hr>
            <li class="nav-item">
              <form action="{{ route('logout') }}" method="post">
                  @csrf
                     <a href="{{ route('logout') }}" class="nav-link" onclick="event.preventDefault(); this.closest('form').submit();">
                      <i class="nav-icon fas fa-sign-out-alt"></i>
                      <p>
                        Logout
                      </p>
                    </a>
              </form>
            </li>
          </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
