<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Schema::create('insurance_user', function (Blueprint $table) {
        //     $table->foreignId('insurance_id')->constrained('insurances')->cascadeOnDelete();
        //     $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
        //     $table->primary(['insurance_id', 'user_id']);
        //     $table->timestamps();
        // });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('insurance_user');
    }
};
