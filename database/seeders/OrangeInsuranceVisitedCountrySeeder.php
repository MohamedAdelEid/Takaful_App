<?php

namespace Database\Seeders;

use App\Models\Company\Country;
use App\Models\Company\OrangeVisitedCountry;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OrangeInsuranceVisitedCountrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tunisia = OrangeVisitedCountry::create([
            'name' => 'تونس'
        ]);
        $algeria = OrangeVisitedCountry::create([
            'name' => 'الجزائر'
        ]);
        $algeriaTunisia = OrangeVisitedCountry::create([
            'name' => 'تونس والجزائر'
        ]);
        $egypt = OrangeVisitedCountry::create([
            'name' => 'مصر'
        ]);

        $counties = new Country;
        $tunisiaId = $counties->firstWhere('name', 'Tunisia')->id;
        $algeriaId = $counties->firstWhere('name', 'Algeria')->id;
        $egyptId = $counties->firstWhere('name', 'Egypt')->id;

        DB::table('country_orange_visited_country')->insert([
            'country_id' => $tunisiaId,
            'orange_visited_country_id' => $tunisia->id
        ]);

        DB::table('country_orange_visited_country')->insert([
            'country_id' => $algeriaId,
            'orange_visited_country_id' => $algeria->id
        ]);

        DB::table('country_orange_visited_country')->insert([
            'country_id' => $algeriaId,
            'orange_visited_country_id' => $algeriaTunisia->id
        ]);

        DB::table('country_orange_visited_country')->insert([
            'country_id' => $tunisiaId,
            'orange_visited_country_id' => $algeriaTunisia->id
        ]);
        
        DB::table('country_orange_visited_country')->insert([
            'country_id' => $egyptId,
            'orange_visited_country_id' => $egypt->id
        ]);
    }
}
