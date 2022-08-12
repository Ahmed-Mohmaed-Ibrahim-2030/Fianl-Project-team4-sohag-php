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
        Schema::create('exam', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            // $table->unsignedBigInteger('exam_id');
            $table->date('announce_date');
            $table->dateTime('start_date');
            $table->double('hours');
            $table->double('mark');
            $table->foreignId('course_id')->constrained('courses') ->onUpdate('cascade')
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
        Schema::dropIfExists('exam');
    }
};
