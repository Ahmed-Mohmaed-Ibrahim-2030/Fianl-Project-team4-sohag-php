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
        Schema::create('students_support', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('support');

            $table->foreignId('admin_id')->constrained('admins') ->onUpdate('cascade')
                ->onDelete('cascade');;
            $table->foreignId('student_id')->constrained('students') ->onUpdate('cascade')
                ->onDelete('cascade');;










        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('students_support');
    }
};
