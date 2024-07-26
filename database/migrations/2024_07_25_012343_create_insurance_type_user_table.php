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
        Schema::create('insurance_type_user', function (Blueprint $table) {
            $table->unsignedBigInteger('insurance_id');
            $table->unsignedBigInteger('user_id');
            $table->boolean('vip')->default(0);
            $table->decimal('discount', 10, 4);
            $table->string('discount_type');
            $table->primary(['insurance_id', 'user_id']);
            $table->foreign('insurance_id')->references('id')->on('insurances')->onDelete('cascade')->cascadeOnUpdate();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->cascadeOnUpdate();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('insurance_type_user');
    }
};
