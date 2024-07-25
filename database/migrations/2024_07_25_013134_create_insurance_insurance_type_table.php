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
        Schema::create('insurance_insurance_type', function (Blueprint $table) {
            $table->unsignedInteger('insurance_id');
            $table->unsignedInteger('insurance_type_id');
            $table->primary(['insurance_id', 'insurance_type_id']);
            $table->foreign('insurance_id')->references('id')->on('insurances')->onDelete('cascade');
            $table->foreign('insurance_type_id')->references('insurance_type_id')->on('insurance_types')->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('insurance_insurance_type', function (Blueprint $table) {
            //
        });
    }
};
