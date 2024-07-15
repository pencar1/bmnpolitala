@extends('layout.layoutadmin')

@section('content')
<div class="page-inner">
    <div class="page-header">
        <h4 class="page-title">Menu Pengembalian</h4>
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
                            <h4 class="card-title">Pengembalian</h4>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="add-row" class="display table table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Peminjam</th>
                                        <th>Nama Aset</th>
                                        <th>Tanggal Peminjaman</th>
                                        <th>Tanggal Pengembalian</th>
                                        <th>Status</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data as $data)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $data->nama }}</td>
                                        <td>{{ $data->getAsetName() }}</td>
                                        <td>{{ \Carbon\Carbon::parse($data->tanggalpeminjaman)->format('d-m-Y') }}</td>
                                        <td>{{ \Carbon\Carbon::parse($data->pengembalian->tanggalpengembalian ?? '')->format('d-m-Y') }}</td>
                                        <td>{{ $data->status }}</td>
                                        <td>
                                            <div class="form-button-action">
                                                <a href="{{ route('admin.pengembalian.detail', ['id' => $data->idpeminjaman]) }}" class="btn btn-link btn-primary btn-lg" data-toggle="tooltip" title="Lihat Detail">
                                                    <i class="fa fa-eye"></i>
                                                </a>
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
