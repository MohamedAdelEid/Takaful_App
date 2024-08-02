<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
//        User::create([
//            'first_name' => 'Takaful',
//            'last_name' => 'Admin',
//            'nick_name' => 'Takaful',
//            'email' => 'takaful@gmail.com',
//            'password' => Hash::make('admin@123'),
//            'role' => 'company',
//            'phone' => '0910024721'
//        ]);

        User::create([
            'branche_id' => 3,
            'first_name' => 'Mohamed',
            'last_name' => 'Adel',
            'nick_name' => 'AB3DEL',
            'email' => 'dev.mohamedadell@gmail.com',
            'password' => Hash::make('user@123'),
            'role' => 'user',
            'phone' => '01114979112'
        ]);

        User::create([
            'branche_id' => 3,
            'first_name' => 'Mohamed',
            'last_name' => 'Saad',
            'nick_name' => 'SA3DONY',
            'email' => 'mohamedsaad@gmail.com',
            'password' => Hash::make('user@123'),
            'role' => 'user',
            'phone' => '01098001021'
        ]);
    }
}
