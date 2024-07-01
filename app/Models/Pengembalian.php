<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengembalian extends Model
{
    use HasFactory;

    protected $table = 'pengembalians';
    protected $primaryKey = 'idpengembalian';
    public $incrementing = true;
    protected $keyType = 'int';
    public $timestamps = false;

    protected $fillable = [
        'idpeminjaman',
        'tanggalpengembalian',
    ];

    public function peminjaman()
    {
        return $this->belongsTo(Peminjaman::class, 'idpeminjaman', 'idpeminjaman');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'iduser', 'id');
    }

    // Model Pengembalian
    public function barang()
    {
        return $this->belongsTo(Barang::class, 'idbarang', 'idbarang');
    }

    public function transportasi()
    {
        return $this->belongsTo(Transportasi::class, 'idtransportasi', 'idtransportasi');
    }

    public function ruangan()
    {
        return $this->belongsTo(Ruangan::class, 'idruangan', 'idruangan');
    }

    // Model Pengembalian
    public function getJenisAset()
    {
        if ($this->idbarang) {
            return 'barang';
        } elseif ($this->idtransportasi) {
            return 'transportasi';
        } elseif ($this->idruangan) {
            return 'ruangan';
        }
        return 'Aset tidak ditemukan';
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

