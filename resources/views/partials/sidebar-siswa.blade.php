<!-- ======= Sidebar ======= -->
<aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">
        <li class="nav-heading mb-1"><img src="{{ asset ('assetlogin/img/logosma4metro.png') }}" alt="" width="100px"></li>
        <hr>

        <li class="nav-item">
            <a class="nav-link {{ Request::is('dashboard') ? '' : 'collapsed'}}" href="/dashboard">
                <i class="bi bi-grid"></i>
                <span>Dashboard</span>
            </a>
        </li>

        <li class="nav-heading">Pages</li>

        <li class="nav-item">
            <a class="nav-link {{ Request::is('dashboard/profile') ? '' : 'collapsed'}}" href="/dashboard/profile">
                <i class="bi bi-person"></i>
                <span>Profile</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link {{ Request::is('/presensi') ? '' : 'collapsed'}}" href="/presensi">
                <i class="bi bi-upc-scan"></i>
                <span>QR Kehadiran</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link {{ Request::is('/presensi') ? '' : 'collapsed'}}" href="/presensi">
                <i class="bi bi-upc-scan"></i>
                <span>Jadwal</span>
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
