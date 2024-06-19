@extends('layout.layoutadmin')

@section('content')

<div class="page-inner">
    <div class="page-header">
        <div class="col-md-12">
            <form action="{{ route('admin.ruangan.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">Form Tambah Ruangan</div>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="namaruangan">Nama Ruangan</label>
                            <input type="text" name="namaruangan" class="form-control" id="namaruangan" placeholder="Masukkan Nama">
                            @error('namaruangan')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="deskripsiruangan">Deskripsi Ruangan</label>
                            <input type="text" name="deskripsiruangan" class="form-control" id="deskripsiruangan" placeholder="Masukkan Deskripsi">
                            @error('deskripsiruangan')
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
                        <button type="submit" class="btn btn-success">Simpan</button>
                        <button type="button" class="btn btn-danger" onclick="window.location.href='{{ route('admin.ruangan') }}'">Batal</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
