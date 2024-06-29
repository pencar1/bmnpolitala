<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('pengembalians', function (Blueprint $table) {
            $table->increments('idpengembalian');
            $table->unsignedInteger('idpeminjaman')->nullable();
            $table->unsignedInteger('idbarang'); // Tambahkan kolom idbarang
            $table->unsignedInteger('idtransportasi'); // Tambahkan kolom idbarang
            $table->unsignedInteger('idruangan'); // Tambahkan kolom idbarang
            $table->date('tanggalpengembalian');

            // Define foreign key constraints
            $table->foreign('idpeminjaman')->references('idpeminjaman')->on('peminjamans')->onDelete('cascade');
            $table->foreign('idbarang')->references('idbarang')->on('barangs')->onDelete('cascade'); // Tambahkan foreign key untuk idbarang
            $table->foreign('idtransportasi')->references('idtransportasi')->on('transportasis')->onDelete('cascade'); // Tambahkan foreign key untuk idbarang
            $table->foreign('idruangan')->references('idruangan')->on('ruangans')->onDelete('cascade'); // Tambahkan foreign key untuk idbarang
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengembalians');
    }
};



// <?php

// use Illuminate\Database\Migrations\Migration;
// use Illuminate\Database\Schema\Blueprint;
// use Illuminate\Support\Facades\Schema;

// return new class extends Migration
// {
//     /**
//      * Run the migrations.
//      */
//     public function up(): void
//     {
//         Schema::create('pengembalians', function (Blueprint $table) {
//             $table->increments('idpengembalian');
//             $table->unsignedInteger('idpeminjaman')->nullable();
//             $table->date('tanggalpengembalian');

//             // Define foreign key constraints
//             $table->foreign('idpeminjaman')->references('idpeminjaman')->on('peminjamans')->onDelete('cascade');
//         });
//     }

//     /**
//      * Reverse the migrations.
//      */
//     public function down(): void
//     {
//         Schema::dropIfExists('pengembalians');
//     }
// };
