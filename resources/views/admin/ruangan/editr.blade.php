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
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="namaruangan">Nama Ruangan</label>
                            <input type="text" name="namaruangan" class="form-control" id="namaruangan" value="{{ old('namaruangan', $data->namaruangan) }}" placeholder="Masukkan Nama">
                            @error('namaruangan')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="deskripsiruangan">Deskripsi Ruangan</label>
                            <textarea name="deskripsiruangan" class="form-control" id="deskripsiruangan" placeholder="Masukkan Deskripsi" rows="5">{{ old('deskripsiruangan', $data->deskripsiruangan) }}</textarea>
                            @error('deskripsiruangan')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="card-action">
                        <button type="button" class="btn btn-success saveButton">Simpan</button>
                        <button type="button" class="btn btn-danger" onclick="window.location.href='{{ route('admin.ruangan') }}'">Batal</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
