@extends('layout.layoutadmin')

@section('content')
<div class="page-inner">
    <div class="page-header">
        <h4 class="page-title">Menu Transportasi</h4>
    </div>
    <div class="page-body">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex align-items-center">
                            <h4 class="card-title">Transportasi</h4>
                            <a href="{{ route('transportasi.tambah') }}" class="btn btn-primary btn-round ml-auto">
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
                                                <img src="{{ asset('images/transportasi/' . $d->foto) }}" alt="Foto Transportasi" style="max-width: 120px;">
                                            @else
                                                Tidak ada foto
                                            @endif
                                        </td>                                        
                                        <td>
                                            <div class="form-button-action">
                                                <a href="{{ route('transportasi.edit', ['id' => $d->idtransportasi]) }}" data-toggle="tooltip" title="Ubah Transportasi" class="btn btn-link btn-primary btn-lg">
                                                    <i class="fa fa-edit"></i>
                                                </a>
                                                <button type="button" data-toggle="modal" data-target="#deleteModal-{{ $d->idtransportasi }}" title="Hapus Transportasi" class="btn btn-link btn-danger deleteButton">
                                                    <i class="fa fa-times"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                    <!-- Delete Modal -->
                                    <div class="modal fade" id="deleteModal-{{ $d->idtransportasi }}" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel-{{ $d->idtransportasi }}" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="deleteModalLabel-{{ $d->idtransportasi }}">Konfirmasi Hapus</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    Apakah Anda yakin ingin menghapus transportasi <strong>{{ $d->namatransportasi }}</strong>?
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                                    <form action="{{ route('transportasi.destroy', ['id' => $d->idtransportasi]) }}" method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger">Hapus</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- End Delete Modal -->
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
