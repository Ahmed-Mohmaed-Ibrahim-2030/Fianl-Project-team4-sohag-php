<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExamsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('exams', function (Blueprint $table) {
            $table->id();
        //exam date
        $table->dateTime('exam_date');
        $table-> string ('exam_title');
         $table->unsignedBigInteger('course_id')->nullable();
        $table->foreign('course_id')->references('id')->on('courses');
        // $table->unsignedBigInteger('created_by');
        // $table->foreign('created_by')->references('id')->on('admins');
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
        Schema::dropIfExists('exams');
    }
}
