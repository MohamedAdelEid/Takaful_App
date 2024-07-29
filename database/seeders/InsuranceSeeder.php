<?php

namespace Database\Seeders;

use App\Models\Company\Company;
use App\Models\Company\Insurance;
use App\Models\Company\InsuranceType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class InsuranceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // $campanyId = Company::first()->id;
        // Insurance::create([
        //     'company_id' => $campanyId,
        //     'insurance_number' => 100,
        //     'name' => 'تأمين السيارات',
        // ]);

        // Insurance::create([
        //     'company_id' => $campanyId,
        //     'insurance_number' => 509,
        //     'name' => 'تأمين المسافرين',
        // ]);

        $insuranceId = Insurance::where('insurance_number', 100)->value('id');
        $insuranceTypeId = InsuranceType::where('insurance_type_number', 103)->value('id');

        DB::table('insurance_insurance_type')->insert([
            'insurance_id' => $insuranceId,
            'insurance_type_id' => $insuranceTypeId
        ]);
    }
}
