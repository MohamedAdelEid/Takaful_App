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
        Schema::create('vehicles', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('plate_number');
            $table->string('chassis_number');
            $table->string('type');
            $table->string('number_of_seats');
            $table->string('engine_hours_power');
            $table->string('load_tonnage');
            $table->string('color');
            $table->string('make');
            $table->string('model');
            $table->string('vehicle_place_of_registration');
            $table->string('purpose_of_license');
            $table->year('year_of_manufacturing');
            $table->json('details');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vehicles');
    }
};
