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

        Schema::create('orange_visited_country_policy', function (Blueprint $table) {
            $table->id();
            $table->foreignId('orange_visited_country_id')->constrained('orange_visited_countries')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('policy_id')->unique()->constrained('policies')->cascadeOnDelete()->cascadeOnUpdate();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orange_visited_country_policy');
    }
};
