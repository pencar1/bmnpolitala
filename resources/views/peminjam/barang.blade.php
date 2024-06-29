<!-- daftar_barang.blade.php -->
@extends('layout.layoutpeminjam')

@section('content')

<div class="page-inner">
    <div class="page-header d-flex justify-content-between align-items-center">
        <h4 class="page-title">Menu Barang</h4>
        <form action="{{ route('peminjam.barang.search') }}" method="GET" class="col-sm-6 col-lg-3">
            <div class="input-group">
                <input type="text" name="query" id="search-input" placeholder="Search ..." class="form-control">
                <div class="input-group-append">
                    <button type="submit" class="btn">
                        <i class="fa fa-search search-icon"></i>
                    </button>
                </div>
            </div>
        </form>
    </div>
    <div class="page-body">
        <div class="row">
            <div class="col-md-12">
                <div class="row row-projects" id="search-results">
                    @foreach ($data as $d)
                    <div class="col-sm-6 col-lg-3">
                        <div class="card">
                            <div class="p-2">
                                @if ($d->foto)
                                <img class="card-img-top rounded" src="{{ asset('images/barang/' . $d->foto) }}" alt="Foto Barang" style="width: 100%; height: 200px; object-fit: cover; border: 2px solid #ccc;">
                                @else
                                Tidak ada foto
                                @endif
                            </div>
                            <div class="card-body pt-2">
                                <h4 class="mb-1 fw-bold">{{ $d->namabarang }}</h4>
                                <p class="text-muted small mb-2">{{ $d->deskripsibarang }}</p>
                                <a href="{{ route('peminjam.peminjaman.tambah', ['idbarang' => $d->idbarang]) }}" class="btn btn-success">
                                    Pinjam
                                </a>
                                <a href="{{ route('peminjam.barang', ['lihat' => $d->idbarang]) }}" class="btn btn-primary">
                                    Lihat
                                </a>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
@if(request('lihat') && $detailBarang)
<div class="modal fade show" id="lihatModal" tabindex="-1" role="dialog" aria-labelledby="lihatModalLabel" aria-hidden="true" style="display: block;">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="lihatModalLabel">Detail Barang</h5>
                <a href="{{ url()->previous() }}" class="close" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </a>
            </div>
            <div class="modal-body" style="max-height: 600px; overflow-y: auto;">
                <div class="form-group text-center">
                    @if ($detailBarang->foto)
                        <img src="{{ asset('images/barang/' . $detailBarang->foto) }}" alt="Foto barang" style="display: block; max-width: 300px; margin: 10px auto; border: 2px solid #ccc;">
                    @else
                        <p>Tidak ada foto</p>
                    @endif
                </div>
                <div class="form-group">
                    <label for="namabarang">Nama Barang</label>
                    <input type="text" class="form-control" id="namabarang" value="{{ $detailBarang->namabarang }}" readonly style="font-weight: bold; color: black;">
                </div>
                <div class="form-group">
                    <label for="merkbarang">Merk Barang</label>
                    <input type="text" class="form-control" id="merkbarang" value="{{ $detailBarang->merkbarang }}" readonly style="font-weight: bold; color: black;">
                </div>
                <div class="form-group">
                    <label for="stokbarang">Stok Barang</label>
                    <input type="text" class="form-control" id="stokbarang" value="{{ $detailBarang->stokbarang }}" readonly style="font-weight: bold; color: black;">
                </div>
                <div class="form-group">
                    <label for="deskripsibarang">Deskripsi Barang</label>
                    <textarea class="form-control" id="deskripsibarang" rows="5" readonly style="font-weight: bold; color: black;">{{ $detailBarang->deskripsibarang }}</textarea>
                </div>
            </div>
        </div>
    </div>
</div>
@endif
@endsection
