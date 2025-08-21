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
        Schema::create('activations', function (Blueprint $table) {
            $table->id('activation_id');
            $table->unsignedBigInteger('employer_id');
            $table->unsignedBigInteger('employee_id');
            $table->string('employee_key');
            $table->string('mac_address');
            $table->boolean('is_active');
            $table->timestamps();
            
            $table->foreign('employer_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('employee_id')->references('employee_id')->on('employees')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('activations');
    }
};
