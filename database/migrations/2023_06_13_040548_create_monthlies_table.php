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
            $table->integer('harikerja');
            $table->double('jamnormal');
            $table->double('jamefektif');
            $table->integer('hadir');
            $table->integer('hadirkerja');
            $table->integer('hadirlibur');
            $table->integer('tidakhadir');
            $table->integer('haritelat');
            $table->double('jamtelat');
            $table->integer('hariplgcepat');
            $table->integer('jamplgcepat');
            $table->double('lembur');
            $table->double('multiplikasi');
            $table->integer('shift');
            $table->integer('cuti');
            $table->integer('mangkir');
            $table->integer('sakit');
            $table->integer('tdklengkap');
            $table->integer('tdklengkapout');
            $table->integer('dinas');
            $table->integer('htelat');
            $table->integer('ismanual');
            $table->integer('cutihamil');
            $table->datetime('awal');
            $table->datetime('akhir');
            $table->integer('terlambat60');
            $table->integer('maskerja');
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
