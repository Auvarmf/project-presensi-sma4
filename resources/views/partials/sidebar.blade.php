<!-- ======= Sidebar ======= -->
<aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">
        <li class="nav-heading mb-1"><img src="{{ asset ('assetlogin/img/logosma4metro.png') }}" alt="" width="100px"></li>
        <hr>

        <li class="nav-item">
            <a class="nav-link {{ Request::is('/') ? '' : 'collapsed'}}" href="/">
                <i class="bi bi-grid"></i>
                <span>Dashboard</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link collapsed" href="/login">
                <i class="bi bi-box-arrow-in-right"></i>
                <span>Masuk</span>
            </a>
        </li>
    </ul>

</aside>
