<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    use HasFactory;

    // Nama tabel yang akan digunakan oleh model ini
    protected $table = 'barangs';

    // Primary key dari tabel
    protected $primaryKey = 'idbarang';

    // Menentukan apakah primary key menggunakan auto-increment atau tidak
    public $incrementing = true;

    // Tipe data dari primary key
    protected $keyType = 'int';

    // Menentukan apakah timestamps digunakan atau tidak
    public $timestamps = false;

    // Kolom-kolom yang dapat diisi secara massal
    protected $fillable = [
        'namabarang',
        'merkbarang',
        'stokbarang',
        'deskripsibarang',
        'foto',
    ];

    public function kurangiStokb($jumlah)
    {
        if ($this->stokbarang >= $jumlah) {
            $this->stokbarang -= $jumlah;
            $this->save();
            return true;
        } else {
            return false;
        }
    }

    public function tambahStokb($jumlah)
    {
        $this->stokbarang += $jumlah;
        $this->save();
        return true;

    }
}
