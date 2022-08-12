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
        Schema::create('courses_content', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('content_type');
            $table->string('source');
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
        Schema::dropIfExists('courses_content');
    }
};
