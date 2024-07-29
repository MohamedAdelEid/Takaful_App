<?php

namespace Database\Seeders;

use App\Models\Company\Branche;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BrancheSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Branche::create([
            'company_id' => 1,
            'name' => ' الادارة العامة ( طرابلس )',
            'branche_number' => 1,
            'is_main' => true
        ]);
    }
}
