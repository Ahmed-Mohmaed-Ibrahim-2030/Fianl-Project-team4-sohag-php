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
        Schema::create('instructors_support', function (Blueprint $table) {
            $table->id();
            $table->string('support');
            $table->unsignedBigInteger('instructor_id');
 
            $table->foreign('instructor_id')->references('id')->on('instructors');
            $table->unsignedBigInteger('admin_id');
 
            $table->foreign('admin_id')->references('id')->on('admins');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('instructors_support');
    }
};
