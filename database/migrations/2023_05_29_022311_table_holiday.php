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
        Schema::create('holiday', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->date('event_date')->unique();
            $table->string('description')->nullable();
            $table->unsignedBigInteger('multi_code');
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('multi_code')
                ->references('id')
                ->on('multiplication')
                ->onUpdate('cascade')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('holiday');
    }
};
