<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'role_id' => 1,
            'first_name' => 'Admin',
            'last_name' => 'Demo',
            'email' => 'admin@jobportal.com',
            'email_verified_at' => date('Y-m-d H:i:s'),
            'password' => bcrypt('123456')
        ]);
    }
}
