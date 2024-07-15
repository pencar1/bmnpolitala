@extends('layout.layoutpeminjam')

@section('content')

<div class="page-inner">
    <div class="page-header">
        <div class="col-md-12">
            <form action="{{ route('peminjam.peminjaman.storebar') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="nama" value="{{ $user->nama }}">
                <input type="hidden" name="nim" value="{{ $user->nim }}">
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">Form Tambah Peminjaman Barang</div>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="aset">Aset Barang</label>
                            @if(isset($barang))
                                <input type="text" name="aset" class="form-control" id="aset" value="{{ old('aset', $barang->namabarang) }}" readonly style="font-weight: bold; color: black;">
                                <input type="hidden" name="idbarang" value="{{ $barang->idbarang }}">
                            @else
                                <input type="text" name="aset" class="form-control" id="aset" value="Barang tidak ditemukan" readonly style="font-weight: bold; color: black;">
                            @endif
                            @error('aset')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="tanggalpeminjaman">Tanggal Peminjaman</label>
                            <input type="date" name="tanggalpeminjaman" class="form-control" id="tanggalpeminjaman" value="{{ old('tanggalpeminjaman') }}" placeholder="Masukkan Tanggal Peminjaman" min="{{ \Carbon\Carbon::now('Asia/Makassar')->toDateString() }}">
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
                        <button type="button" class="btn btn-danger" onclick="window.location.href='{{ route('peminjam.barang') }}'">Batal</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
