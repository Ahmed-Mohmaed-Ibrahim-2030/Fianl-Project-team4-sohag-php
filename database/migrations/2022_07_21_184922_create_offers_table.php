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
        Schema::create('offers', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('discount_type');
            $table->decimal('discount_value');
            $table->string('title');
            $table->dateTime('announce_date');
            $table->dateTime('start_date');
            $table->dateTime('end_date');
            $table->foreignId('course_id')->constrained('courses') ->onUpdate('cascade')
                ->onDelete('cascade');;
            $table->foreignId('admin_id')->constrained('admins') ->onUpdate('cascade')
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
        Schema::dropIfExists('offers');
    }
};
