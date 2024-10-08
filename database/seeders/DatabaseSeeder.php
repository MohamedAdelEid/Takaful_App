<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Company\Company;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            // UserSeeder::class,
            // CompanySeeder::class,
            // BrancheSeeder::class,
            // InsuranceTypeSeeder::class,
            // InsuranceSeeder::class,
            // ItemSeeder::class,
            // AvailableCarSeeder::class,
            // OrangeInsuranceVisitedCountrySeeder::class,
            CoverageAreaSeeder::class
        ]);
    }
}
