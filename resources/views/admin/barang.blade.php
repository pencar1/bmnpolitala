@extends('layout.layoutadmin')

@section('content')
<div class="page-inner">
    <div class="page-header">
        <h4 class="page-title">Menu Barang</h4>
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
                            <h4 class="card-title">Barang</h4>
                            <a href="{{ route('admin.barang.tambah') }}" class="btn btn-primary btn-round ml-auto">
                                <i class="fa fa-plus"></i>
                                Tambah
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="add-row" class="display table table-striped table-hover" >
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Barang</th>
                                        <th>Merk Barang</th>
                                        <th>Stok</th>
                                        <th>Deskripsi</th>
                                        <th>Foto</th>
                                        <th style="width: 10%">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data as $d)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $d->namabarang }}</td>
                                        <td>{{ $d->merkbarang }}</td>
                                        <td>{{ $d->stokbarang }}</td>
                                        <td>{{ $d->deskripsibarang }}</td>
                                        <td class="text-center">
                                            @if ($d->foto)
                                                <img src="{{ asset('images/barang/' . $d->foto) }}" alt="Foto Barang" style="max-width: 100px; margin: 10px auto; border: 2px solid #ccc;">
                                            @else
                                                Tidak ada foto
                                            @endif
                                        </td>
                                        <td>
                                            <div class="form-button-action">
                                                <a href="{{ route('admin.barang.edit', ['id' => $d->idbarang]) }}" data-toggle="tooltip" title="Ubah Barang" class="btn btn-link btn-primary btn-lg">
                                                    <i class="fa fa-edit"></i>
                                                </a>
                                                <form action="{{ route('admin.barang.destroy', ['id' => $d->idbarang]) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="button" data-toggle="tooltip" title="Hapus Barang" class="btn btn-link btn-danger deleteButton">
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
