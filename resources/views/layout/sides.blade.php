	<!-- Sidebar -->
    <div class="sidebar">

        <div class="sidebar-background"></div>
        <div class="sidebar-wrapper scrollbar-inner">
            <div class="sidebar-content">
    
                <ul class="nav">
                    <li class="nav-item{{ request()->is('staf/dashboard') ? ' active' : '' }}">
                        <a href="/staf/dashboard">
                            <i class="fas fa-home"></i>
                            <p>Dashboard</p>
                        </a>
                    </li>
                
                    <li class="nav-item{{ request()->is('staf/peminjaman') ? ' active' : '' }}">
                        <a href="/staf/peminjaman">
                            <i class="fas fa-dolly"></i>
                            <p>Peminjaman</p>
                        </a>
                    </li>
    
                    <li class="nav-item{{ request()->is('staf/pengembalian') ? ' active' : '' }}">
                        <a href="/staf/pengembalian">
                            <i class="fas fa-undo-alt"></i>
                            <p>Pengembalian</p>
                        </a>
                    </li>
    
                    <li class="nav-item{{ request()->is('staf/arsiptolak') ? ' active' : '' }}">
                        <a href="/staf/arsiptolak">
                            <i class="fas fa-folder"></i>
                            <p>Arsip Ditolak</p>
                        </a>
                    </li>
    
                    <li class="nav-item{{ request()->is('staf/barang') ? ' active' : '' }}">
                        <a href="/staf/barang">
                            <i class="fas fa-boxes"></i>
                            <p>Barang</p>
                        </a>
                    </li>
    
                    <li class="nav-item{{ request()->is('staf/transportasi') ? ' active' : '' }}">
                        <a href="/staf/transportasi">
                            <i class="fas fa-truck-pickup"></i>
                            <p>Transportasi</p>
                        </a>
                    </li>
    
                    <li class="nav-item{{ request()->is('staf/ruangan') ? ' active' : '' }}">
                        <a href="/staf/ruangan">
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
    