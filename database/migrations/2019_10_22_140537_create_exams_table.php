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
            $table->uuid('id')->primary();
            $table->uuid('class_id');
            $table->foreign('class_id')->references('id')->on('classes');
            $table->uuid('subject_id');
            $table->foreign('subject_id')->references('id')->on('subjects');
            $table->integer('base_score');
            $table->date('date');
            $table->integer('hours');
            $table->integer('minutes');
            $table->boolean('hasStarted')->default(0);
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
