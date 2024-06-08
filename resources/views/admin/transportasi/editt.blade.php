@extends('layout.layoutadmin')

@section('content')

<div class="page-inner">
    <div class="page-header">
        <div class="col-md-12">
            <form action="{{ route('admin.transportasi.update', ['id' => $data->idtransportasi]) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">Form Edit Transportasi</div>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <div class="form-group text-center">
                            @if ($data->foto)
                                <img src="{{ asset('images/transportasi/' . $data->foto) }}" alt="Foto Transportasi" style="display: block; max-width: 300px; margin: 10px auto; border: 2px solid #ccc;"">
                                <br>
                            @endif
                            </div>
                            <label for="foto">Gambar</label>
                            <input type="file" name="foto" class="form-control" id="foto">
                            @error('foto')
                                <small>{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="namatransportasi">Nama Transportasi</label>
                            <input type="text" name="namatransportasi" class="form-control" id="namatransportasi" value="{{ old('namatransportasi', $data->namatransportasi) }}" placeholder="Masukkan Nama">
                            @error('namatransportasi')
                                <small>{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="stoktransportasi">Stok Transportasi</label>
                            <input type="text" name="stoktransportasi" class="form-control" id="stoktransportasi" value="{{ old('stoktransportasi', $data->stoktransportasi) }}" placeholder="Masukkan Stok">
                            @error('stoktransportasi')
                                <small>{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="deskripsitransportasi">Deskripsi Transportasi</label>
                            <input type="text" name="deskripsitransportasi" class="form-control" id="deskripsitransportasi" value="{{ old('deskripsitransportasi', $data->deskripsitransportasi) }}" placeholder="Masukkan Deskripsi">
                            @error('deskripsitransportasi')
                                <small>{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="card-action">
                        <button type="submit" class="btn btn-success">Simpan</button>
                        <button type="button" class="btn btn-danger" onclick="window.location.href='{{ route('admin.transportasi') }}'">Batal</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
