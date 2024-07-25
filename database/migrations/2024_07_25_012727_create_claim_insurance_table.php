<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('claim_insurance', function (Blueprint $table) {
            $table->unsignedBigInteger('insurance_id');
            $table->unsignedBigInteger('claim_id');
            $table->date('date');
            $table->primary(['insurance_id', 'claim_id']);
            $table->foreign('insurance_id')->references('id')->on('insurances')->onDelete('cascade');
            $table->foreign('claim_id')->references('id')->on('claims')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('claim_insurance', function (Blueprint $table) {
            //
        });
    }
};
