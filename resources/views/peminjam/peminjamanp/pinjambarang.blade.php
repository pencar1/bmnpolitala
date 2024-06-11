<!-- pinjambarang.blade.php -->
@extends('layout.layoutpeminjam')

@section('content')

<div class="page-inner">
    <div class="page-header">
        <div class="col-md-12">
            <form action="{{ route('peminjam.peminjaman.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">Form Tambah Peminjaman Barang</div>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="asetSelect">Aset Barang</label>
                            <select class="form-control" id="asetSelect" name="aset">
                                <option selected disabled hidden>Pilih Barang</option>
                                @foreach($barangs as $barang)
                                    <option value="{{ $barang->idbarang }}" {{ old('aset') == $barang->idbarang ? 'selected' : '' }}>{{ $barang->namabarang }}</option>
                                @endforeach
                            </select>
                            @error('aset')
                                <small>{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="tanggalpeminjaman">Tanggal Peminjaman</label>
                            <input type="date" name="tanggalpeminjaman" class="form-control" id="tanggalpeminjaman" value="{{ old('tanggalpeminjaman') }}" placeholder="Masukkan Tanggal Peminjaman">
                            @error('tanggalpeminjaman')
                                <small>{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="jumlahaset">Jumlah Aset</label>
                            <input type="number" name="jumlahaset" class="form-control" id="jumlahaset" min="1" oninput="this.value = this.value.replace(/[^0-9]/g, '')" value="{{ old('jumlahaset') }}" placeholder="Masukkan Jumlah Aset">
                            @error('jumlahaset')
                                <small>{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="lampiran">Lampiran</label>
                            <input type="file" name="lampiran" class="form-control" id="lampiran">
                            @error('lampiran')
                                <small>{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="card-action">
                        <button type="submit" class="btn btn-success">Simpan</button>
                        <button type="button" class="btn btn-danger" onclick="window.location.href='{{ route('peminjam.peminjaman') }}'">Batal</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
