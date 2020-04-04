<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDrugOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('drug_orders', function (Blueprint $table) {
            $table->id();
            $table->text('medication');
            $table->text('dosage');
            $table->string('quantity');
            $table->string('provider_name');
            $table->enum('action', ['unavailable', 'dispense', 'others']);
            $table->unsignedBigInteger('patient_id');
            $table->foreign('patient_id')->references('id')->on('patients');
            $table->unsignedBigInteger('doctor_id');
            $table->foreign('doctor_id')->references('id')->on('doctors');
            $table->unsignedBigInteger('pharmacy_id');
            $table->foreign('pharmacy_id')->references('id')->on('pharmacy');
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
        Schema::dropIfExists('drug_orders');
    }
}
