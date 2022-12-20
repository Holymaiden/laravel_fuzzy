<div class="main-sidebar">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="{{ url('admin') }}">Admin</a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="{{ url('admin') }}">A</a>
        </div>

        <ul class="sidebar-menu">
            <li class="menu-header">Main Menu</li>
            <li class="@stack('dashboard')">
                <a class="nav-link" href="{{ route('dashboard') }}">
                    <i class="fas fa-fire"></i>
                    <span>Dashboard</span>
                </a>
            </li>

            <li class="@stack('classes')">
                <a class="nav-link" href="{{ route('classes') }}">
                    <i class="fas fa-fire"></i>
                    <span>Kelas</span>
                </a>
            </li>

            <li class="@stack('school-years')">
                <a class="nav-link" href="{{ route('school-years') }}">
                    <i class="fas fa-fire"></i>
                    <span>Tahun Ajaran</span>
                </a>
            </li>

            <li class="@stack('students')">
                <a class="nav-link" href="{{ route('students') }}">
                    <i class="fas fa-fire"></i>
                    <span>Siswa</span>
                </a>
            </li>

            <li class="@stack('evaluations')">
                <a class="nav-link" href="{{ route('evaluations') }}">
                    <i class="fas fa-fire"></i>
                    <span>Evaluasi</span>
                </a>
            </li>

            <li class="@stack('users')">
                <a class="nav-link" href="{{ route('users') }}">
                    <i class="fas fa-fire"></i>
                    <span>Users</span>
                </a>
            </li>
            <!-- <li class="nav-item dropdown ">
                <a href="#" class="nav-link has-dropdown">
                    <i class="fas fa-list-alt"></i>
                    <span>Users</span>
                </a>
                <ul class="dropdown-menu">
                    <li class="1">
                        <a class="nav-link" href="{{ url('admin/users') }}">
                            Users
                        </a>
                    </li>

                </ul>
            </li> -->
        </ul>

        <div class="mt-4 mb-4 p-3 hide-sidebar-mini">
            <a href="{{ route('logout') }}" class="btn btn-danger btn-lg btn-block btn-icon-split">
                <i class="fas fa-sign-out-alt"></i> Logout
            </a>
        </div>

    </aside>
</div>