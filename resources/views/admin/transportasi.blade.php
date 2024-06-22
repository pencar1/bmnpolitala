@extends('layout.layoutadmin')

@section('content')
<div class="page-inner">
    <div class="page-header">
        <h4 class="page-title">Menu Transportasi</h4>
    </div>
    <div class="page-body">
        <div class="row">
            <div class="col-md-12">
                @if (session('success'))
                    <div class="alert alert-success" role="alert">
                        {{ session('success') }}
                    </div>
                @endif
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex align-items-center">
                            <h4 class="card-title">Transportasi</h4>
                            <a href="{{ route('admin.transportasi.tambah') }}" class="btn btn-primary btn-round ml-auto">
                                <i class="fa fa-plus"></i>
                                Tambah
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="add-row" class="display table table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Transportasi</th>
                                        <th>Stok</th>
                                        <th>Deskripsi</th>
                                        <th>Foto</th>
                                        <th style="width: 10%">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data as $d)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $d->namatransportasi }}</td>
                                        <td>{{ $d->stoktransportasi }}</td>
                                        <td>{{ $d->deskripsitransportasi }}</td>
                                        <td class="text-center">
                                            @if ($d->foto)
                                                <img src="{{ asset('images/transportasi/' . $d->foto) }}" alt="Foto Transportasi" style="max-width: 100px; margin: 10px auto; border: 2px solid #ccc;">
                                            @else
                                                Tidak ada foto
                                            @endif
                                        </td>
                                        <td>
                                            <div class="form-button-action">
                                                <a href="{{ route('admin.transportasi.edit', ['id' => $d->idtransportasi]) }}" data-toggle="tooltip" title="Ubah Transportasi" class="btn btn-link btn-primary btn-lg">
                                                    <i class="fa fa-edit"></i>
                                                </a>
                                                <form action="{{ route('admin.transportasi.destroy', ['id' => $d->idtransportasi]) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="button" data-toggle="tooltip" title="Hapus Transportasi" class="btn btn-link btn-danger deleteButton">
                                                        <i class="fa fa-times"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
