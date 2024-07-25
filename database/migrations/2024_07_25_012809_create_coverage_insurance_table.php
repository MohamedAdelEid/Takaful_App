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
        Schema::create('coverage_insurance', function (Blueprint $table) {
            $table->unsignedBigInteger('coverage_id');
            $table->unsignedBigInteger('insurance_id');
            $table->decimal('discount', 10, 2);
            $table->primary(['coverage_id', 'insurance_id']);
            $table->foreign('coverage_id')->references('id')->on('coverages')->onDelete('cascade');
            $table->foreign('insurance_id')->references('id')->on('insurances')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('coverage_insurance', function (Blueprint $table) {
            //
        });
    }
};
