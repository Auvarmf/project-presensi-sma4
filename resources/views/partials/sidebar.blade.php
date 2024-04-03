<!-- ======= Sidebar ======= -->
<aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">
        @auth
        <li class="nav-heading mb-1"><img src="{{ asset ('assetlogin/img/logosma4metro.png') }}" alt="" width="100px"></li>

        <li class="nav-item">
            <a class="nav-link {{ Request::is('dashboard') ? '' : 'collapsed'}}" href="/dashboard">
                <i class="bi bi-grid"></i>
                <span>Dashboard</span>
            </a>
        </li><!-- End Dashboard Nav -->

        <li class="nav-heading">Pages</li>

        <li class="nav-item">
            <a class="nav-link {{ Request::is('d/profile') ? '' : 'collapsed'}}" href="/profile">
                <i class="bi bi-person"></i>
                <span>Profile</span>
            </a>
        </li><!-- End Profile Page Nav -->

        <li class="nav-item">
            <a class="nav-link {{ Request::is('/presensi') ? '' : 'collapsed'}}" href="/presensi-siswa">
                <i class="bi bi-upc-scan"></i>
                <span>Presensi</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link {{ Request::is('/jadwal') ? '' : 'collapsed'}}" href="/jadwal">
                <i class="bi bi-book"></i>
                <span>Jadwal Pelajaran</span>
                <ul class="dropdown-menu">
                    <li><a href="#">HTML</a></li>
                    <li><a href="#">CSS</a></li>
                    <li><a href="#">JavaScript</a></li>
                </ul>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link collapsed">
                <form action="/logout" method="post">
                    @csrf
                    <button type="submit" class="dropdown-item d-flex align-items-center"><i class="bi bi-box-arrow-left"></i>Keluar</button>
                </form>
            </a>
        </li><!-- End Login Page Nav -->

        @else
        <li class="nav-item">
            <a class="nav-link {{ Request::is('/') ? '' : 'collapsed'}}" href="/">
                <i class="bi bi-grid"></i>
                <span>Dashboard</span>
            </a>
        </li><!-- End Dashboard Nav -->

        <li class="nav-item">
            <a class="nav-link collapsed" href="/login">
                <i class="bi bi-box-arrow-in-right"></i>
                <span>Masuk</span>
            </a>
        </li><!-- End Login Page Nav -->
        @endauth
    </ul>

</aside><!-- End Sidebar-->