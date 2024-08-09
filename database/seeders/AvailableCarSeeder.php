<?php

namespace Database\Seeders;

use DB;
use App\Models\AvailableCar;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class AvailableCarSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Data for item_id = 1
        $data1 = [
            ['name' => 'سيارات خاصة ملاكي', 'item_id' => 1],
            ['name' => 'درجة ناريه', 'item_id' => 1],
            ['name' => 'سيارات تعليم القيادة', 'item_id' => 1],
            ['name' => 'سيارات نقل الموتى', 'item_id' => 1],
            ['name' => 'سيارات إسعاف', 'item_id' => 1],
        ];

        // Data for item_id = 2
        $data2 = [
            ['name' => 'المقطورة', 'item_id' => 2],
            ['name' => 'السيارات التجارية', 'item_id' => 2],
            ['name' => 'الجرارات', 'item_id' => 2],
            ['name' => 'سيارات نقل البضائع', 'item_id' => 2],
            ['name' => 'سيارات ركوب الحافلات', 'item_id' => 2],
        ];

        // Insert the data into the available_cars table
        AvailableCar::insert(array_merge($data1, $data2));
    }
}
