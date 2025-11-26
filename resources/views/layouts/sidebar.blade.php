@php
    // Ambil role
    $role = auth()->check() ? auth()->user()->role : session('role');
@endphp

<nav class="pcoded-navbar">
    <div class="navbar-wrapper">
        <div class="navbar-content scroll-div">

            <ul class="nav pcoded-inner-navbar">

                {{-- MENU JUDUL --}}
                <li class="nav-item pcoded-menu-caption">
                    <label>Dashboard</label>
                </li>

                {{-- DASHBOARD — SEMUA ROLE BISA --}}
                <li class="nav-item">
                    <a href="{{ url('dashboard') }}" class="nav-link">
                        <span class="pcoded-micon"><i class="feather icon-home"></i></span>
                        <span class="pcoded-mtext">Dashboard</span>
                    </a>
                </li>

                {{-- ========= MENU ADMIN ========= --}}
                @if ($role === 'admin')
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
                            <span class="pcoded-micon"><i class="feather icon-map-pin"></i></span>
                            <span class="pcoded-mtext">Data Lokasi</span>
                        </a>
                    </li>

                    <li class="nav-item pcoded-menu-caption">
                        <label>Users</label>
                    </li>

                    <li class="nav-item">
                        <a href="{{ url('petugas') }}" class="nav-link">
                            <span class="pcoded-micon"><i class="feather icon-user"></i></span>
                            <span class="pcoded-mtext">Daftar Petugas</span>
                        </a>
                    </li>
                @endif
                {{-- ========= END ADMIN ========= --}}

                {{-- ========= MENU PETUGAS ========= --}}
                @if ($role === 'petugas')
                    <li class="nav-item pcoded-menu-caption">
                        <label>Forms Pengajuan</label>
                    </li>

                    <li class="nav-item">
                        <a href="{{ url('pengajuan') }}" class="nav-link">
                            <span class="pcoded-micon"><i class="feather icon-list"></i></span>
                            <span class="pcoded-mtext">Tabel Pengajuan</span>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ url('lokasi') }}" class="nav-link">
                            <span class="pcoded-micon"><i class="feather icon-map-pin"></i></span>
                            <span class="pcoded-mtext">Data Lokasi</span>
                        </a>
                    </li>
                @endif
                {{-- ========= END PETUGAS ========= --}}

                {{-- ========= MENU TAMU ========= --}}
                @if ($role === 'tamu')
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
                @endif
                {{-- ========= END TAMU ========= --}}

            </ul>

        </div>
    </div>
</nav>