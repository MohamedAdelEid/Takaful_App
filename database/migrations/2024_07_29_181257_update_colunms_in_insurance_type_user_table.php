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
        Schema::table('insurance_type_user', function (Blueprint $table) {
            $table->string('discount')->nullable()->change();
            $table->enum('discount_type' , ['percentage' , 'fixed_amount'])->nullable()->change();
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
