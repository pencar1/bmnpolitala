@extends('layout.layoutadmin')

@section('content')

<div class="page-inner">
    <div class="page-header">
        <div class="col-md-12">
            <form action="{{ route('admin.transportasi.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">Form Tambah Transportasi</div>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="namatransportasi">Nama Transportasi</label>
                            <input type="text" name="namatransportasi" class="form-control" id="namatransportasi" placeholder="Masukkan Nama">
                            @error('namatransportasi')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="merktransportasi">Merk Transportasi</label>
                            <input type="text" name="merktransportasi" class="form-control" id="merktransportasi" placeholder="Masukkan Merk">
                            @error('merktransportasi')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="stoktransportasi">Stok Transportasi</label>
                            <input type="number" name="stoktransportasi" class="form-control" id="stoktransportasi" oninput="this.value = this.value.replace(/[^0-9]/g, '')" value="{{ old('stoktransportasi') }}" placeholder="Masukkan Stok">
                            @error('stoktransportasi')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="deskripsitransportasi">Deskripsi Transportasi</label>
                            <textarea name="deskripsitransportasi" class="form-control" id="deskripsitransportasi" placeholder="Masukkan Deskripsi" rows="5"></textarea>
                            @error('deskripsitransportasi')
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
                        <button type="button" class="btn btn-success saveButton">Simpan</button>
                        <button type="button" class="btn btn-danger" onclick="window.location.href='{{ route('admin.transportasi') }}'">Batal</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
