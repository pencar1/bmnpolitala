@extends('layout.layoutpeminjamf')

@section('content')
<div class="page-inner">
    <div class="page-header">
        <h4 class="page-title">Menu Peminjaman</h4>
    </div>
    <div class="page-body">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex align-items-center">
                            <h4 class="card-title">Peminjaman</h4>
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
                                        <td>{{ $d->getNama() }}</td>
                                        <td>{{ $d->getAsetName() }}</td>
                                        <td>{{ \Carbon\Carbon::parse($d->tanggalpeminjaman)->format('d-m-Y') }}</td>
                                        @if($d->getJenisAset() == 'barang' || $d->getJenisAset() == 'transportasi')
                                            <td>{{ $d->jumlahaset }}</td>
                                                @else
                                                <td>-</td>
                                        @endif
                                        <td>{{ $d->status }}</td>
                                        <td>
                                            <!-- Tombol Lihat Detail (Modal) -->
                                            @if(!in_array($d->status, ['Diproses']))
                                            <button type="button" class="btn btn-link btn-info" data-toggle="modal" data-target="#lihatModal-{{ $d->idpeminjaman }}">
                                                <i class="fa fa-eye"></i>
                                            </button>
                                            @endif
                                            
                                            <!-- Tombol Batalkan jika status bukan dikembalikan, dipinjam, disetujui, dibatalkan -->
                                            @if(!in_array($d->status, ['dikembalikan', 'dipinjam', 'disetujui', 'dibatalkan']))
                                                <button type="button" data-id="{{ $d->idpeminjaman }}" data-name="{{ $d->aset }}" data-toggle="modal" data-target="#deleteModal-{{ $d->idpeminjaman }}" title="Hapus Peminjaman" class="btn btn-link btn-danger deleteButton">
                                                    <i class="fa fa-times"></i>
                                                </button>
                                            @endif
                                        </td>
                                    </tr>
                                    <!-- Modal Lihat Detail -->
                                    @if(!in_array($d->status, ['Diproses']))
                                    <div class="modal fade" id="lihatModal-{{ $d->idpeminjaman }}" tabindex="-1" role="dialog" aria-labelledby="lihatModalLabel-{{ $d->idpeminjaman }}" aria-hidden="true">
                                        <div class="modal-dialog modal-lg" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="lihatModalLabel-{{ $d->idpeminjaman }}">Detail Peminjaman</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="form-group">
                                                        <label>Nama Peminjam</label>
                                                        <input type="text" class="form-control" value="{{ $d->getNama() }}" readonly style="font-weight: bold; color: black;">
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Aset Yang Dipinjam</label>
                                                        <input type="text" class="form-control" value="{{ $d->getAsetName() }}" readonly style="font-weight: bold; color: black;">
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Tanggal Peminjaman</label>
                                                        <input type="text" class="form-control" value="{{ \Carbon\Carbon::parse($d->tanggalpeminjaman)->format('d-m-Y') }}" readonly style="font-weight: bold; color: black;">
                                                    </div>
                                                    @if($d->getJenisAset() == 'barang' || $d->getJenisAset() == 'transportasi')
                                                        <div class="form-group">
                                                            <label>Jumlah Dipinjam</label>
                                                            <input type="text" class="form-control" value="{{ $d->jumlahaset }}" readonly style="font-weight: bold; color: black;">
                                                        </div>
                                                    @endif
                                                    <div class="form-group">
                                                        <label>Status</label>
                                                        <input type="text" class="form-control" value="{{ $d->status }}" readonly style="font-weight: bold; color: black;">
                                                    </div>
                                                    <!-- Tambahkan informasi lainnya sesuai kebutuhan -->
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- End Modal Lihat Detail -->
                                    @endif
                                    <!-- Modal -->
                                    @if(!in_array($d->status, ['dikembalikan', 'dipinjam', 'disetujui', 'dibatalkan']))
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
                                                    <form action="{{ route('peminjam.peminjaman.update', ['id' => $d->idpeminjaman]) }}" method="POST">
                                                        @csrf
                                                        @method('PUT')
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Kembali</button>
                                                        <button type="submit" class="btn btn-danger">Batalkan Peminjaman</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @endif
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
