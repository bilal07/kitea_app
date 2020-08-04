<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRecyclebinTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('recyclebin', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('id_record');
            $table->string('record_title');
            $table->integer('record_owner')->nullable();
            $table->date('record_date');
            $table->integer('record_category')->nullable();
            $table->string('record_file');
            $table->integer('deleted_by')->nullable();
            $table->date('deleted_date');
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
        Schema::dropIfExists('recyclebin');
    }
}
