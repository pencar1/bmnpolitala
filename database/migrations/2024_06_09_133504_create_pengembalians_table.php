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
            $table->date('tanggalpengembalian')->nullable();

            // Define foreign key constraints
            $table->foreign('idpeminjaman')->references('idpeminjaman')->on('peminjamans')->onDelete('cascade');
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
