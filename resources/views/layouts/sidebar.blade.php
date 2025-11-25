<nav class="pcoded-navbar">
    <div class="navbar-wrapper">
        <div class="navbar-content scroll-div">
            {{-- MENU --}}
            <ul class="nav pcoded-inner-navbar">

                <li class="nav-item pcoded-menu-caption">
                    <label>Dashboard</label>
                </li>

                {{-- DASHBOARD --}}
                <li class="nav-item">
                    <a href="{{ url('dashboard') }}" class="nav-link">
                        <span class="pcoded-micon"><i class="feather icon-home"></i></span>
                        <span class="pcoded-mtext">Dashboard</span>
                    </a>
                </li>

                {{-- For Pengajuan --}}
                <li class="nav-item pcoded-menu-caption">
                    <label>Forms Pengajuan</label>
                </li>

                <li class="nav-item">
                    <a href="{{ url('pengajuan/create') }}" class="nav-link">
                        <span class="pcoded-micon"><i class="feather icon-plus"></i></span>
                        <span class="pcoded-mtext">Tambah Pengajuan</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ url('pengajuan') }}" class="nav-link">
                        <span class="pcoded-micon"><i class="feather icon-list"></i></span>
                        <span class="pcoded-mtext">Tabel Pengajuan</span>
                    </a>
                </li>
                
                <li class="nav-item">
                    <a href="{{ url('lokasi') }}" class="nav-link">
                        <span class="pcoded-micon"><i class="feather icon-align-justify"></i></span>
                        <span class="pcoded-mtext">Data Lokasi</span>
                    </a>
                </li>

                {{-- User Petugas --}}
                <li class="nav-item pcoded-menu-caption">
                    <label>Users</label>
                </li>

                <li class="nav-item">
                    <a href="{{ url('petugas') }}" class="nav-link">
                        <span class="pcoded-micon"><i class="feather icon-user"></i></span>
                        <span class="pcoded-mtext">Daftar Petugas</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>
