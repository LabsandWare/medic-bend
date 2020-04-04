<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDependantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dependants', function (Blueprint $table) {
            $table->id();
            $table->enum('gender', ['male', 'female', 'others']);
            $table->enum('relationship', ['spouse', 'child', 'others']);
            $table->integer('age');
            $table->string('genotype');
            $table->string('blood_group');
            $table->unsignedBigInteger('patients_id')->nullable();
            $table->timestamps();
        });

        Schema::table('dependants', function($table) {
            $table->foreign('patients_id')->references('id')->on('patients');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('dependants');
    }
}
