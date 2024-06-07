	<!-- Sidebar -->
    <div class="sidebar">

        <div class="sidebar-background"></div>
        <div class="sidebar-wrapper scrollbar-inner">
            <div class="sidebar-content">
    
                <ul class="nav">
                    <li class="nav-item{{ request()->is('peminjam/dashboard') ? ' active' : '' }}">
                        <a href="/peminjam/dashboard">
                            <i class="fas fa-home"></i>
                            <p>Dashboard</p>
                        </a>
                    </li>
              
                    
    
                    <li class="nav-item{{ request()->is('peminjam/barang') ? ' active' : '' }}">
                        <a href="/peminjam/barang">
                            <i class="fas fa-boxes"></i>
                            <p>Barang</p>
                        </a>
                    </li>
    
                    <li class="nav-item{{ request()->is('peminjam/transportasi') ? ' active' : '' }}">
                        <a href="/peminjam/transportasi">
                            <i class="fas fa-truck-pickup"></i>
                            <p>Transportasi</p>
                        </a>
                    </li>
    
                    <li class="nav-item{{ request()->is('peminjam/ruangan') ? ' active' : '' }}">
                        <a href="/peminjam/ruangan">
                            <i class="fas fa-building"></i>
                            <p>Ruangan</p>
                        </a>
                    </li>

                    <li class="nav-item{{ request()->is('peminjam/peminjaman') ? ' active' : '' }}">
                        <a href="/peminjam/peminjaman">
                            <i class="fas fa-user"></i>
                            <p>Peminjaman</p>
                        </a>
                    </li>

                    <li class="nav-item{{ request()->is('peminjam/arsipditolak') ? ' active' : '' }}">
                        <a href="/peminjam/arsipditolak">
                            <i class="fas fa-user"></i>
                            <p>Arsip Ditolak</p>
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
    