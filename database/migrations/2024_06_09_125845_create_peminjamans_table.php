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
        Schema::create('peminjamans', function (Blueprint $table) {
            $table->increments('idpeminjaman');
            $table->unsignedBigInteger('iduser')->nullable();
            $table->unsignedInteger('idbarang')->nullable();
            $table->unsignedInteger('idtransportasi')->nullable();
            $table->unsignedInteger('idruangan')->nullable();
            $table->date('tanggalpeminjaman');
            $table->string('lampiran')->nullable();
            $table->string('alasanpenolakan')->nullable();
            $table->string('status')->nullable();

            // Define foreign key constraints
            $table->foreign('iduser')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('idbarang')->references('idbarang')->on('barangs')->onDelete('cascade');
            $table->foreign('idtransportasi')->references('idtransportasi')->on('transportasis')->onDelete('cascade');
            $table->foreign('idruangan')->references('idruangan')->on('ruangans')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('peminjamans');
    }
};
