<?php

namespace Database\Seeders;

use App\Models\JobType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class JobTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $jobTypes = array(
            array('id' => 1, 'name' => "Full Time"),
            array('id' => 2, 'name' => "Part Time")
            );
        JobType::insert($jobTypes);
    }
}
