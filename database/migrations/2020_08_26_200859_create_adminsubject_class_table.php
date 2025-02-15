<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdminsubjectClassTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('adminsubject_class', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('adminsubject_id');
            $table->foreign('adminsubject_id')->references('id')->on('admin_subject')->onDelete('cascade');
            $table->uuid('class_id');
            $table->foreign('class_id')->references('id')->on('classes')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('adminsubject_class');
    }
}
