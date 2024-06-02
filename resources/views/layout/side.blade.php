	<!-- Sidebar -->
<div class="sidebar">

    <div class="sidebar-background"></div>
    <div class="sidebar-wrapper scrollbar-inner">
        <div class="sidebar-content">

            <ul class="nav">
                <li class="nav-item{{ request()->is('dashboard') ? ' active' : '' }}">
                    <a href="/dashboard">
                        <i class="fas fa-home"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
                <li class="nav-item{{ request()->is('user') ? ' active' : '' }}">
                    <a href="/user">
                        <i class="fas fa-user"></i>
                        <p>User</p>
                    </a>
                </li>
                <li class="nav-item{{ request()->is('peminjaman') ? ' active' : '' }}">
                    <a href="/peminjaman">
                        <i class="fas fa-dolly"></i>
                        <p>Peminjaman</p>
                    </a>
                </li>

                <li class="nav-item{{ request()->is('pengembalian') ? ' active' : '' }}">
                    <a href="/pengembalian">
                        <i class="fas fa-undo-alt"></i>
                        <p>Pengembalian</p>
                    </a>
                </li>

                <li class="nav-item{{ request()->is('arsiptolak') ? ' active' : '' }}">
                    <a href="/arsiptolak">
                        <i class="fas fa-folder"></i>
                        <p>Arsip Ditolak</p>
                    </a>
                </li>

                <li class="nav-item{{ request()->is('barang') ? ' active' : '' }}">
                    <a href="/barang">
                        <i class="fas fa-boxes"></i>
                        <p>Barang</p>
                    </a>
                </li>

                <li class="nav-item{{ request()->is('transportasi') ? ' active' : '' }}">
                    <a href="/transportasi">
                        <i class="fas fa-truck-pickup"></i>
                        <p>Transportasi</p>
                    </a>
                </li>

                <li class="nav-item{{ request()->is('ruangan') ? ' active' : '' }}">
                    <a href="/ruangan">
                        <i class="fas fa-building"></i>
                        <p>Ruangan</p>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>
<!-- End Sidebar -->

<div class="main-panel">
    <div class="content">
        @yield('content')
    </div>
</div>
</div>
</div>
