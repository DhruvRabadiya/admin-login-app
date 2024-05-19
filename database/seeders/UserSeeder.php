<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'full_name' => "User",
            'user_name' => 'User_1',
            'email' => 'user@gmail.com',
            'password' => bcrypt('12345678'), 
            'mobile_number' => '1231154899',
            'date_of_birth' => '2000/01/01'
            ]);
    }
}
