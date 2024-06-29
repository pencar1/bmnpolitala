<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ruangan extends Model
{
    use HasFactory;

    // Nama tabel yang akan digunakan oleh model ini
    protected $table = 'ruangans';

    // Primary key dari tabel
    protected $primaryKey = 'idruangan';

    // Menentukan apakah primary key menggunakan auto-increment atau tidak
    public $incrementing = true;

    // Tipe data dari primary key
    protected $keyType = 'int';

    // Menentukan apakah timestamps digunakan atau tidak
    public $timestamps = false;

    // Kolom-kolom yang dapat diisi secara massal
    protected $fillable = [
        'namaruangan',
        'deskripsiruangan',
        'foto',
        'stokruangan',
    ];
    public function kurangiStokr($jumlah)
    {
        if ($this->stokruangan >= $jumlah) {
            $this->stokruangan -= $jumlah;
            $this->save();
            return true;
        } else {
            return false;
        }
    }

    public function tambahStokr($jumlah)
    {
        $this->stokruangan += $jumlah;
        $this->save();
        return true;
    }
}
