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
        Schema::create('student_exams', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
$table->enum('status',['pass','repeat']);
            $table->double('mark');
            $table->foreignId('student_id')->constrained('students') ->onUpdate('cascade')
                ->onDelete('cascade');;
            $table->foreignId('exam_id')->constrained('exam') ->onUpdate('cascade')
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
        Schema::dropIfExists('student_exams');
    }
};
