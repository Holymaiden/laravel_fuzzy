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

            @if (Auth::user()->role->role == 'A')

            <li class="@stack('classes')">
                <a class="nav-link" href="{{ route('classes') }}">
                    <i class="fas fa-school"></i>
                    <span>Kelas</span>
                </a>
            </li>

            <li class="@stack('school-years')">
                <a class="nav-link" href="{{ route('school-years') }}">
                    <i class="fas fa-graduation-cap"></i>
                    <span>Tahun Ajaran</span>
                </a>
            </li>

            @endif

            <li class="@stack('students')">
                <a class="nav-link" href="{{ route('students') }}">
                    <i class="fas fa-chalkboard-teacher"></i>
                    <span>Siswa</span>
                </a>
            </li>

            @if (Auth::user()->role->role == 'A')

            <li class="@stack('evaluations')">
                <a class="nav-link" href="{{ route('evaluations') }}">
                    <i class="fab fa-connectdevelop"></i>
                    <span>Evaluasi</span>
                </a>
            </li>
            <li class="@stack('fuzzy-mamdani')">
                <a class="nav-link" href="{{ route('fuzzy-mamdani') }}">
                    <i class="fas fa-atom"></i>
                    <span>Penilaian Siswa</span>
                </a>
            </li>
            <li class="@stack('users')">
                <a class="nav-link" href="{{ route('users') }}">
                    <i class="fas fa-users"></i>
                    <span>Users</span>
                </a>
            </li>

            @endif

            @if (Auth::user()->role->role != 'A')

            <li class="@stack('penilaian')">
                <a class="nav-link" href="{{ route('penilaian') }}">
                    <i class="fab fa-connectdevelop"></i>
                    <span>Penilaian Siswa</span>
                </a>
            </li>

            @endif
        </ul>

        <div class="mt-4 mb-4 p-3 hide-sidebar-mini">
            <a href="{{ route('logout') }}" class="btn btn-danger btn-lg btn-block btn-icon-split">
                <i class="fas fa-sign-out-alt"></i> Logout
            </a>
        </div>

    </aside>
</div>