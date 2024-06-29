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
            if (!Schema::hasColumn('pengembalians', 'idbarang')) {
                $table->unsignedInteger('idbarang')->nullable();
            }
            if (!Schema::hasColumn('pengembalians', 'idtransportasi')) {
                $table->unsignedInteger('idtransportasi')->nullable();
            }
            if (!Schema::hasColumn('pengembalians', 'idruangan')) {
                $table->unsignedInteger('idruangan')->nullable();
            }

            // Define foreign key constraints if columns added
            if (!Schema::hasColumn('pengembalians', 'idbarang')) {
                $table->foreign('idbarang')->references('idbarang')->on('barangs')->onDelete('cascade');
            }
            if (!Schema::hasColumn('pengembalians', 'idtransportasi')) {
                $table->foreign('idtransportasi')->references('idtransportasi')->on('transportasis')->onDelete('cascade');
            }
            if (!Schema::hasColumn('pengembalians', 'idruangan')) {
                $table->foreign('idruangan')->references('idruangan')->on('ruangans')->onDelete('cascade');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
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
};


// <?php

// use Illuminate\Database\Migrations\Migration;
// use Illuminate\Database\Schema\Blueprint;
// use Illuminate\Support\Facades\Schema;

// return new class extends Migration
// {
//     public function up()
//     {
//         Schema::table('pengembalians', function (Blueprint $table) {
//             $table->unsignedBigInteger('idbarang')->nullable();
//             $table->unsignedBigInteger('idtransportasi')->nullable();
//             $table->unsignedBigInteger('idruangan')->nullable();

//             $table->foreign('idbarang')->references('idbarang')->on('barangs')->onDelete('cascade');
//             $table->foreign('idtransportasi')->references('idtransportasi')->on('transportasis')->onDelete('cascade');
//             $table->foreign('idruangan')->references('idruangan')->on('ruangans')->onDelete('cascade');
//         });
//     }

//     public function down()
//     {
//         Schema::table('pengembalians', function (Blueprint $table) {
//             $table->dropForeign(['idbarang']);
//             $table->dropForeign(['idtransportasi']);
//             $table->dropForeign(['idruangan']);

//             $table->dropColumn('idbarang');
//             $table->dropColumn('idtransportasi');
//             $table->dropColumn('idruangan');
//         });
//     }
// };
