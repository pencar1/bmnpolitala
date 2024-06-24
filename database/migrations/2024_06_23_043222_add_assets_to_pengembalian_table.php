<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('pengembalians', function (Blueprint $table) {
            $table->unsignedBigInteger('idbarang')->nullable();
            $table->unsignedBigInteger('idtransportasi')->nullable();
            $table->unsignedBigInteger('idruangan')->nullable();

            $table->foreign('idbarang')->references('idbarang')->on('barangs')->onDelete('cascade');
            $table->foreign('idtransportasi')->references('idtransportasi')->on('transportasis')->onDelete('cascade');
            $table->foreign('idruangan')->references('idruangan')->on('ruangans')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::table('pengembalians', function (Blueprint $table) {
            $table->dropForeign(['idbarang']);
            $table->dropForeign(['idtransportasi']);
            $table->dropForeign(['idruangan']);

            $table->dropColumn('idbarang');
            $table->dropColumn('idtransportasi');
            $table->dropColumn('idruangan');
        });
    }
};
