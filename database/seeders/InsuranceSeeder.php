<?php

namespace Database\Seeders;

use App\Models\Company\Company;
use App\Models\Company\Insurance;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class InsuranceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $campanyId = Company::first()->id;
        Insurance::create([
            'company_id' => $campanyId,
            'insurance_number' => 100,
            'name' => 'تأمين السيارات',
        ]);
    }
}
