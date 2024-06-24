@extends('layout.layoutadmin')

@section('content')

<div class="page-inner">
    <div class="page-header">
        <div class="col-md-12">
            <form action="{{ route('admin.arsiptolak.detail', ['id' => $peminjaman->idpeminjaman]) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">Detail Arsip Di Tolak</div>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="namapeminjam">Nama Peminjam</label>
                            <input type="text" name="namapeminjam" class="form-control" id="namapeminjam" value="{{ old('namapeminjam', $peminjaman->user->nama ?? '') }}" readonly style="font-weight: bold; color: black;">
                            @error('namapeminjam')
                                <small>{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="organisasi">Organisasi</label>
                            <input type="text" name="organisasi" class="form-control" id="organisasi" value="{{ old('organisasi', $peminjaman->user->organisasi ?? '') }}" readonly style="font-weight: bold; color: black;">
                            @error('organisasi')
                                <small>{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="jenisaset">Jenis Aset</label>
                            <input type="text" name="jenisaset" class="form-control" id="jenisaset" value="{{ old('jenisaset', $peminjaman->getJenisAset()) }}" readonly style="font-weight: bold; color: black;">
                            @error('jenisaset')
                                <small>{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="namaaset">Nama Aset</label>
                            <input type="text" name="namaaset" class="form-control" id="namaaset" value="{{ old('namaaset', $peminjaman->getAsetName()) }}" readonly style="font-weight: bold; color: black;">
                            @error('namaaset')
                                <small>{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="tanggalpeminjaman">Tanggal Peminjaman</label>
                            <input type="date" name="tanggalpeminjaman" class="form-control" id="tanggalpeminjaman" value="{{ old('tanggalpeminjaman', $peminjaman->tanggalpeminjaman) }}" readonly style="font-weight: bold; color: black;">
                            @error('tanggalpeminjaman')
                                <small>{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="jumlahaset">Jumlah Aset</label>
                            <input type="number" name="jumlahaset" class="form-control" id="jumlahaset" min="1" oninput="this.value = this.value.replace(/[^0-9]/g, '')" value="{{ old('jumlahaset', $peminjaman->jumlahaset) }}" readonly style="font-weight: bold; color: black;">
                            @error('jumlahaset')
                                <small>{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="lampiran">Lampiran</label>
                            @if ($peminjaman->lampiran)
                                <div class="mt-2">
                                    @php
                                        $fileExtension = pathinfo($peminjaman->lampiran, PATHINFO_EXTENSION);
                                    @endphp
                                    @if (in_array($fileExtension, ['jpg', 'jpeg', 'png']))
                                        <img src="{{ asset('lampiran/' . $peminjaman->lampiran) }}" alt="Lampiran" style="max-width: 200px;">
                                    @elseif (in_array($fileExtension, ['pdf']))
                                        <iframe src="{{ asset('lampiran/' . $peminjaman->lampiran) }}" style="width: 100%; height: 500px;" frameborder="0"></iframe>
                                    @else
                                        <a href="{{ asset('lampiran/' . $peminjaman->lampiran) }}" target="_blank">{{ $peminjaman->lampiran }}</a>
                                    @endif
                                </div>
                            @endif
                            @error('lampiran')
                                <small>{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="status">Status</label>
                            <input type="text" name="status" class="form-control" id="status" value="{{ old('status', $peminjaman->status) }}" readonly style="font-weight: bold; color: black;">
                            @error('status')
                                <small>{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="card-action">
                            <button type="button" class="btn btn-success" onclick="window.location.href='{{ route('admin.arsiptolak') }}'">Kembali</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
