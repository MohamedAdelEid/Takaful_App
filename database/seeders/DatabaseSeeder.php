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
             UserSeeder::class,
             BrancheSeeder::class,
             CompanySeeder::class,
             InsuranceTypeSeeder::class,
            InsuranceSeeder::class
        ]);
    }
}
