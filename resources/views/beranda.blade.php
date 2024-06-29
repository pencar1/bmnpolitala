<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8">
        <title>BMN POLITALA</title>
        <meta content="width=device-width, initial-scale=1.0" name="viewport">
        <meta content="" name="keywords">
        <meta content="" name="description">
        <link rel="icon" href="{{ asset('images/logo/logo-bmn.png') }}" type="image/png"> 

        <!-- Google Web Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Jost:wght@500;600&family=Roboto&display=swap" rel="stylesheet"> 

        <!-- Icon Font Stylesheet -->
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css"/>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

        <!-- Libraries Stylesheet -->
        <link rel="stylesheet" href="{{ asset ('travela/assets/lib/owlcarousel/assets/owl.carousel.min.css')}}">
        <link rel="stylesheet" href="{{ asset ('travela/assets/lib/lightbox/css/lightbox.min.css')}}">


        <!-- Customized Bootstrap Stylesheet -->
        <link rel="stylesheet" href="{{ asset ('travela/assets/css/bootstrap.min.css')}}">

        <!-- Template Stylesheet -->
        <link rel="stylesheet" href="{{ asset ('travela/assets/css/style.css')}}">
    </head>

    <body>

        <!-- Spinner Start -->
        <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
            <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>
        <!-- Spinner End -->

        <!-- Navbar & Hero Start -->
        <div class="container-fluid position-relative p-0">
            <nav class="navbar navbar-expand-lg navbar-light px-4 px-lg-5 py-3 py-lg-0">
                <a class="navbar-brand p-0">
                    <h1 class="m-0"><img src="{{ asset ('images/logo/logo-bmn.png')}}" alt="navbar brand" class="navbar-brand" style="width: 50px; height: auto;">BMN POLITALA</h1>
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                    <span class="fa fa-bars"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarCollapse">
                    <div class="navbar-nav ms-auto py-0">
                        <a href="#beranda" class="nav-item nav-link">Beranda</a>
                        <a href="#layanan" class="nav-item nav-link">Layanan</a>
                        <a href="#galeri" class="nav-item nav-link">Galeri</a>
                        <a href="#tentang" class="nav-item nav-link">Tentang</a>
                    </div>
                    <a href="/login" class="btn btn-primary rounded-pill py-2 px-4 ms-lg-4">Login</a>
                </div>
            </nav>
        </div>
        <!-- Navbar & Hero End -->

        <!-- Beranda Start -->
        <div id="beranda" class="carousel-header section">
            <div id="carouselId" class="carousel slide" data-bs-ride="carousel">
                <ol class="carousel-indicators">
                    <li data-bs-target="#carouselId" data-bs-slide-to="0" class="active"></li>
                    <li data-bs-target="#carouselId" data-bs-slide-to="1"></li>
                    <li data-bs-target="#carouselId" data-bs-slide-to="2"></li>
                </ol>
                <div class="carousel-inner" role="listbox">
                    <div class="carousel-item active">
                        <img src="{{ asset ('images/logo/gktd.jpg')}}" class="img-fluid" alt="Logo BMN Politeknik Negeri Tanah Laut">
                        <div class="carousel-caption">
                            <div class="p-3" style="max-width: 900px;">
                                <h4 class="text-white text-uppercase fw-bold mb-4" style="letter-spacing: 3px;">Manajemen BMN Terpadu</h4>
                                <h1 class="display-2 text-capitalize text-white mb-4">Optimalkan Pelayanan dan Efisiensi</h1>
                                <p class="mb-5 fs-5">BMN Politeknik Negeri Tanah Laut berkomitmen untuk mengelola aset negara dengan cermat dan efektif, menyediakan pelayanan terbaik untuk kepentingan pemerintah dan masyarakat.</p>
                            </div>
                        </div>
                    </div>

                    <div class="carousel-item">
                        <img src="{{ asset ('images/logo/gkt.jpg')}}" class="img-fluid" alt="Logo BMN Politeknik Negeri Tanah Laut">
                        <div class="carousel-caption">
                            <div class="p-3" style="max-width: 900px;">
                                <h4 class="text-white text-uppercase fw-bold mb-4" style="letter-spacing: 3px;">Peminjaman Aset BMN</h4>
                                <h1 class="display-2 text-capitalize text-white mb-4">Temukan Aset Yang Anda Butuhkan</h1>
                                <p class="mb-5 fs-5">BMN Politeknik Negeri Tanah Laut menyediakan layanan peminjaman aset dengan proses yang efisien dan transparan, mendukung aktivitas akademik dan operasional kampus.</p>
                            </div>
                        </div>
                    </div>

                    <div class="carousel-item">
                        <img src="{{ asset ('images/logo/gktd.jpg')}}" class="img-fluid" alt="Logo BMN Politeknik Negeri Tanah Laut">
                        <div class="carousel-caption">
                            <div class="p-3" style="max-width: 900px;">
                                <h4 class="text-white text-uppercase fw-bold mb-4" style="letter-spacing: 3px;">Pengembalian Aset BMN</h4>
                                <h1 class="display-2 text-capitalize text-white mb-4">Kembalikan Aset dengan Mudah</h1>
                                <p class="mb-5 fs-5">BMN Politeknik Negeri Tanah Laut memberikan kemudahan dalam proses pengembalian aset, memastikan ketersediaan dan kualitas aset untuk kegiatan selanjutnya.</p>
                            </div>
                        </div>
                    </div>

                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselId" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon btn bg-primary" aria-hidden="false"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselId" data-bs-slide="next">
                    <span class="carousel-control-next-icon btn bg-primary" aria-hidden="false"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
        </div>
        <!-- Beranda End -->

        <!-- Layanan Start -->
        <div id="layanan" class="container-fluid bg-light service py-5 section">
            <div class="container py-5">
                <div class="mx-auto text-center mb-5" style="max-width: 900px;">
                    <h5 class="section-title px-3">Layanan</h5>
                    <h1 class="mb-0">Layanan Kami</h1>
                </div>
                <div class="row g-4">
                    <div class="col-lg-6">
                        <div class="row g-4">
                            <div class="col-12">
                                <div class="service-content-inner d-flex align-items-center bg-white border border-primary rounded p-4 pe-0">
                                    <div class="service-content text-end">
                                        <h5 class="mb-4">Peminjaman & Pengembalian</h5>
                                        <p class="mb-0">Peminjaman & Pengembalian Aset BMN di Politeknik Negeri Tanah Laut adalah sistem web untuk mengelola peminjaman, pengembalian, dan status barang milik negara. Efisiensi dan pengurangan pemborosan waktu adalah tujuannya.
                                        </p>
                                    </div>
                                    <div class="service-icon p-4">
                                        <i class="fa fa-sync fa-4x text-primary"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="service-content-inner d-flex align-items-center  bg-white border border-primary rounded p-4 pe-0">
                                    <div class="service-content text-end">
                                        <h5 class="mb-4">Barang</h5>
                                        <p class="mb-0">Barang di Politeknik Negeri Tanah Laut adalah aset milik negara, termasuk peralatan pendidikan, fasilitas kantor, dan inventaris lainnya, dikelola secara cermat untuk mendukung kegiatan akademik dan operasional kampus.
                                        </p>
                                    </div>
                                    <div class="service-icon p-4">
                                        <i class="fa fa-cubes fa-4x text-primary"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="row g-4">
                            <div class="col-12">
                                <div class="service-content-inner d-flex align-items-center bg-white border border-primary rounded p-4 ps-0">
                                    <div class="service-icon p-4">
                                        <i class="fa fa-car fa-4x text-primary"></i>
                                    </div>
                                    <div class="service-content">
                                        <h5 class="mb-4">Transportasi</h5>
                                        <p class="mb-0">Transportasi di Politeknik Negeri Tanah Laut mencakup kendaraan untuk mendukung mobilitas mahasiswa, staf, dan barang, dirancang untuk layanan aman, nyaman, dan efisien, mendukung operasional dan kegiatan akademik.
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="service-content-inner d-flex align-items-center bg-white border border-primary rounded p-4 ps-0">
                                    <div class="service-icon p-4">
                                        <i class="fa fa-building fa-4x text-primary"></i>
                                    </div>
                                    <div class="service-content">
                                        <h5 class="mb-4">Ruangan</h5>
                                        <p class="mb-0">Ruangan di Politeknik Negeri Tanah Laut mendukung kegiatan akademik, administratif, dan operasional kampus dengan fasilitas yang nyaman dan fungsional. Dikelola secara efektif untuk optimalitas pemanfaatan.
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Layanan End -->

        <!-- Galeri Start -->
        <div id="galeri" class="container-fluid destination py-3 section">
            <div class="container py-3">
                <div class="mx-auto text-center mb-5" style="max-width: 900px;">
                    <h5 class="section-title px-3">Galeri</h5>
                    <h1 class="mb-0">Galeri</h1>
                </div>
                <div class="tab-class text-center">
                    <ul class="nav nav-pills d-inline-flex justify-content-center mb-5">
                        <li class="nav-item">
                            <a class="d-flex py-2 mx-3 border border-primary bg-light rounded-pill" data-bs-toggle="pill" href="#tab-2">
                                <span class="text-dark" style="width: 150px;">Barang</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="d-flex mx-3 py-2 border border-primary bg-light rounded-pill" data-bs-toggle="pill" href="#tab-3">
                                <span class="text-dark" style="width: 150px;">Transportasi</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="d-flex mx-3 py-2 border border-primary bg-light rounded-pill" data-bs-toggle="pill" href="#tab-4">
                                <span class="text-dark" style="width: 150px;">Ruangan</span>
                            </a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        
                        <div id="tab-2" class="tab-pane fade show p-0 active">
                            @php $count = 0; @endphp
                            @foreach ($dataBarang->take(6) as $db)
                                @if ($count % 3 == 0)
                                    <div class="row g-4">
                                @endif
                                <div class="col-lg-4">
                                    <div class="destination-img mb-4">
                                        @if ($db->foto)
                                            <img src="{{ asset('images/barang/' . $db->foto) }}" alt="{{ $db->namabarang }}" style="width: 100%; height: 200px; object-fit: cover;">
                                            <!-- Ubah nilai height sesuai dengan kebutuhan Anda -->
                                            <div class="destination-overlay p-4">
                                                <h4 class="text-white mb-2 mt-3">{{ $db->namabarang }}</h4>
                                            </div>
                                            <div class="search-icon">
                                                <a href="{{ asset('images/barang/' . $db->foto) }}" data-lightbox="destination-tab-2">
                                                    <i class="fa fa-plus-square fa-1x btn btn-light btn-lg-square text-primary"></i>
                                                </a>
                                            </div>
                                        @else
                                            <p>Tidak ada foto</p>
                                        @endif
                                    </div>
                                </div>
                                @if ($count % 3 == 2 || $loop->last)
                                    </div>
                                @endif
                                @php $count++; @endphp
                            @endforeach
                        </div>

                        <div id="tab-3" class="tab-pane fade show p-0">
                            @php $count = 0; @endphp
                            @foreach ($dataTransportasi->take(6) as $dt)
                                @if ($count % 3 == 0)
                                    <div class="row g-4">
                                @endif
                                <div class="col-lg-4">
                                    <div class="destination-img mb-4">
                                        @if ($dt->foto)
                                            <img src="{{ asset('images/transportasi/' . $dt->foto) }}" alt="{{ $dt->namatransportasi }}" style="max-width: 100%; height: 200px; object-fit: cover;">
                                            <div class="destination-overlay p-4">
                                                <h4 class="text-white mb-2 mt-3">{{ $dt->namatransportasi }}</h4>
                                            </div>
                                            <div class="search-icon">
                                                <a href="{{ asset('images/transportasi/' . $dt->foto) }}" data-lightbox="destination-tab-3">
                                                    <i class="fa fa-plus-square fa-1x btn btn-light btn-lg-square text-primary"></i>
                                                </a>
                                            </div>
                                        @else
                                            <p>Tidak ada foto</p>
                                        @endif
                                    </div>
                                </div>
                                @if ($count % 3 == 2 || $loop->last)
                                    </div>
                                @endif
                                @php $count++; @endphp
                            @endforeach
                        </div>

                        <div id="tab-4" class="tab-pane fade show p-0">
                            @php $count = 0; @endphp
                            @foreach ($dataRuangan->take(6) as $dr)
                                @if ($count % 3 == 0)
                                    <div class="row g-4">
                                @endif
                                <div class="col-lg-4">
                                    <div class="destination-img mb-4">
                                        @if ($dr->foto)
                                            <img src="{{ asset('images/ruangan/' . $dr->foto) }}" alt="{{ $dr->namaruangan }}" style="max-width: 100%; height: 200px; object-fit: cover;">
                                            <div class="destination-overlay p-4">
                                                <h4 class="text-white mb-2 mt-3">{{ $dr->namaruangan }}</h4>
                                            </div>
                                            <div class="search-icon">
                                                <a href="{{ asset('images/ruangan/' . $dr->foto) }}" data-lightbox="destination-tab-4">
                                                    <i class="fa fa-plus-square fa-1x btn btn-light btn-lg-square text-primary"></i>
                                                </a>
                                            </div>
                                        @else
                                            <p>Tidak ada foto</p>
                                        @endif
                                    </div>
                                </div>
                                @if ($count % 3 == 2 || $loop->last)
                                    </div>
                                @endif
                                @php $count++; @endphp
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Galeri End -->

        <!-- Tentang Start -->
        <div id="tentang" class="container-fluid about py-5 section">
            <div class="container py-5">
                <div class="row g-5 align-items-center">
                    <div class="col-lg-5">
                        <div class="h-100" style="border: 50px solid; border-color: transparent #13357B transparent #13357B;">
                            <img src="{{ asset ('images/logo/gktd.jpg')}}" class="img-fluid w-100 h-100" alt="">
                        </div>
                    </div>
                    <div class="col-lg-7" style="background: linear-gradient(rgba(255, 255, 255, .8), rgba(255, 255, 255, .8)), url(img/about-img-1.png);">
                        <h5 class="section-about-title pe-3">Tentang</h5>
                        <h1 class="mb-4">Selamat Datang Di <span class="text-primary">BMN POLITALA</span></h1>
                        <p class="mb-4">Barang Milik Negara (BMN) merupakan aset ekonomi yang dikuasai oleh pemerintah untuk penyelenggaraan pemerintahan dan pelayanan masyarakat. Pengelolaannya dilakukan melalui dana APBN atau sumber pendapatan sah lainnya, dan harus dilakukan secara cermat dan efektif. Di Politeknik Negeri Tanah Laut, salah satu gudang BMN digunakan untuk menyimpan barang yang dapat dipinjam oleh mahasiswa dan staf akademik melalui prosedur manual, yang kurang efisien dan memakan banyak waktu.</p>
                        <p class="mb-4">Oleh karena itu, dibutuhkan sistem informasi berbasis web untuk mengelola peminjaman dan pengembalian aset dengan lebih efisien. Sistem ini melibatkan admin yang mengelola data peminjaman, staf BMN yang menangani inventaris, Wakil Direktur 3 yang menyetujui peminjaman, dan peminjam sebagai pengguna akhir. Melalui kerja sama semua pihak, diharapkan sistem ini dapat meningkatkan efisiensi dalam pengelolaan aset BMN di Politeknik Negeri Tanah Laut.</p>
                        <div class="row gy-2 gx-4 mb-4">
                            <div class="col-sm-6">
                                <p class="mb-0"><i class="fa fa-arrow-right text-primary me-2"></i>Peminjaman Barang</p>
                            </div>
                            <div class="col-sm-6">
                                <p class="mb-0"><i class="fa fa-arrow-right text-primary me-2"></i>Pengembalian Barang</p>
                            </div>
                            <div class="col-sm-6">
                                <p class="mb-0"><i class="fa fa-arrow-right text-primary me-2"></i>Peminjaman Transportasi</p>
                            </div>
                            <div class="col-sm-6">
                                <p class="mb-0"><i class="fa fa-arrow-right text-primary me-2"></i>Pengembalian Transportasi</p>
                            </div>
                            <div class="col-sm-6">
                                <p class="mb-0"><i class="fa fa-arrow-right text-primary me-2"></i>Peminjaman Ruangan</p>
                            </div>
                            <div class="col-sm-6">
                                <p class="mb-0"><i class="fa fa-arrow-right text-primary me-2"></i>Pengembalian Ruangan</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Tentang End -->

        <!-- Footer Start -->
        <div class="container-fluid footer py-3">
            <div class="container py-3">
                <div class="row g-5 justify-content-center">
                    <div class="col-md-6 col-lg-9">
                        <div class="footer-item d-flex justify-content-between">
                            <a href="" class="d-flex flex-column align-items-center">
                                <i class="fas fa-home mb-2"></i>
                                <span>Jl. A. Yani Km.06 Desa Panggung, Kec. Pelaihari, Tanah Laut, Kalimantan Selatan, Indonesia</span>
                            </a>
                            <a href="" class="d-flex flex-column align-items-center">
                                <i class="fas fa-envelope mb-2"></i>
                                <span>bmn@politala.ac.id</span>
                            </a>
                            <a href="" class="d-flex flex-column align-items-center">
                                <i class="fab fa-instagram mb-2"></i>
                                <span>bmn_politala</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Footer End -->
        
        <!-- Copyright Start -->
        <div class="container-fluid copyright text-body py-4">
            <div class="container">
                <div class="row g-4 align-items-center">
                    <div class="col-md-6 text-center text-md-end mb-md-0">
                        <i class="fas fa-copyright me-2"></i><a class="text-white" href="#">BMN POLITALA</a>, All right reserved.
                    </div>
                    <div class="col-md-6 text-center text-md-start">
                        Designed By <a class="text-white" href="https://politala.ac.id/">Politeknik Negeri Tanah Laut</a>
                    </div>
                </div>
            </div>
        </div>
        <!-- Copyright End -->

        <!-- Back to Top -->
        <a href="#" class="btn btn-primary btn-primary-outline-0 btn-md-square back-to-top"><i class="fa fa-arrow-up"></i></a>   

        
        <!-- JavaScript Libraries -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
        <script src="{{ asset ('travela/assets/lib/easing/easing.min.js')}}"></script>
        <script src="{{ asset ('travela/assets/lib/waypoints/waypoints.min.js')}}"></script>
        <script src="{{ asset ('travela/assets/lib/owlcarousel/owl.carousel.min.js')}}"></script>
        <script src="{{ asset ('travela/assets/lib/lightbox/js/lightbox.min.js')}}"></script>

        <!-- Template Javascript -->
        <script src="{{ asset ('travela/assets/js/main.js')}}"></script>
        <script>
            // Function untuk menambahkan kelas active ke tautan navigasi yang sesuai dengan bagian saat ini
            function setActiveNavLink() {
                var sections = document.querySelectorAll('.section');
                var navLinks = document.querySelectorAll('.nav-link');

                sections.forEach(function(section, index) {
                    var top = section.offsetTop - 50; // Adjusted for any fixed headers or margins

                    if (window.scrollY >= top) {
                        navLinks.forEach(function(navLink) {
                            navLink.classList.remove('active');
                        });

                        navLinks[index].classList.add('active');
                    }
                });
            }

            // Event listener untuk memantau perubahan posisi scroll
            window.addEventListener('scroll', setActiveNavLink);

            // Panggil setActiveNavLink saat halaman dimuat untuk menetapkan kelas active secara awal
            window.addEventListener('DOMContentLoaded', setActiveNavLink);
        </script>


    </body>

</html>