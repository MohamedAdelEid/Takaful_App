<?php

namespace Database\Seeders;

use App\Models\Company\CoverageArea;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CoverageAreaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        CoverageArea::create([
            'zone_number' => 1,
            'title' => 'provides cover worldwide except Libya, USA, Canada, Japan and Australia'
        ]);
        
        CoverageArea::create([
            'zone_number' => 2,
            'title' => 'provides cover USA, Canada, Japan and Australia only'
        ]);
    }
}
