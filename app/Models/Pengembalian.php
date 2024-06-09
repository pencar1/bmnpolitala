<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengembalian extends Model
{
    use HasFactory;

    // Nama tabel yang akan digunakan oleh model ini
    protected $table = 'pengembalians';

    // Primary key dari tabel
    protected $primaryKey = 'idpengembalian';

    // Menentukan apakah primary key menggunakan auto-increment atau tidak
    public $incrementing = true;

    // Tipe data dari primary key
    protected $keyType = 'int';

    // Menentukan apakah timestamps digunakan atau tidak
    public $timestamps = true;

    // Kolom-kolom yang dapat diisi secara massal
    protected $fillable = [
        'idpeminjaman',
        'tanggalpengembalian',
    ];

    // Relationship ke model Barang
    public function barang()
    {
        return $this->belongsTo(Peminjaman::class, 'idpeminjaman', 'idpeminjaman');
    }
}
