@extends('layout.layoutpeminjam')

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
                            <h4 class="card-title">Arsip Ditolak</h4>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="add-row" class="display table table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Peminjam</th>
                                        <th>Aset Yang Dipinjam</th>
                                        <th>Tanggal Peminjaman</th>
                                        <th>Jumlah Dipinjam</th>
                                        <th>Status</th>
                                        <th style="width: 10%">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data as $d)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $d->getNama()}}</td>
                                        <td>{{ $d->getAsetName()}}</td>
                                        <td>{{ \Carbon\Carbon::parse($d->tanggalpeminjaman)->format('d-m-Y') }}</td>
                                        <td>{{ $d->jumlahaset }}</td>
                                        <td>{{ $d->status }}</td>
                                        <td>
                                            <div class="form-button-action">
                                                <a href="{{ route('peminjam.arsiptolak.detail', ['id' => $d->idpeminjaman]) }}" class="btn btn-link btn-primary btn-lg" data-toggle="tooltip" title="Lihat Detail">
                                                    <i class="fa fa-eye"></i>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                    <!-- Modal -->
                                    <div class="modal" id="deleteModal-{{ $d->idpeminjaman }}" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel-{{ $d->idpeminjaman }}" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="deleteModalLabel-{{ $d->idpeminjaman }}">Konfirmasi Ubah Status</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    Apakah Anda yakin ingin membatalkan peminjaman <strong>{{ $d->getAsetName() }}</strong>?
                                                </div>
                                                <div class="modal-footer">
                                                    <form action="{{ route('peminjam.peminjaman.update', ['id' => $d->idpeminjaman]) }}" method="POST"> <!-- Mengarahkan ke fungsi update -->
                                                        @csrf
                                                        @method('PUT') <!-- Gunakan method PUT karena route-nya menggunakan PUT -->
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Kembali</button>
                                                        <button type="submit" class="btn btn-danger">Batalkan Peminjaman</button> <!-- Mengubah teks tombol menjadi "Batalkan Peminjaman" -->
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
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
