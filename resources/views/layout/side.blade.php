	<!-- Sidebar -->
<div class="sidebar">

    <div class="sidebar-background"></div>
    <div class="sidebar-wrapper scrollbar-inner">
        <div class="sidebar-content">

            <ul class="nav">
                <li class="nav-item{{ request()->is('admin/dashboard') ? ' active' : '' }}">
                    <a href="/admin/dashboard">
                        <i class="fas fa-home"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
                <li class="nav-item{{ request()->is('admin/user') ? ' active' : '' }}">
                    <a href="/admin/user">
                        <i class="fas fa-user"></i>
                        <p>User</p>
                    </a>
                </li>
                <li class="nav-item{{ request()->is('admin/peminjaman') ? ' active' : '' }}">
                    <a href="/admin/peminjaman">
                        <i class="fas fa-dolly"></i>
                        <p>Peminjaman</p>
                    </a>
                </li>

                <li class="nav-item{{ request()->is('admin/pengembalian') ? ' active' : '' }}">
                    <a href="/admin/pengembalian">
                        <i class="fas fa-undo-alt"></i>
                        <p>Pengembalian</p>
                    </a>
                </li>

                <li class="nav-item{{ request()->is('admin/arsiptolak') ? ' active' : '' }}">
                    <a href="/admin/arsiptolak">
                        <i class="fas fa-folder"></i>
                        <p>Arsip Ditolak</p>
                    </a>
                </li>

                <li class="nav-item{{ request()->is('admin/barang') ? ' active' : '' }}">
                    <a href="/admin/barang">
                        <i class="fas fa-boxes"></i>
                        <p>Barang</p>
                    </a>
                </li>

                <li class="nav-item{{ request()->is('admin/transportasi') ? ' active' : '' }}">
                    <a href="/admin/transportasi">
                        <i class="fas fa-truck-pickup"></i>
                        <p>Transportasi</p>
                    </a>
                </li>

                <li class="nav-item{{ request()->is('admin/ruangan') ? ' active' : '' }}">
                    <a href="/admin/ruangan">
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
