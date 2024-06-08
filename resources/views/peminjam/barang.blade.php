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
									<img class="card-img-top rounded" src="{{ asset('images/barang/' . $d->foto) }}" alt="Foto Barang" alt="Product 1" style="border: 2px solid #ccc;">
                                    @else
                                        Tidak ada foto
                                    @endif
								</div>
								<div class="card-body pt-2">
									<h4 class="mb-1 fw-bold">{{ $d->namabarang }}</h4>
									<p class="text-muted small mb-2">{{ $d->deskripsibarang }}</p>
                                        <button type="submit"  class="btn btn-success">Pinjam</button>
                                        <button type="submit"  class="btn btn-primary">Lihat</button>
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


