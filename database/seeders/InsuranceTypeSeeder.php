<?php

namespace Database\Seeders;

use App\Models\Company\InsuranceType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class InsuranceTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        InsuranceType::create([
            'insurance_type_number' => 103,
            'name' => 'الإجباري',
        ]);

        InsuranceType::create([
            'insurance_type_number' => 104,
            'name' => 'البرتقالية',
        ]);
    }
}
