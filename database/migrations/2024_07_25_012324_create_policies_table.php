<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('policies', function (Blueprint $table) {
            $table->id();
            $table->foreignId('insurance_id')->nullable()->constrained('insurances')->cascadeOnUpdate()->nullOnDelete();
            $table->foreignId('insurance_type_id')->nullable()->constrained('insurance_types')->cascadeOnUpdate()->nullOnDelete();
            $table->foreignId('user_id')->nullable()->constrained('users')->nullOnDelete()->cascadeOnUpdate();
            $table->string('name');
            $table->string('policy_number', 50)->unique();
            $table->date('start_date');
            $table->date('end_date');
            $table->decimal('total_amount', 10, 4);
            $table->text('total_amount_letters');
            $table->json('detelis');
            $table->enum('status', ['active', 'expired', 'cancelled']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('policies');
    }
};
