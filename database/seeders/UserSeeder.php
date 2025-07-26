<?php

namespace Database\Seeders;

use App\Models\Constants\UserRoleConstants;
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
            'first_name' => 'Gajendra',
            'last_name' => 'Kadu',
            'email' => 'gajendra@gmail.com',
            'password' => bcrypt('123456'),
            'email_verified_at' => date('Y-m-d H:i:s'),
            'role_id' => UserRoleConstants::EMPLOYER
        ]);

        User::create([
            'first_name' => 'Candidate',
            'last_name' => 'One',
            'email' => 'candidateone@gmail.com',
            'password' => bcrypt('123456'),
            'email_verified_at' => date('Y-m-d H:i:s'),
            'role_id' => UserRoleConstants::CANDIDATE
        ]);
    }
}
