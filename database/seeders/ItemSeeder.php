<?php

namespace Database\Seeders;

use App\Models\Item;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
          // Data for the items table
          $items = [
            ['name' => 'البند الاول '],  // Assuming this is the name for item_id = 1
            ['name' => 'البند الثاني '],  // Assuming this is the name for item_id = 2
        ];

        // Insert the data into the items table
        Item::insert($items);
    }
}
