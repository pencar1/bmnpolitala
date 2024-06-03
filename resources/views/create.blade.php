@extends('layout.layoutadmin')

@section('content')

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
                            <input type="text" name="nama" class="form-control" id="nama" placeholder="Masukkan Nama">
                            @error('nama')
                                <small>{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="email2">Email</label>
                            <input type="email" name="email" class="form-control" id="email2" placeholder="Masukkan Email">
                            @error('email')
                                <small>{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" name="password" class="form-control" id="password" placeholder="Masukkan Password">
                            @error('password')
                                <small>{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlSelect1">Organisasi</label>
                            <select class="form-control" id="exampleFormControlSelect1">
                                <option>1</option>
                                <option>2</option>
                                <option>3</option>
                                <option>4</option>
                                <option>5</option>
                            </select>
                        </div>
                    </div>
                    <div class="card-action">
                        <button type="submit"  class="btn btn-success">Simpan</button>
                        <button type="button" class="btn btn-danger" onclick="window.location.href='{{ route('admin.index') }}'">Batal</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
