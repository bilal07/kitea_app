<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRecordsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('records', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('record_title');
            $table->integer('record_owner')->nullable();
            $table->date('record_date');
            $table->integer('record_category')->nullable();
            $table->integer('parent_category')->nullable();
            $table->string('cat_name');
            $table->string('record_file');
            $table->boolean('is_recycled');
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
        Schema::dropIfExists('records');
    }
}
