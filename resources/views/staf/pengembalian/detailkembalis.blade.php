@extends('layout.layoutstaf')

@section('content')

<div class="page-inner">
    <div class="page-header">
        <div class="col-md-12">
            <form action="{{ route('staf.pengembalian.detail', ['id' => $peminjaman->idpeminjaman]) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">Detail Pengembalian</div>
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
                            <label for="tanggalpengembalian">Tanggal Pengembalian</label>
                            <input type="date" name="tanggalpengembalian" class="form-control" id="tanggalpengembalian" value="{{ old('tanggalpengembalian', $peminjaman->pengembalian->tanggalpengembalian) }}" readonly style="font-weight: bold; color: black;">
                            @error('tanggalpengembalian')
                                <small>{{ $message }}</small>
                            @enderror
                        </div>
                        @if($peminjaman->getJenisAset() == 'barang' || $peminjaman->getJenisAset() == 'transportasi')
                            <div class="form-group">
                                <label for="jumlahaset">Jumlah Aset</label>
                                <input type="number" name="jumlahaset" class="form-control" id="jumlahaset" min="1" value="{{ old('jumlahaset', $peminjaman->jumlahaset) }}" readonly style="font-weight: bold; color: black;">
                                @error('jumlahaset')
                                    <small>{{ $message }}</small>
                                @enderror
                            </div>
                        @endif
                        <div class="form-group">
                            <label for="lampiran">Lampiran</label>
                            @if ($peminjaman->lampiran)
                                <div class="mt-2">
                                    @if (in_array(pathinfo($peminjaman->lampiran, PATHINFO_EXTENSION), ['jpg', 'jpeg', 'png']))
                                        <img src="{{ asset('lampiran/' . $peminjaman->lampiran) }}" alt="Lampiran" style="max-width: 200px; cursor: pointer;" data-toggle="modal" data-target="#lampiranModal">
                                    @elseif (in_array(pathinfo($peminjaman->lampiran, PATHINFO_EXTENSION), ['pdf', 'doc', 'docx']))
                                        <a href="{{ asset('lampiran/' . $peminjaman->lampiran) }}" style="cursor: pointer;" data-toggle="modal" data-target="#lampiranModal">{{ $peminjaman->lampiran }}</a>
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
                            <button type="button" class="btn btn-success" onclick="window.location.href='{{ route('staf.pengembalian') }}'">Kembali</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="lampiranModal" tabindex="-1" role="dialog" aria-labelledby="lampiranModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="lampiranModalLabel">Lampiran</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body text-center">
                @if (in_array(pathinfo($peminjaman->lampiran, PATHINFO_EXTENSION), ['jpg', 'jpeg', 'png']))
                    <img src="{{ asset('lampiran/' . $peminjaman->lampiran) }}" alt="Lampiran" class="img-fluid">
                @elseif (in_array(pathinfo($peminjaman->lampiran, PATHINFO_EXTENSION), ['pdf']))
                    <iframe src="{{ asset('lampiran/' . $peminjaman->lampiran) }}" width="100%" height="500px"></iframe>
                @elseif (in_array(pathinfo($peminjaman->lampiran, PATHINFO_EXTENSION), ['doc', 'docx']))
                    <iframe src="https://view.officeapps.live.com/op/embed.aspx?src={{ urlencode(asset('lampiran/' . $peminjaman->lampiran)) }}" width="100%" height="500px"></iframe>
                @else
                    <p>File tidak dapat ditampilkan.</p>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
