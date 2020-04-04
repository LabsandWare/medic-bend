<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConsultationNoteTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('consultation_note', function (Blueprint $table) {
            $table->id();
            $table->string('observation');
            $table->string('diagnosis');
            $table->string('test');
            $table->unsignedBigInteger('drug_id')->nullable();
            $table->timestamps();
        });

        Schema::table('consultation_note', function($table) {
            $table->foreign('drug_id')->references('id')->on('drug_orders');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('consultation_note_');
    }
}
