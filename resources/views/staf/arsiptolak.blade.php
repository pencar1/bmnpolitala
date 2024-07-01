@extends('layout.layoutstaf')

@section('content')
<div class="page-inner">
    <div class="page-header">
        <h4 class="page-title">Menu Arsip Ditolak</h4>

    </div>
    <div class="page-body">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex align-items-center">
                            <h4 class="card-title">User</h4>
                            <a href="{{ route('staf.peminjaman.tambah') }}" class="btn btn-primary btn-round ml-auto">
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
                                        <th>Nama Peminjam</th>
                                        <th>Aset Yang Dipinjam</th>
                                        <th>Tanggal Peminjaman</th>
                                        <th>Jumlah Dipinjam</th>
                                        <th>Status</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data as $d)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $d->getNama()}}</td>
                                        <td>{{ $d->getAsetName()}}</td>
                                        <td>{{ \Carbon\Carbon::parse($d->tanggalpeminjaman)->format('d-m-Y') }}</td>
                                        @if($d->getJenisAset() == 'barang' || $d->getJenisAset() == 'transportasi')
                                            <td>{{ $d->jumlahaset }}</td>
                                                @else
                                                <td>-</td>
                                        @endif
                                        <td>{{ $d->status }}</td>
                                        <td>
                                            <div class="form-button-action">
                                                <a href="{{ route('staf.arsiptolak.detail', ['id' => $d->idpeminjaman]) }}" class="btn btn-link btn-primary btn-lg" data-toggle="tooltip" title="Lihat Detail">
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
