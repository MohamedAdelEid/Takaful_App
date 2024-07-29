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
        Schema::table('coverages', function (Blueprint $table) {
            $table->json('coverage_amount')->comment('Coverage amounts specified countries');
            $table->json('coverage_amount_except')->nullable()->comment('Coverage amounts excluding specified countries');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('coverages', function (Blueprint $table) {
            //
        });
    }
};
