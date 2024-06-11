{{-- transportasi.blade.php --}}
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
                                <a href="{{ route('peminjam.peminjamantrans.tambah', ['idtransportasi' => $d->idtransportasi]) }}" class="btn btn-success">Pinjam</a>
                                <!-- Hapus tombol Lihat jika tidak digunakan -->
                                <button type="button" class="btn btn-primary">Lihat</button>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
