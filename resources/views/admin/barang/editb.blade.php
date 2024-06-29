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
                            <div class="form-group text-center">
                            @if ($data->foto)
                                <img src="{{ asset('images/barang/' . $data->foto) }}" alt="Foto barang" style="display: block; max-width: 300px; margin: 10px auto; border: 2px solid #ccc;"">
                                <br>
                            @endif
                            </div>
                            <label for="foto">Gambar</label>
                            <input type="file" name="foto" class="form-control" id="foto">
                            @error('foto')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="namabarang">Nama Barang</label>
                            <input type="text" name="namabarang" class="form-control" id="namabarang" value="{{ old('namabarang', $data->namabarang) }}" placeholder="Masukkan Nama">
                            @error('namabarang')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="merkbarang">Merk Barang</label>
                            <input type="text" name="merkbarang" class="form-control" id="merkbarang" value="{{ old('merkbarang', $data->merkbarang) }}" placeholder="Masukkan Merk">
                            @error('merkbarang')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="stokbarang">Stok Barang</label>
                            <input type="number" name="stokbarang" class="form-control" id="stokbarang" value="{{ old('stokbarang', $data->stokbarang) }}" oninput="this.value = this.value.replace(/[^0-9]/g, '')" placeholder="Masukkan Stok">
                            @error('stokbarang')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="deskripsibarang">Deskripsi Barang</label>
                            <textarea name="deskripsibarang" class="form-control" id="deskripsibarang" placeholder="Masukkan Deskripsi" rows="5">{{ old('deskripsibarang', $data->deskripsibarang) }}</textarea>
                            @error('deskripsibarang')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="card-action">
                        <button type="button" class="btn btn-success saveButton">Simpan</button>
                        <button type="button" class="btn btn-danger" onclick="window.location.href='{{ route('admin.barang') }}'">Batal</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
