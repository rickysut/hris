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
        Schema::create('shift', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('code')->unique();
            $table->string('name')->nullable();
            $table->time('start');
            $table->time('stop');
            $table->boolean('use_break')->default(false);
            $table->time('breakstart');
            $table->time('breakstop');
            $table->unsignedBigInteger('shift_id')->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('shift_id')
                ->references('id')
                ->on('shift')
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
        Schema::dropIfExists('shift');
    }
};
