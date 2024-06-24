@extends('layout.layoutadmin')

@section('content')

<div class="page-inner">
    <div class="page-header">
        <div class="col-md-12">
            <form action="{{ route('admin.pengembalian.detail', ['id' => $pengembalian->idpengembalian]) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">Detail Pengembalian</div>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="namapeminjam">Nama Peminjam</label>
                            <input type="text" name="namapeminjam" class="form-control" id="namapeminjam" value="{{ old('namapeminjam', $pengembalian->peminjaman->user->nama ?? '') }}" readonly style="font-weight: bold; color: black;">
                            @error('namapeminjam')
                                <small>{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="organisasi">Organisasi</label>
                            <input type="text" name="organisasi" class="form-control" id="organisasi" value="{{ old('organisasi', $pengembalian->peminjaman->user->organisasi ?? '') }}" readonly style="font-weight: bold; color: black;">
                            @error('organisasi')
                                <small>{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="jenisaset">Jenis Aset</label>
                            <input type="text" name="jenisaset" class="form-control" id="jenisaset" value="{{ old('jenisaset', $pengembalian->getJenisAset()) }}" readonly style="font-weight: bold; color: black;">
                            @error('jenisaset')
                                <small>{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="namaaset">Nama Aset</label>
                            <input type="text" name="namaaset" class="form-control" id="namaaset" value="{{ old('namaaset', $pengembalian->getAsetName()) }}" readonly style="font-weight: bold; color: black;">
                            @error('namaaset')
                                <small>{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="tanggalpeminjaman">Tanggal Peminjaman</label>
                            <input type="date" name="tanggalpeminjaman" class="form-control" id="tanggalpeminjaman" value="{{ old('tanggalpeminjaman', $pengembalian->peminjaman->tanggalpeminjaman) }}" readonly style="font-weight: bold; color: black;">
                            @error('tanggalpeminjaman')
                                <small>{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="tanggalpengembalian">Tanggal Pengembalian</label>
                            <input type="date" name="tanggalpengembalian" class="form-control" id="tanggalpengembalian" value="{{ old('tanggalpengembalian', $pengembalian->tanggalpengembalian) }}" readonly style="font-weight: bold; color: black;">
                            @error('tanggalpengembalian')
                                <small>{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="jumlahaset">Jumlah Aset</label>
                            <input type="number" name="jumlahaset" class="form-control" id="jumlahaset" min="1" oninput="this.value = this.value.replace(/[^0-9]/g, '')" value="{{ old('jumlahaset', $pengembalian->peminjaman->jumlahaset) }}" readonly style="font-weight: bold; color: black;">
                            @error('jumlahaset')
                                <small>{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="lampiran">Lampiran</label>
                            @if ($pengembalian->peminjaman->lampiran)
                                <div class="mt-2">
                                    @if (in_array(pathinfo($pengembalian->lampiran, PATHINFO_EXTENSION), ['jpg', 'jpeg', 'png']))
                                        <img src="{{ asset('lampiran/' . $pengembalian->peminjaman->lampiran) }}" alt="Lampiran" style="max-width: 200px; cursor: pointer;" data-toggle="modal" data-target="#lampiranModal">
                                    @elseif (in_array(pathinfo($pengembalian->lampiran, PATHINFO_EXTENSION), ['pdf', 'doc', 'docx']))
                                        <a href="{{ asset('lampiran/' . $pengembalian->peminjaman->lampiran) }}" style="cursor: pointer;" data-toggle="modal" data-target="#lampiranModal">{{ $pengembalian->peminjaman->lampiran }}</a>
                                    @else
                                        <a href="{{ asset('lampiran/' . $pengembalian->peminjaman->lampiran) }}" target="_blank">{{ $pengembalian->peminjaman->lampiran }}</a>
                                    @endif
                                </div>
                            @endif
                            @error('lampiran')
                                <small>{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="status">Status</label>
                            <input type="text" name="status" class="form-control" id="status" value="{{ old('status', $pengembalian->peminjaman->status) }}" readonly style="font-weight: bold; color: black;">
                            @error('status')
                                <small>{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="card-action">
                            <button type="button" class="btn btn-success" onclick="window.location.href='{{ route('admin.pengembalian') }}'">Kembali</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
