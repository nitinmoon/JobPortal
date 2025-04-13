<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\WorkType;

class WorkTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $workTypes = array(
            array('id' => 1, 'name' => "Work From Home"),
            array('id' => 2, 'name' => "Work From Office"),
            array('id' => 3, 'name' => "Client Location"),
            array('id' => 4, 'name' => "Hybrid")
            );
        WorkType::insert($workTypes);
    }
}
