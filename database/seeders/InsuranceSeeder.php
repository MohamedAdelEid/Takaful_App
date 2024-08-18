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
        $campanyId = Company::whereHas('user', function ($query) {
            $query->where('email', 'takaful@gmail.com');
        })->value('id');

        Insurance::create([
            'company_id' => $campanyId,
            'insurance_number' => 100,
            'name' => 'سيارات',
        ]);

        Insurance::create([
            'company_id' => $campanyId,
            'insurance_number' => 509,
            'name' => 'مسافرين',
        ]);

        $insuranceId = Insurance::where('insurance_number', 100)->value('id');
        // insuranceType الاجباري
        $insuranceTypeId = InsuranceType::where('insurance_type_number', 103)->value('id');

        // insuranceType البرتقاليه
        $insuranceTypeId2 = InsuranceType::where('insurance_type_number', 104)->value('id');

        DB::table('insurance_insurance_type')->insert([
            'insurance_id' => $insuranceId,
            'insurance_type_id' => $insuranceTypeId
        ]);
        DB::table('insurance_insurance_type')->insert([
            'insurance_id' => $insuranceId,
            'insurance_type_id' => $insuranceTypeId2
        ]);
    }
}
