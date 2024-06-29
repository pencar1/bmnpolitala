@extends('layout.layoutstaf')

@section('content')

<div class="page-inner">
    <div class="page-header">
        <div class="col-md-12">
            <form action="{{ route('staf.peminjaman.updatestp', ['id' => $data->idpeminjaman]) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">Form Edit Peminjaman</div>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="jenisaset">Jenis Aset</label>
                            <input type="text" name="jenisaset" class="form-control" id="jenisaset" value="{{ old('jenisaset', $jenisAset) }}" readonly style="font-weight: bold; color: black;">
                            @error('jenisaset')
                                <small>{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="namaaset">Nama Aset</label>
                            <input type="text" name="namaaset" class="form-control" id="namaaset" value="{{ old('namaaset', $namaAset) }}" readonly style="font-weight: bold; color: black;">
                            @error('namaaset')
                                <small>{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="tanggalpeminjaman">Tanggal Peminjaman</label>
                            <input type="date" name="tanggalpeminjaman" class="form-control" id="tanggalpeminjaman" value="{{ old('tanggalpeminjaman', $data->tanggalpeminjaman) }}" placeholder="Masukkan Tanggal Peminjaman" min="{{ date('Y-m-d') }}">
                            @error('tanggalpeminjaman')
                                <small>{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="jumlahaset">Jumlah Aset</label>
                            <input type="number" name="jumlahaset" class="form-control" id="jumlahaset" min="1" oninput="this.value = this.value.replace(/[^0-9]/g, '')" value="{{ old('jumlahaset', $data->jumlahaset) }}" placeholder="Masukkan Jumlah Aset">
                            @error('jumlahaset')
                                <small>{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="lampiran">Lampiran</label>
                            @if ($data->lampiran)
                                <div class="mt-2">
                                    @if (in_array(pathinfo($data->lampiran, PATHINFO_EXTENSION), ['jpg', 'jpeg', 'png']))
                                        <img src="{{ asset('lampiran/' . $data->lampiran) }}" alt="Lampiran" style="max-width: 200px; cursor: pointer;" data-toggle="modal" data-target="#lampiranModal">
                                    @elseif (in_array(pathinfo($data->lampiran, PATHINFO_EXTENSION), ['pdf', 'doc', 'docx']))
                                        <a href="{{ asset('lampiran/' . $data->lampiran) }}" style="cursor: pointer;" data-toggle="modal" data-target="#lampiranModal">{{ $data->lampiran }}</a>
                                    @else
                                        <a href="{{ asset('lampiran/' . $data->lampiran) }}" target="_blank">{{ $data->lampiran }}</a>
                                    @endif
                                </div>
                            @endif
                            @error('lampiran')
                                <small>{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlSelect1">Status</label>
                            <select class="form-control" id="exampleFormControlSelect1" name="status">
                                <option value="diproses" {{ $data->status == 'diproses' ? 'selected' : '' }}>Diproses</option>
                                <option value="ditolak" {{ $data->status == 'ditolak' ? 'selected' : '' }}>Ditolak</option>
                                <option value="disetujui" {{ $data->status == 'disetujui' ? 'selected' : '' }}>Disetujui</option>
                                <option value="dipinjam" {{ $data->status == 'dipinjam' ? 'selected' : '' }}>Dipinjam</option>
                            </select>
                            @error('status')
                                <small>{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="card-action">
                        <button type="submit" class="btn btn-success">Simpan</button>
                        <button type="button" class="btn btn-danger" onclick="window.location.href='{{ route('staf.dashboard') }}'">Batal</button>
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
                @if (in_array(pathinfo($data->lampiran, PATHINFO_EXTENSION), ['jpg', 'jpeg', 'png']))
                    <img src="{{ asset('lampiran/' . $data->lampiran) }}" alt="Lampiran" class="img-fluid">
                @elseif (in_array(pathinfo($data->lampiran, PATHINFO_EXTENSION), ['pdf']))
                    <iframe src="{{ asset('lampiran/' . $data->lampiran) }}" width="100%" height="500px"></iframe>
                @elseif (in_array(pathinfo($data->lampiran, PATHINFO_EXTENSION), ['doc', 'docx']))
                    <object data="{{ asset('lampiran/' . $data->lampiran) }}" type="application/vnd.openxmlformats-officedocument.wordprocessingml.document" width="100%" height="500px">
                        <p>Tidak dapat menampilkan file. Anda bisa <a href="{{ asset('lampiran/' . $data->lampiran) }}">unduh file</a> untuk melihatnya.</p>
                    </object>
                @else
                    <p>File tidak dapat ditampilkan.</p>
                @endif
            </div>
        </div>
    </div>
</div>

@endsection
