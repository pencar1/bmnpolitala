@extends('layout.layoutadmin')

@section('content')
<style>
    .text-danger {
        color: red;
    }
</style>
<div class="page-inner">
    <div class="page-header">
        <div class="col-md-12">
            <form action="{{route('admin.user.store')}}" method="POST">
                @csrf
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">Form Tambah User</div>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="nama">Nama</label>
                            <input type="text" name="nama" class="form-control" id="nama" placeholder="Masukkan Nama" value="{{ old('nama') }}">
                            @error('nama')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlSelect1">Prodi</label>
                            <select class="form-control" id="exampleFormControlSelect1" name="prodi">
                                <option selected disabled hidden>Pilih Prodi</option>
                                <option {{ old('prodi') == 'D3 Teknologi Informasi' ? 'selected' : '' }}>D3 Teknologi Informasi</option>
                                <option {{ old('prodi') == 'D3 Teknologi Otomotif' ? 'selected' : '' }}>D3 Teknologi Otomotif</option>
                                <option {{ old('prodi') == 'D3 Agroindustri' ? 'selected' : '' }}>D3 Agroindustri</option>
                                <option {{ old('prodi') == 'D3 Akuntansi' ? 'selected' : '' }}>D3 Akuntansi</option>
                                <option {{ old('prodi') == 'D4 Teknologi Pakan Ternak' ? 'selected' : '' }}>D4 Teknologi Pakan Ternak</option>
                                <option {{ old('prodi') == 'D4 Teknologi Rekayasa Konstruksi Jalan Dan Jembatan' ? 'selected' : '' }}>D4 Teknologi Rekayasa Konstruksi Jalan Dan Jembatan</option>
                                <option {{ old('prodi') == 'D4 Teknologi Rekayasa Komputer Jaringan' ? 'selected' : '' }}>D4 Teknologi Rekayasa Komputer Jaringan</option>
                                <option {{ old('prodi') == 'D4 Teknologi Rekayasa Pemeliharaan Alat Berat' ? 'selected' : '' }}>D4 Teknologi Rekayasa Pemeliharaan Alat Berat</option>
                                <option {{ old('prodi') == 'D4 Akuntansi Perpajakan' ? 'selected' : '' }}>D4 Akuntansi Perpajakan</option>
                                <option {{ old('prodi') == 'D4 Pengembangan Produk Agroindustri' ? 'selected' : '' }}>D4 Pengembangan Produk Agroindustri</option>

                            </select>
                            @error('prodi')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="nim">NIM</label>
                            <input type="text" name="nim" class="form-control" id="nim" placeholder="Masukkan NIM" value="{{ old('nim') }}" pattern="[0-9]*" oninput="this.value = this.value.replace(/[^0-9]/g, '');">
                            @error('nim')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="nohp">No HP</label>
                            <input type="text" name="nohp" class="form-control" id="nohp" placeholder="Masukkan No HP" value="{{ old('nohp') }}" pattern="[0-9]*" oninput="this.value = this.value.replace(/[^0-9]/g, '');">
                            @error('nohp')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlSelect1">Organisasi</label>
                            <select class="form-control" id="exampleFormControlSelect1" name="organisasi">
                                <option selected disabled hidden>Pilih Organisasi</option>
                                <option {{ old('organisasi') == 'DPM' ? 'selected' : '' }}>DPM</option>
                                <option {{ old('organisasi') == 'BEM' ? 'selected' : '' }}>BEM</option>
                                <option {{ old('organisasi') == 'UKM MAPALA' ? 'selected' : '' }}>UKM MAPALA</option>
                                <option {{ old('organisasi') == 'UKM BISEPOL' ? 'selected' : '' }}>UKM BISEPOL</option>
                                <option {{ old('organisasi') == 'UKM LPM DIGMA' ? 'selected' : '' }}>UKM LPM DIGMA</option>
                                <option {{ old('organisasi') == 'UKM KSR PMI' ? 'selected' : '' }}>UKM KSR PMI</option>
                                <option {{ old('organisasi') == 'UKM MENWA' ? 'selected' : '' }}>UKM MENWA</option>
                                <option {{ old('organisasi') == 'UKM PRAMUKA' ? 'selected' : '' }}>UKM PRAMUKA</option>
                                <option {{ old('organisasi') == 'UKM FSI AL-IKHWANA' ? 'selected' : '' }}>UKM FSI AL-IKHWANA</option>
                                <option {{ old('organisasi') == 'UKM KEWIRAUSAHAAN' ? 'selected' : '' }}>UKM KEWIRAUSAHAAN</option>
                                <option {{ old('organisasi') == 'Hima TI' ? 'selected' : '' }}>Hima TI</option>
                                <option {{ old('organisasi') == 'Hima Trkj' ? 'selected' : '' }}>Hima Trkj</option>
                            </select>
                            @error('organisasi')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="email2">Email</label>
                            <input type="email" name="email" class="form-control" id="email2" placeholder="Masukkan Email" value="{{ old('email') }}">
                            @error('email')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="password">Password (Isi menggunakan huruf besar dan kecil minimal 8 huruf)</label>
                            <input type="password" name="password" class="form-control" id="password" placeholder="Masukkan Password">
                            @error('password')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlSelect1">Role</label>
                            <select class="form-control" id="exampleFormControlSelect1" name="role">
                                <option selected disabled hidden>Pilih Role</option>
                                <option {{ old('role') == 'admin' ? 'selected' : '' }}>admin</option>
                                <option {{ old('role') == 'staf' ? 'selected' : '' }}>staf</option>
                                <option {{ old('role') == 'peminjam' ? 'selected' : '' }}>peminjam</option>
                            </select>
                            @error('role')
                                <small class="text-danger">{{ $message }}</small>
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
