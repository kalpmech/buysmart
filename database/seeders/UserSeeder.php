<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = [
            'first_name' => 'Kalpesh',
            'last_name' => 'Patel',
            'email' => 'kalpesh@buysmart.com',
            'password' => bcrypt('Test123#'),
            'status' => 1,
            'user_type' => 'admin',
            'is_terms_accepted' => 1,
        ];
        $user = User::FirstOrCreate(['email' => $user['email']], $user);
    }
}
