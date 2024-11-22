<aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">
        <li class="nav-item">
            <a class="nav-link {{ Request::routeIs('dashboard') ? 'active' : 'collapsed' }} " href="{{ route('dashboard') }}">
                <i class="bi bi-grid"></i><span>Dashboard</span>
            </a>

        </li><!-- End Dashboard Nav -->

        <li class="nav-item">
            <a class="nav-link {{ Request::routeIs('employe.*') ? 'active' : 'collapsed' }}" href="{{ route('employe.index') }}">
                <i class="bi bi-journal-text"></i>
                <span>Data Pegawai</span>
            </a>

        </li><!-- End Forms Nav -->

        <li class="nav-item">
            <a class="nav-link {{ Request::routeIs('drop') ? 'active' : 'collapsed' }}" href="{{ route('drop') }}">
                <i class="bi bi-journal-text"></i>
                <span>File Tambahan</span>
            </a>
        </li><!-- End Forms Nav -->

    </ul>

</aside><!-- End Sidebar-->
