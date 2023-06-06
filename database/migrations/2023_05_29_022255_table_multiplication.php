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
        Schema::create('multiplication', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('code')->unique();
            $table->string('name');
            $table->integer('h1');
            $table->integer('h2');
            $table->integer('h3');
            $table->integer('h4');
            $table->integer('h5');
            $table->integer('h6');
            $table->integer('h7');
            $table->integer('h8');
            $table->integer('h9');
            $table->integer('h10');
            $table->integer('h11');
            $table->integer('h12');
            $table->integer('h13');
            $table->integer('h14');
            $table->integer('h15');
            $table->integer('h16');
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
        Schema::dropIfExists('multiplication');
    }
};
