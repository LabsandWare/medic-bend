<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLabsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('labs', function (Blueprint $table) {
            $table->id();
            $table->string('lab_name');
            $table->text('why');
            $table->string('photo');
            $table->unsignedBigInteger('user_id')->nullable();
            $table->unsignedBigInteger('test_id')->nullable();
            $table->timestamps();
        });

        Schema::table('labs', function($table) {
            $table->foreign('test_id')->references('id')->on('tests');
            $table->foreign('user_id')->references('id')->on('users');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('labs');
    }
}
