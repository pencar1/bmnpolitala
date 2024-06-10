@extends('layout.layoutadmin')

@section('content')
<div class="page-inner">
    <h4 class="page-title">User Profile</h4>
    <div class="row">
        <div class="col-md-8">
            <div class="card card-with-nav">
                <div class="card-header">
                    <div class="row row-nav-line">
                        <ul class="nav nav-tabs nav-line nav-color-secondary" role="tablist">
                          
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#profile" role="tab" aria-selected="false">Profile</a>
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
                                    <label for="nama">Name</label>
                                    <input type="text" class="form-control" id="nama" name="nama" value="{{ $user->nama }}" placeholder="Enter Name">
                                    @error('nama')
                                    <small>{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group form-group-default">
                                    <label for="email2">Email</label>
                                    <input type="email" class="form-control" id="email2" name="email" value="{{ $user->email }}" placeholder="Enter Email">
                                    @error('email')
                                    <small>{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-md-6">
                                <div class="form-group form-group-default">
                                    <label for="nohp">Phone</label>
                                    <input type="text" class="form-control" id="nohp" name="nohp" value="{{ $user->nohp }}" placeholder="Enter Phone Number">
                                    @error('nohp')
                                    <small>{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group form-group-default">
                                    <label for="password">Password</label>
                                    <input type="password" class="form-control" id="password" name="password" placeholder="Enter Password">
                                    @error('password')
                                    <small>{{ $message }}</small>
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
        <div class="col-md-4">
            <div class="card card-profile card-secondary">
                <div class="card-header" style="background-image: url('../assets/img/blogpost.jpg')">
                    <div class="profile-picture">
                        <div class="avatar avatar-xl">
                            <img src="../assets/img/profile.jpg" alt="..." class="avatar-img rounded-circle">
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="user-profile text-center">
                        <div class="name">{{ $user->nama }}</div>
                        <div class="job">{{ $user->job_title }}</div>
                        <div class="desc">{{ $user->about_me }}</div>
                        
                        <div class="view-profile">
                            <a href="#" class="btn btn-secondary btn-block">View Full Profile</a>
                        </div>
                    </div>
                </div>
               
            </div>
        </div>
    </div>
</div>




@endsection