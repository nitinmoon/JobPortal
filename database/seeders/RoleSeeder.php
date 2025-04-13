<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = array(
            array('id' => 1, 'name' => "Admin"),
            array('id' => 2, 'name' => "Employer"),
            array('id' => 3, 'name' => "Candidate"),
            array('id' => 4, 'name' => "Staff")
            );
        Role::insert($roles);
    }
}
