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
        Schema::table('dependents', function (Blueprint $table) {
            $table->dropColumn(['first_name', 'last_name']);
            $table->foreignId('traveler_id')->after('id')->change();
            $table->string('passport_name')->after('traveler_id');
            $table->enum('gender', ['female', 'male'])->after('passport_number');
            $table->date('date_of_birth')->after('gender');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('dependents', function (Blueprint $table) {
            //
        });
    }
};
