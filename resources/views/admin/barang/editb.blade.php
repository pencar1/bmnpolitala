@extends('layout.layoutadmin')

@section('content')

<div class="page-inner">
    <div class="page-header">
        <div class="col-md-12">
            <form action="{{ route('admin.barang.update', ['id' => $data->idbarang]) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">Form Edit Barang</div>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="namabarang">Nama Barang</label>
                            <input type="text" name="namabarang" class="form-control" id="namabarang" value="{{ old('namabarang', $data->namabarang) }}" placeholder="Masukkan Nama">
                            @error('namabarang')
                                <small>{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="merkbarang">Merk Barang</label>
                            <input type="text" name="merkbarang" class="form-control" id="merkbarang" value="{{ old('merkbarang', $data->merkbarang) }}" placeholder="Masukkan Merk">
                            @error('merkbarang')
                                <small>{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="stokbarang">Stok Barang</label>
                            <input type="text" name="stokbarang" class="form-control" id="stokbarang" value="{{ old('stokbarang', $data->stokbarang) }}" placeholder="Masukkan Stok">
                            @error('stokbarang')
                                <small>{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="deskripsibarang">Deskripsi Barang</label>
                            <input type="text" name="deskripsibarang" class="form-control" id="deskripsibarang" value="{{ old('deskripsibarang', $data->deskripsibarang) }}" placeholder="Masukkan Deskripsi">
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
                            @if ($data->foto)
                                <img src="{{ asset('images/barang/' . $data->foto) }}" alt="Foto barang" style="width: 150px; margin-top: 10px;">
                            @endif
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
