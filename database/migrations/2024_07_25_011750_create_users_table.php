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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->foreignId('company_id')->nullable()->constrained('company')->nullOnDelete();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('nick_name');
            $table->string('passport_number')->nullable();
            $table->string('profession')->nullable();
            $table->string('email')->unique();
            $table->string('password');
            $table->string('phone')->unique();
            $table->enum('gender', ['male', 'female'])->nullable();
            $table->enum('status', ['active', 'inactive'])->default('active');
            $table->enum('role', ['user', 'company'])->default('user');
            $table->timestamp('email_verified_at')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
