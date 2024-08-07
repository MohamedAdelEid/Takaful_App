<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('dependent_traveler', function (Blueprint $table) {
            $table->id();
            $table->foreignId('dependent_id')->constrained('dependents')->cascadeOnDelete();
            $table->foreignId('traveler_id')->constrained('travelers')->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dependent_traveler');
    }
};
