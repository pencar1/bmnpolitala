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
        Schema::create('barangs', function (Blueprint $table) {
            $table->increments('idbarang'); // Primary key
            $table->string('namabarang', 50);
            $table->string('merkbarang', 50);
            $table->integer('stokbarang');
            $table->text('deskripsibarang');
            $table->string('foto')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('barangs');
    }
};
