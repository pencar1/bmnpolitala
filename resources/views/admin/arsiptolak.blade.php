@extends('layout.layoutadmin')

@section('content')
<div class="page-inner">
    <div class="page-header">
        <h4 class="page-title">Menu Arsip Di Tolak</h4>
    </div>
    <div class="page-body">
        <div class="row">
            <div class="col-md-12">
                @if (session('success'))
                    <div class="alert alert-success" role="alert">
                        {{ session('success') }}
                    </div>
                @endif
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex align-items-center">
                            <h4 class="card-title">Arsip Di Tolak</h4>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="add-row" class="display table table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Peminjam</th>
                                        <th>Aset Yang Dipinjam</th>
                                        <th>Tanggal Peminjaman</th>
                                        <th>Jumlah Dipinjam</th>
                                        <th>Status</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data as $d)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $d->getNama()}}</td>
                                        <td>{{ $d->getAsetName()}}</td>
                                        <td>{{ \Carbon\Carbon::parse($d->tanggalpeminjaman)->format('d-m-Y') }}</td>
                                        <td>{{ $d->jumlahaset }}</td>
                                        <td>{{ $d->status }}</td>
                                        <td>
                                            <div class="form-button-action">
                                                <a href="{{ route('admin.arsiptolak.detail', ['id' => $d->idpeminjaman]) }}" class="btn btn-link btn-primary btn-lg" data-toggle="tooltip" title="Lihat Detail">
                                                    <i class="fa fa-eye"></i>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Ambil elemen pesan
        var messageElement = document.querySelector('.alert');

        // Tunggu 3 detik, lalu sembunyikan pesan
        setTimeout(function() {
            if (messageElement) {
                messageElement.style.display = 'none';
            }
        }, 4000); // Waktu dalam milidetik (di sini 3000 milidetik = 3 detik)
    });
</script>
@endsection
