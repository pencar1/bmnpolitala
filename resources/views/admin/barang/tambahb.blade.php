@extends('layout.layoutadmin')

@section('content')

<div class="page-inner">
    <div class="page-header">
        <div class="col-md-12">
            <form action="{{ route('admin.barang.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">Form Tambah Barang</div>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="namabarang">Nama Barang</label>
                            <input type="text" name="namabarang" class="form-control" id="namabarang" placeholder="Masukkan Nama">
                            @error('namabarang')
                                <small>{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="merkbarang">Merk Barang</label>
                            <input type="text" name="merkbarang" class="form-control" id="merkbarang" placeholder="Masukkan Merk">
                            @error('merkbarang')
                                <small>{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="stokbarang">Stok Barang</label>
                            <input type="text" name="stokbarang" class="form-control" id="stokbarang" placeholder="Masukkan Stok">
                            @error('stokbarang')
                                <small>{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="deskripsibarang">Deskripsi Barang</label>
                            <input type="text" name="deskripsibarang" class="form-control" id="deskripsibarang" placeholder="Masukkan Deskripsi">
                            @error('deskripsibarang')
                                <small>{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="foto">Gambar</label>
                            <input type="file" name="foto" class="form-control" id="foto">
                            @error('foto')
                                <small>{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="card-action">
                        <button type="submit" class="btn btn-success">Simpan</button>
                        <button type="button" class="btn btn-danger" onclick="window.location.href='{{ route('admin.barang') }}'">Batal</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
