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
        Schema::table('premiums', function (Blueprint $table) {
            $table->decimal('net_premiums', 10, 3)->change();
            $table->decimal('tax', 10, 3)->change();
            $table->decimal('supervision_fees', 10, 3)->change();
            $table->decimal('stamps', 10, 3)->change();
            $table->decimal('issuance_fees', 10, 3)->change();
            $table->decimal('total_premium', 10, 3)->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('premiums', function (Blueprint $table) {
            //
        });
    }
};
