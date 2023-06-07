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
        Schema::create('leave_type', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->integer('max_day');
            $table->integer('admin_only');
            $table->integer('can_carried_forward')->nullable();
            $table->integer('percentage_carried_forward')->nullable();
            $table->integer('period_carried_forward')->nullable(); // day, month or year
            $table->integer('cut_employee_leave')->nullable();
            $table->timestamp('start_date_available')->nullable();
            $table->timestamp('end_date_available')->nullable();
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
        Schema::dropIfExists('leave_type');
    }
};
