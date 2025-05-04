<?php

namespace Database\Seeders;

use App\Models\Constants\UserRoleConstants;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SuperAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'first_name' => 'Super',
            'last_name' => 'Admin',
            'email' => 'admin@liftale.com',
            'password' => bcrypt('123456'),
            'email_verified_at' => date('Y-m-d H:i:s'),
            'role_id' => UserRoleConstants::SUPER_ADMIN
        ]);
    }
}
