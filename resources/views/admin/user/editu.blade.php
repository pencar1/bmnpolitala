@extends('layout.layoutadmin')

@section('content')
<style>
    .error-message {
        color: red;
    }
</style>
<div class="page-inner">
    <div class="page-header">
        <div class="col-md-12">
            <form action="{{ route('admin.user.update', ['id' => $data->id]) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">Form Ubah User</div>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="nama">Nama</label>
                            <input type="text" name="nama" value="{{ $data->nama }}" class="form-control" id="nama" placeholder="Masukkan Nama">
                            @error('nama')
                                 <small class="error-message">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlSelect1">Prodi</label>
                            <select class="form-control" id="exampleFormControlSelect1" name="prodi">
                                <option value="teknologi informasi" {{ $data->prodi == 'teknologi informasi' ? 'selected' : '' }}>Teknologi Informasi</option>
                                <option value="mesin otomotif" {{ $data->prodi == 'mesin otomotif' ? 'selected' : '' }}>Mesin Otomotif</option>
                                <option value="agroindustri" {{ $data->prodi == 'agroindustri' ? 'selected' : '' }}>Agroindustri</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="nim">NIM</label>
                            <input type="text" name="nim" value="{{ $data->nim }}" class="form-control" id="nim" placeholder="Masukkan NIM" value="{{ old('nim') }}" pattern="[0-9]*" oninput="this.value = this.value.replace(/[^0-9]/g, '');">
                            @error('nim')
                                 <small class="error-message">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="nohp">No HP</label>
                            <input type="text" name="nohp" value="{{ $data->nohp }}" class="form-control" id="nohp" placeholder="Masukkan No HP" value="{{ old('nohp') }}" pattern="[0-9]*" oninput="this.value = this.value.replace(/[^0-9]/g, '');">
                            @error('nohp')
                                 <small class="error-message">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlSelect1">Organisasi</label>
                            <select class="form-control" id="exampleFormControlSelect1" name="organisasi">
                                <option value="dpm" {{ $data->organisasi == 'dpm' ? 'selected' : '' }}>DPM</option>
                                <option value="bem" {{ $data->organisasi == 'bem' ? 'selected' : '' }}>BEM</option>
                                <option value="mapala" {{ $data->organisasi == 'mapala' ? 'selected' : '' }}>Mapala</option>
                            </select>
                            @error('organisasi')
                                 <small class="error-message">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="email2">Email</label>
                            <input type="email" name="email" value="{{ $data->email }}" class="form-control" id="email2" placeholder="Masukkan Email">
                            @error('email')
                                 <small class="error-message">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="password">Password (Isi menggunakan huruf besar dan kecil minimal 8 huruf)</label>
                            <input type="password" name="password" class="form-control" id="password" placeholder="Masukkan Password">
                            @error('password')
                                 <small class="error-message">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlSelect1">Role</label>
                            <select class="form-control" id="exampleFormControlSelect1" name="role">
                                <option value="admin" {{ $data->role == 'admin' ? 'selected' : '' }}>Admin</option>
                                <option value="staf" {{ $data->role == 'staf' ? 'selected' : '' }}>Staf</option>
                                <option value="peminjam" {{ $data->role == 'peminjam' ? 'selected' : '' }}>Peminjam</option>
                            </select>
                            @error('role')
                                 <small class="error-message">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="card-action">
                        <button type="button" class="btn btn-success saveButton">Simpan</button>
                        <button type="button" class="btn btn-danger" onclick="window.location.href='{{ route('admin.user') }}'">Batal</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
