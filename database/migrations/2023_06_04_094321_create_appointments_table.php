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
        Schema::create('appointments', function (Blueprint $table) {
            $table->id();
            $table->foreignId("patient_id")->constrained('patients', 'patient_id');
            $table->foreignId("doctor_id")->constrained('doctors', 'doctor_id');
            $table->string("doctor_name");
            $table->string("date_bs");
            $table->string("date_ad")->nullable();
            $table->string('time_slot');
            $table->longText('problem_desc');
            $table->boolean('approved')->default(0);
            $table->boolean('status')->default(0);
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
        Schema::dropIfExists('appointments');
    }
};
