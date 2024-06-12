<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Peminjaman extends Model
{
    use HasFactory;

    // Nama tabel yang akan digunakan oleh model ini
    protected $table = 'peminjamans';

    // Primary key dari tabel
    protected $primaryKey = 'idpeminjaman';

    // Menentukan apakah primary key menggunakan auto-increment atau tidak
    public $incrementing = true;

    // Tipe data dari primary key
    protected $keyType = 'int';

    // Menentukan apakah timestamps digunakan atau tidak
    public $timestamps = false;

    // Kolom-kolom yang dapat diisi secara massal
    protected $fillable = [
        'iduser',
        'idbarang',
        'idtransportasi',
        'idruangan',
        'tanggalpeminjaman',
        'lampiran',
        'alasanpenolakan',
        'status',
    ];

    // Relationship ke model User
    public function user()
    {
        return $this->belongsTo(User::class, 'iduser', 'id');
    }

    // Relationship ke model Barang
    public function barang()
    {
        return $this->belongsTo(Barang::class, 'idbarang', 'idbarang');
    }

    // Relationship ke model Transportasi
    public function transportasi()
    {
        return $this->belongsTo(Transportasi::class, 'idtransportasi', 'idtransportasi');
    }

    // Relationship ke model Ruangan
    public function ruangan()
    {
        return $this->belongsTo(Ruangan::class, 'idruangan', 'idruangan');
    }

    public function getNama()
    {
        return $this->user ? $this->user->nama : 'Nama tidak ditemukan';
    }

    public function getAsetName()
    {
        if ($this->idbarang) {
            return $this->barang ? $this->barang->namabarang : 'Barang tidak ditemukan';
        } elseif ($this->idtransportasi) {
            return $this->transportasi ? $this->transportasi->namatransportasi : 'Transportasi tidak ditemukan';
        } elseif ($this->idruangan) {
            return $this->ruangan ? $this->ruangan->namaruangan : 'Ruangan tidak ditemukan';
        }
        return 'Aset tidak ditemukan';
    }
}