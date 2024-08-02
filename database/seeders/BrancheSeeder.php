<?php

namespace Database\Seeders;

use App\Models\Company\Branche;
use App\Models\Company\Company;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BrancheSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $companyId = Company::whereHas('user', function ($query) {
            $query->where('email', 'takaful@gmail.com');
        })->value('id');

        Branche::create([
            'company_id' => $companyId,
            'name' => ' الادارة العامة ( طرابلس )',
            'branche_number' => 1,
            'is_main' => true
        ]);

        $brancheId = Branche::where('branche_number', 1)->value('id');
        User::whereIn('email', ['dev.mohamedadell@gmail.com', 'mohamedsaad@gmail.com'])->update(['branche_id' => $brancheId]);
    }
}
