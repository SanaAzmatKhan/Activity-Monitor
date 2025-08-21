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
        Schema::create('logs', function (Blueprint $table) {
            $table->id('log_id');
            $table->string('log_type');
            $table->unsignedBigInteger('employer_id');
            $table->unsignedBigInteger('employee_id');
            $table->integer('total_usage');
            $table->integer('idle_time');
            $table->timestamps();
        });

        $table->foreign('employee_id')->references('employee_id')->on('employees')->onUpdate('cascade')->onDelete('cascade');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('logs');
    }
};
