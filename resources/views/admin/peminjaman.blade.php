@extends('layout.layoutadmin')

@section('content')
<div class="page-inner">
    <div class="page-header">
        <h4 class="page-title">Menu Peminjaman</h4>
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
                            <h4 class="card-title">Peminjaman</h4>
                            <a href="{{ route('admin.peminjaman.tambah') }}" class="btn btn-primary btn-round ml-auto">
                                <i class="fa fa-plus"></i>
                                Tambah
                            </a>
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
                                        <th style="width: 10%">Action</th>
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
                                                <a href="{{ route('admin.peminjaman.edit', ['id' => $d->idpeminjaman]) }}" data-toggle="tooltip" title="Ubah Peminjaman" class="btn btn-link btn-primary btn-lg">
                                                    <i class="fa fa-edit"></i>
                                                </a>
                                                <form action="{{ route('admin.peminjaman.destroy', ['id' => $d->idpeminjaman]) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="button" data-toggle="tooltip" title="Hapus Peminjaman" class="btn btn-link btn-danger deleteButton">
                                                        <i class="fa fa-times"></i>
                                                    </button>
                                                </form>
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
