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
        Schema::create('premiums', function (Blueprint $table) {
            $table->id();
            $table->foreignId('policy_id')->constrained('policies')->cascadeOnDelete()->cascadeOnUpdate();
            $table->decimal('net_premiums', 10, 2);
            $table->decimal('tax', 10, 2);
            $table->decimal('supervision_fees', 10, 2);
            $table->decimal('stamps', 10, 2);
            $table->decimal('issuance_fees', 10, 2);
            $table->decimal('total_premium', 10, 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('premiums');
    }
};
