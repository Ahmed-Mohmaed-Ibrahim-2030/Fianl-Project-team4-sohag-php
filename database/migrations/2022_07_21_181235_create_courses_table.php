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
            $table->foreign('sub_category_id')->references('id')->on('sub_categories') ->onUpdate('cascade')
                ->onDelete('cascade');;
            $table->unsignedBigInteger('instructor_id');
            $table->foreign('instructor_id')->references('id')->on('instructors') ->onUpdate('cascade')
                ->onDelete('cascade');;
            $table->string('small_desc');
            $table->text('description');
            $table->decimal('price');


            $table->double('totalHours')->nullable(true);
            $table->integer('videosCount')->nullable(true);
            $table->string('image')->nullable(true);

            $table->boolean('reviewed')->default(0);
//
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
