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
            $table->foreignId('insurance_id')->constrained('insurances')->cascadeOnDelete();
            $table->foreignId('insurance_type_id')->constrained('insurance_types')->cascadeOnDelete();
            $table->primary(['insurance_id', 'insurance_type_id']);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('insurance_insurance_type');
    }
};
