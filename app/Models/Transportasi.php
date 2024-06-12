<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transportasi extends Model
{
    use HasFactory;

    // Nama tabel yang akan digunakan oleh model ini
    protected $table = 'transportasis';

    // Primary key dari tabel
    protected $primaryKey = 'idtransportasi';
    

    // Menentukan apakah primary key menggunakan auto-increment atau tidak
    public $incrementing = true;

    // Tipe data dari primary key
    protected $keyType = 'int';

    // Menentukan apakah timestamps digunakan atau tidak
    public $timestamps = false;

    // Kolom-kolom yang dapat diisi secara massal
    protected $fillable = [
        'namatransportasi',
        'merktransportasi',
        'stoktransportasi',
        'deskripsitransportasi',
        'foto',
    ];

    public function kurangiStokt($jumlah)
    {
        if ($this->stoktransportasi >= $jumlah) {
            $this->stoktransportasi -= $jumlah;
            $this->save();
            return true;
        } else {
            return false;
        }
    }

    public function tambahStokt($jumlah)
    {
        $this->stoktransportasi += $jumlah;
        $this->save();
        return true;
    }

}
