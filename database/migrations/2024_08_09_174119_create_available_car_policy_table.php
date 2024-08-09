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
        Schema::create('available_car_policy', function (Blueprint $table) {
            $table->id();
            $table->foreignId('available_car_id')->constrained('available_cars')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('policy_id')->constrained('policies')->cascadeOnDelete()->cascadeOnUpdate();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('available_car_policy');
    }
};
