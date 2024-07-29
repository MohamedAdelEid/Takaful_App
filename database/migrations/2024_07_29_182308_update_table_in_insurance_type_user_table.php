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
        Schema::dropIfExists('insurance_type_user');
        Schema::create('insurance_type_user', function (Blueprint $table) {
            $table->unsignedBigInteger('insurance_type_id');
            $table->unsignedBigInteger('user_id');
            $table->boolean('vip')->default(0);
            $table->decimal('discount', 10, 4)->nullable();
            $table->string('discount_type')->nullable();
            $table->primary(['insurance_type_id', 'user_id']);
            $table->foreign('insurance_type_id')->references('id')->on('insurance_types')->onDelete('cascade')->cascadeOnUpdate();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->cascadeOnUpdate();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('insurance_type_user', function (Blueprint $table) {
            //
        });
    }
};
