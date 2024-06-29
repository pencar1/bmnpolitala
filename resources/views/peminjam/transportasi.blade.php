@extends('layout.layoutpeminjam')

@section('content')
<div class="page-inner">
    <div class="page-header d-flex justify-content-between align-items-center">
        <h4 class="page-title">Menu Transportasi</h4>
        <form action="{{ route('peminjam.transportasi.search') }}" method="GET" class="col-sm-6 col-lg-3">
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
                                <img class="card-img-top rounded" src="{{ asset('images/transportasi/' . $d->foto) }}" alt="Foto Transportasi" style="width: 100%; height: 200px; object-fit: cover; border: 2px solid #ccc; border-radius: 0.375rem;">
                                @else
                                <p class="text-center">Tidak ada foto</p>
                                @endif
                            </div>
                            <div class="card-body pt-2">
                                <h4 class="mb-1 fw-bold">{{ $d->namatransportasi }}</h4>
                                <p class="text-muted small mb-2">{{ $d->deskripsitransportasi }}</p>
                                <!-- Perbarui link untuk menambah peminjaman transportasi -->
                                <a href="{{ route('peminjam.peminjamantrans.tambah', ['idTransportasi' => $d->idtransportasi]) }}" class="btn btn-success">Pinjam</a>
                                <!-- Hapus tombol Lihat jika tidak digunakan -->
                              
                                <a href="{{ route('peminjam.transportasi', ['lihat' => $d->idtransportasi]) }}" class="btn btn-primary">Lihat</a>
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
@if(request('lihat') && $detailtransportasi)
<div class="modal fade show" id="lihatModal" tabindex="-1" role="dialog" aria-labelledby="lihatModalLabel" aria-hidden="true" style="display: block;">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="lihatModalLabel">Detail transportasi</h5>
                <a href="{{ url()->previous() }}" class="close" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </a>
            </div>
            <div class="modal-body" style="max-height: 600px; overflow-y: auto;">
                <div class="form-group text-center">
                    @if ($detailtransportasi->foto)
                        <img src="{{ asset('images/transportasi/' . $detailtransportasi->foto) }}" alt="Foto transportasi" style="display: block; max-width: 300px; margin: 10px auto; border: 2px solid #ccc;">
                    @else
                        <p>Tidak ada foto</p>
                    @endif
                </div>
                <div class="form-group">
                    <label for="namatransportasi">Nama transportasi</label>
                    <input type="text" class="form-control" id="namatransportasi" value="{{ $detailtransportasi->namatransportasi }}" readonly style="font-weight: bold; color: black;">
                </div>
                <div class="form-group">
                    <label for="merktransportasi">Merk transportasi</label>
                    <input type="text" class="form-control" id="merktransportasi" value="{{ $detailtransportasi->merktransportasi }}" readonly style="font-weight: bold; color: black;">
                </div>
                <div class="form-group">
                    <label for="stoktransportasi">Stok transportasi</label>
                    <input type="text" class="form-control" id="stoktransportasi" value="{{ $detailtransportasi->stoktransportasi }}" readonly style="font-weight: bold; color: black;">
                </div>
                <div class="form-group">
                    <label for="deskripsitransportasi">Deskripsi transportasi</label>
                    <textarea class="form-control" id="deskripsitransportasi" rows="5" readonly style="font-weight: bold; color: black;">{{ $detailtransportasi->deskripsitransportasi }}</textarea>
                </div>
            </div>
        </div>
    </div>
</div>
@endif

@endsection
