{{-- @extends('layout.layoutadmin')

@section('content')
<div class="page-inner">
    <div class="page-header">
        <h4 class="page-title">Menu User</h4>

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
                            <h4 class="card-title">User</h4>
                            <a href="{{ route('admin.user.create') }}" class="btn btn-primary btn-round ml-auto">
                                <i class="fa fa-plus"></i>
                                Tambah
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="add-row" class="display table table-striped table-hover" >
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama</th>
                                        <th>No HP</th>
                                        <th>Email</th>
                                        <th style="width: 10%">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data as $d)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $d->nama }}</td>
                                        <td>{{ $d->nohp }}</td>
                                        <td>{{ $d->email }}</td>
                                        <td>
                                            <div class="form-button-action">
                                                <a href="{{ route('admin.user.edit', ['id' => $d->id]) }}" data-toggle="tooltip" title="Ubah User" class="btn btn-link btn-primary btn-lg">
                                                    <i class="fa fa-edit"></i>
                                                </a>
                                                <form action="{{ route('admin.user.delete',['id' => $d->id])}}" method="POST" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="button" title="Hapus User" class="btn btn-link btn-danger deleteButton">
                                                        <i class="fa fa-times"></i>
                                                    </button>
                                                </form>
                                                {{-- <button type="button" data-id="{{ $d->id }}" data-name="{{ $d->nama }}" data-toggle="modal" data-target="#deleteModal-{{ $d->id }}" title="Hapus User" class="btn btn-link btn-danger deleteButton">
                                                    <i class="fa fa-times"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                    {{-- <!--   Modal   -->
                                    <div class="modal" id="deleteModal-{{ $d->id }}" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="deleteModalLabel">Konfirmasi Hapus</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    Apakah Anda yakin ingin menghapus pengguna <strong>{{ $d->nama }}?</strong>
                                                </div>
                                                <div class="modal-footer">
                                                    <form action="{{ route('admin.user.delete',['id' => $d->id])}}" method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
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
@endsection --}}
