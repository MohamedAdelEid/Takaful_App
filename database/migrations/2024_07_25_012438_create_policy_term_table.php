<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('policy_term', function (Blueprint $table) {
            $table->unsignedBigInteger('policy_id');
            $table->unsignedBigInteger('term_id');
            $table->primary(['policy_id', 'term_id']);
            $table->foreign('policy_id')->references('policy_id')->on('policies')->onDelete('cascade');
            $table->foreign('term_id')->references('id')->on('terms')->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('policy_term', function (Blueprint $table) {
            //
        });
    }
};
