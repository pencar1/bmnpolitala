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
                            <input type="text" name="namabarang" class="form-control" id="namabarang" value="{{ old('namabarang') }}" placeholder="Masukkan Nama">
                            @error('namabarang')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="merkbarang">Merk Barang</label>
                            <input type="text" name="merkbarang" class="form-control" id="merkbarang" value="{{ old('merkbarang') }}" placeholder="Masukkan Merk">
                            @error('merkbarang')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="stokbarang">Stok Barang</label>
                            <input type="number" name="stokbarang" class="form-control" id="stokbarang" oninput="this.value = this.value.replace(/[^0-9]/g, '')" value="{{ old('stokbarang') }}" placeholder="Masukkan Stok">
                            @error('stokbarang')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="deskripsibarang">Deskripsi Barang</label>
                            <textarea name="deskripsibarang" class="form-control" id="deskripsibarang" placeholder="Masukkan Deskripsi" rows="5">{{ old('deskripsibarang') }}</textarea>
                            @error('deskripsibarang')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="foto">Gambar</label>
                            <input type="file" name="foto" class="form-control" id="foto">
                            @error('foto')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="card-action">
                        <button type="submit" class="btn btn-success saveButton">Simpan</button>
                        <button type="button" class="btn btn-danger" onclick="window.location.href='{{ route('admin.barang') }}'">Batal</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
