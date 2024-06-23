@extends('layout.layoutadmin')

@section('content')

<div class="page-inner">
    <div class="page-header">
        <div class="col-md-12">
            <form action="{{ route('admin.ruangan.update', ['id' => $data->idruangan]) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">Form Edit Ruangan</div>
                    </div>
                    <div class="card-body">
                        <div class="form-group text-center">
                            @if ($data->foto)
                                <img src="{{ asset('images/ruangan/' . $data->foto) }}" alt="Foto ruangan" style="display: block; max-width: 300px; margin: 10px auto; border: 2px solid #ccc;">
                                <br>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="foto">Gambar</label>
                            <input type="file" name="foto" class="form-control" id="foto">
                            @error('foto')
                                <small>{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="namaruangan">Nama Ruangan</label>
                            <input type="text" name="namaruangan" class="form-control" id="namaruangan" value="{{ old('namaruangan', $data->namaruangan) }}" placeholder="Masukkan Nama">
                            @error('namaruangan')
                                <small>{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="deskripsiruangan">Deskripsi Ruangan</label>
                            <input type="text" name="deskripsiruangan" class="form-control" id="deskripsiruangan" value="{{ old('deskripsiruangan', $data->deskripsiruangan) }}" placeholder="Masukkan Deskripsi">
                            @error('deskripsiruangan')
                                <small>{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="card-action">
                        <button type="submit" class="btn btn-success">Simpan</button>
                        <button type="button" class="btn btn-danger" onclick="window.location.href='{{ route('admin.ruangan') }}'">Batal</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
