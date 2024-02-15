<!-- ======= Sidebar ======= -->
<aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">
        <li class="nav-heading mb-1"><img src="{{ asset ('assetlogin/img/logosma4metro.png') }}" alt="" width="100px"></li>
        <hr>

        <li class="nav-item">
            <a class="nav-link {{ Request::is('dashboard') ? '' : 'collapsed'}}" href="{{route('dashboard')}}">
                <i class="bi bi-grid"></i>
                <span>Dashboard</span>
            </a>
        </li>

        <li class="nav-heading">Pages</li>

        <li class="nav-item">
            <a class="nav-link {{ Request::is('dashboard/profile') ? '' : 'collapsed'}}" href="{{route('profile-admin')}}">
                <i class="bi bi-person"></i>
                <span>Profile</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link {{ Request::is('dashboard/user') ? '' : 'collapsed'}}" href="{{route('user.index')}}">
                <i class="bi bi-person"></i>
                <span>Kelola Akun</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link {{ Request::is('dashboard/mapel') ? '' : 'collapsed'}}" href="{{route('mapel.index')}}">
                <i class="bi bi-person"></i>
                <span>Kelola Mata Pelajaran</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link {{ Request::is('dashboard/kelas') ? '' : 'collapsed'}}" href="{{route('kelas.index')}}">
                <i class="bi bi-person"></i>
                <span>Kelola Kelas</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link {{ Request::is('dashboard/jadwal') ? '' : 'collapsed'}}" href="/presensi">
                <i class="bi bi-upc-scan"></i>
                <span>Daftar Jadwal</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link collapsed">
                <form action="/logout" method="post">
                    @csrf
                    <button type="submit" class="dropdown-item d-flex align-items-center"><i class="bi bi-box-arrow-left"></i>Keluar</button>
                </form>
            </a>
        </li>
    </ul>

</aside>
