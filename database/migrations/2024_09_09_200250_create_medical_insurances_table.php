<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMedicalInsurancesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('medical_insurances', function (Blueprint $table) {
            $table->id(); // Primary Key
            $table->string('name_company');
            $table->text('insurance_coverage');
            $table->integer('number_emplyee');
            $table->integer('number_of_family')->nullable();
            $table->decimal('coverage_amount', 10, 2);
            $table->enum('insurance_status', ['active', 'inactive'])->default('active');
            $table->string('full_name');
            $table->string('email')->unique();
            $table->string('phone_number')->unique();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('medical_insurances');
    }
}
