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
        Schema::create('attendance', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('pin');
            $table->unsignedBigInteger('karyawan_id');
            $table->date('tanggal');
            $table->timestamp('jadwalmasuk')->nullable();
            $table->timestamp('jadwalpulang')->nullable();
            $table->timestamp('masuk')->nullable();
            $table->timestamp('pulang')->nullable();
            $table->timestamp('breakout')->nullable();
            $table->timestamp('breakin')->nullable();
            $table->integer('jamefektif')->default(0);
            $table->integer('terlambat')->default(0);
            $table->integer('pulangawal')->default(0);
            $table->integer('durasibreak')->default(0);
            $table->string('idshift')->nullable();
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
        Schema::dropIfExists('attendance');
    }
};
