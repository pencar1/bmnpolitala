@extends('layout.layoutstaf')

@section('content')

<div class="page-inner">
    <div class="page-header">
        <div class="col-md-12">
            <form action="{{ route('staf.peminjaman.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">Form Tambah Peminjaman</div>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="jenisAsetSelect">Jenis Aset</label>
                            <select class="form-control" id="jenisAsetSelect" name="jenisaset">
                                <option selected disabled hidden>Pilih Jenis Aset</option>
                                <option value="barang" {{ old('jenisaset') == 'barang' ? 'selected' : '' }}>Barang</option>
                                <option value="transportasi" {{ old('jenisaset') == 'transportasi' ? 'selected' : '' }}>Transportasi</option>
                                <option value="ruangan" {{ old('jenisaset') == 'ruangan' ? 'selected' : '' }}>Ruangan</option>
                            </select>
                            @error('jenisaset')
                                <small>{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="asetSelect">Aset</label>
                            <select class="form-control" id="asetSelect" name="aset">
                                <option selected disabled hidden>Pilih Aset</option>
                                @if(old('jenisaset') == 'barang')
                                    @foreach($barangs as $barang)
                                        <option value="{{ $barang->idbarang }}" {{ old('aset') == $barang->idbarang ? 'selected' : '' }}>{{ $barang->namabarang }}</option>
                                    @endforeach
                                @elseif(old('jenisaset') == 'transportasi')
                                    @foreach($transportasis as $transportasi)
                                        <option value="{{ $transportasi->idtransportasi }}" {{ old('aset') == $transportasi->idtransportasi ? 'selected' : '' }}>{{ $transportasi->namatransportasi }}</option>
                                    @endforeach
                                @elseif(old('jenisaset') == 'ruangan')
                                    @foreach($ruangans as $ruangan)
                                        <option value="{{ $ruangan->idruangan }}" {{ old('aset') == $ruangan->idruangan ? 'selected' : '' }}>{{ $ruangan->namaruangan }}</option>
                                    @endforeach
                                @endif
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
                        <button type="button" class="btn btn-danger" onclick="window.location.href='{{ route('staf.peminjaman') }}'">Batal</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const jenisAsetSelect = document.getElementById('jenisAsetSelect');
        const asetSelect = document.getElementById('asetSelect');

        jenisAsetSelect.addEventListener('change', function () {
            const selectedJenis = jenisAsetSelect.value;
            let options = '<option selected disabled hidden>Pilih Aset</option>';

            @foreach(['barang' => $barangs, 'transportasi' => $transportasis, 'ruangan' => $ruangans] as $jenis => $asets)
                if (selectedJenis === '{{ $jenis }}') {
                    @foreach($asets as $aset)
                        options += `<option value="{{ $aset->{"id$jenis"} }}">{{ $aset->{"nama$jenis"} }}</option>`;
                    @endforeach
                }
            @endforeach

            asetSelect.innerHTML = options;
        });
    });
</script>

@endsection
