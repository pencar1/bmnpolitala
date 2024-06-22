@extends('layout.layoutadmin')

@section('content')
<style>
    .error-message {
        color: red;
    }
</style>
<div class="page-inner">
    <h4 class="page-title">User Profil</h4>
    <div class="row">
        <div class="col-md-8">
            <div class="card card-with-nav">
                <div class="card-header">
                    <div class="row row-nav-line">
                        <ul class="nav nav-tabs nav-line nav-color-secondary" role="tablist">
                          
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#profile" role="tab" aria-selected="false">Profil</a>
                            </li>
                           
                        </ul>
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.profil.update') }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="row mt-3">
                            <div class="col-md-6">
                                <div class="form-group form-group-default">
                                    <label for="nama">Nama</label>
                                    <input type="text" class="form-control" id="nama" name="nama" value="{{ $user->nama }}" placeholder="Enter Name">
                                    @error('nama')
                                    <small class="error-message">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group form-group-default">
                                    <label for="email2">Email</label>
                                    <input type="email" class="form-control" id="email2" name="email" value="{{ $user->email }}" placeholder="Enter Email">
                                    @error('email')
                                    <small class="error-message">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-md-6">
                                <div class="form-group form-group-default">
                                    <label for="nohp">No Hp</label>
                                    <input type="text" class="form-control" id="nohp" name="nohp" value="{{ $user->nohp }}" placeholder="Enter Phone Number" value="{{ old('nohp') }}" pattern="[0-9]*" oninput="this.value = this.value.replace(/[^0-9]/g, '');">
                                    @error('nohp')
                                    <small class="error-message">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group form-group-default">
                                    <label for="password">Ubah Password(Huruf besar dan kecil)</label>
                                    <input type="password" class="form-control" id="password" name="password" placeholder="Kosongkan Jika Tidak Mengganti">
                                    @error('password')
                                    <small class="error-message">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="text-right mt-3 mb-3">
                            <button type="submit" class="btn btn-success">Ganti</button>
                            <button type="button" class="btn btn-danger" onclick="window.location.href='{{ route('admin.dashboard') }}'">Kembali</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
      
    </div>
</div>




@endsection