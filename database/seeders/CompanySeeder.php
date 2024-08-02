<?php

namespace Database\Seeders;

use App\Models\Company\Company;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $userIdCompany = User::where('email', 'takaful@gmail.com')->value('id');

        Company::create([
            'user_id' => $userIdCompany,
        ]);
    }
}
