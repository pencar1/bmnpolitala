@extends('layout.layoutstaf')

@section('content')

<div class="page-inner">
    <div class="page-header">
        <div class="col-md-12">
            <form action="{{ route('staf.ruangan.update', ['id' => $data->idruangan]) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">Form Edit ruangan</div>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <div class="form-group text-center">
                            @if ($data->foto)
                                <img src="{{ asset('images/ruangan/' . $data->foto) }}" alt="Foto ruangan" style="display: block; max-width: 300px; margin: 10px auto; border: 2px solid #ccc;"">
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
                            <label for="namaruangan">Nama Ruangan</label>
                            <textarea name="deskripsiruangan" class="form-control" id="deskripsiruangan" placeholder="Masukkan Deskripsi" rows="5">{{ old('deskripsiruangan', $data->deskripsiruangan) }}</textarea>
                            @error('namaruangan')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="deskripsiruangan">Deskripsi Ruangan</label>
                            <input type="text" name="deskripsiruangan" class="form-control" id="deskripsiruangan" value="{{ old('deskripsiruangan', $data->deskripsiruangan) }}" placeholder="Masukkan Deskripsi">
                            @error('deskripsiruangan')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="card-action">
                        <button type="button" class="btn btn-success saveButton">Simpan</button>
                        <button type="button" class="btn btn-danger" onclick="window.location.href='{{ route('staf.ruangan') }}'">Batal</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
