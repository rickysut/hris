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
        Schema::create('setup_payroll', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->double('t_masakerja');
            $table->double('t_uangmakan');
            $table->double('tjtt');
            $table->double('t_bensin');
            $table->double('t_team');
            $table->double('bpjs_kes');
            $table->double('bpjs_naker');
            $table->double('pot_lain');
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
        Schema::dropIfExists('setup_payroll');
    }
};
