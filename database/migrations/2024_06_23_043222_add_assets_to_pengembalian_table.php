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
        Schema::table('pengembalians', function (Blueprint $table) {
            if (Schema::hasColumn('pengembalians', 'idbarang')) {
                $table->dropForeign(['idbarang']);
                $table->dropColumn('idbarang');
            }
            if (Schema::hasColumn('pengembalians', 'idtransportasi')) {
                $table->dropForeign(['idtransportasi']);
                $table->dropColumn('idtransportasi');
            }
            if (Schema::hasColumn('pengembalians', 'idruangan')) {
                $table->dropForeign(['idruangan']);
                $table->dropColumn('idruangan');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pengembalians', function (Blueprint $table) {
            $table->unsignedInteger('idbarang')->nullable();
            $table->unsignedInteger('idtransportasi')->nullable();
            $table->unsignedInteger('idruangan')->nullable();

            $table->foreign('idbarang')->references('idbarang')->on('barangs')->onDelete('cascade');
            $table->foreign('idtransportasi')->references('idtransportasi')->on('transportasis')->onDelete('cascade');
            $table->foreign('idruangan')->references('idruangan')->on('ruangans')->onDelete('cascade');
        });
    }
};
