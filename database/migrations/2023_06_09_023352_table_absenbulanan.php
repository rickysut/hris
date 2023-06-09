<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('absenbulanan', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nik');
            $table->timestamp('bulan');
            $table->integer('harikerja')->nullable();
            $table->float('jamnormal', 8, 2)->nullable();
            $table->float('jamefektif', 8, 2)->nullable();
            $table->integer('hadir')->nullable();
            $table->integer('hadirkerja')->nullable();
            $table->integer('hadirlibur')->nullable();
            $table->integer('tidakhadir')->nullable();
            $table->integer('haritelat')->nullable();
            $table->float('jamtelat', 8, 2)->nullable();
            $table->integer('hariplgcepat')->nullable();
            $table->integer('jamplgcepat')->nullable();
            $table->float('lembur', 8, 2)->nullable();
            $table->float('multiplikasi', 8, 2)->nullable();
            $table->integer('shift')->nullable();
            $table->integer('cuti')->nullable();
            $table->integer('mangkir')->nullable();
            $table->integer('sakit')->nullable();
            $table->integer('tdklengkap')->nullable();
            $table->integer('tdklengkapout')->nullable();
            $table->integer('dinas')->nullable();
            $table->integer('htelat')->nullable();
            $table->integer('ismanual')->nullable();
            $table->integer('cutihamil')->nullable();
            $table->dateTime('awal')->nullable();
            $table->dateTime('akhir')->nullable();
            $table->integer('terlambat60')->nullable();
            $table->integer('masakerja')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('absenbulanan');
    }
};
