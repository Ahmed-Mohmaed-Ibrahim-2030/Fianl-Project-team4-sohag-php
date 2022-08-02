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
        Schema::create('courses', function (Blueprint $table) {
            $table->id();

            $table->string('name');
            $table->unsignedBigInteger('sub_category_id');
            $table->foreign('sub_category_id')->references('id')->on('sub_categories');
            $table->unsignedBigInteger('instructor_id');
            $table->foreign('instructor_id')->references('id')->on('instructors');
            $table->string('small_desc');
            $table->text('description');
            $table->decimal('price');
            // $table->decimal('fess');

            $table->double('totalHours')->nullable(true);
            $table->integer('videosCount')->nullable(true);
            $table->string('image')->nullable(true);
            // $table->foreignId('instructor_id')->constrained('instructors');
//            $table->unsignedBigInteger('accepted_by')->nullable(true);
            $table->boolean('reviewed')->default(0);
            $table->foreignId('accepted_by')->nullable()->constrained('admins','id');
//            $table->foreign('accepted_by')->references('id')->on('admins');
//            $table->foreignId('sub_category_id')->constrained('sub_categories');
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
        Schema::dropIfExists('courses');
    }
};
