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
        Schema::create('courses_rate', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->tinyInteger('rate');
            $table->string('comment');
            $table->foreignId('student_id')->constrained('students') ->onUpdate('cascade')
                ->onDelete('cascade');;
            $table->foreignId('course_id')->constrained('courses') ->onUpdate('cascade')
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
        Schema::dropIfExists('courses_rate');
    }
};
