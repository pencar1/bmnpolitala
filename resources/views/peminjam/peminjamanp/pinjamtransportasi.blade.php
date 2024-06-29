{{-- pinjamtransportasi.blade.php --}}
@extends('layout.layoutpeminjam')

@section('content')

<div class="page-inner">
    <div class="page-header">
        <div class="col-md-12">
            <form action="{{ route('peminjam.peminjamantrans.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="nama" value="{{ $user->nama }}">
                <input type="hidden" name="nim" value="{{ $user->nim }}">
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">Form Tambah Peminjaman Transportasi</div>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="asetSelect">Aset Transportasi</label>
                            <input type="text" name="aset" class="form-control" id="aset" value="{{ isset($transportasi) ? $transportasi->namatransportasi : 'Transportasi tidak ditemukan' }}" readonly style="font-weight: bold; color: black;">
                            <input type="hidden" name="idtransportasi" value="{{ isset($transportasi) ? $transportasi->idtransportasi : '' }}">
                            @error('aset')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="tanggalpeminjaman">Tanggal Peminjaman</label>
                            <input type="date" name="tanggalpeminjaman" class="form-control" id="tanggalpeminjaman" value="{{ old('tanggalpeminjaman') }}" placeholder="Masukkan Tanggal Peminjaman" min="{{ date('Y-m-d') }}">
                            @error('tanggalpeminjaman')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="jumlahaset">Jumlah Aset</label>
                            <input type="number" name="jumlahaset" class="form-control" id="jumlahaset" min="1" oninput="this.value = this.value.replace(/[^0-9]/g, '')" value="{{ old('jumlahaset') }}" placeholder="Masukkan Jumlah Aset">
                            @error('jumlahaset')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="lampiran">Lampiran</label>
                            <input type="file" name="lampiran" class="form-control" id="lampiran">
                            @error('lampiran')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="card-action">
                        <button type="button" class="btn btn-success saveButton">Simpan</button>
                        <button type="button" class="btn btn-danger" onclick="window.location.href='{{ route('peminjam.transportasi') }}'">Batal</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
