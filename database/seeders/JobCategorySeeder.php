<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class JobCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            ['name' => 'Accounting', 'icon' => 'fa fa-calculator'],
            ['name' => 'Development', 'icon' => 'fa fa-code'],
            ['name' => 'Technology', 'icon' => 'fa fa-laptop'],
            ['name' => 'Media & News', 'icon' => 'fa fa-newspaper'],
            ['name' => 'Medical', 'icon' => 'fa fa-heartbeat'],
            ['name' => 'Government', 'icon' => 'fa fa-university'],
            ['name' => 'Design & Creative', 'icon' => 'fa fa-palette'],
            ['name' => 'Marketing', 'icon' => 'fa fa-bullhorn'],
            ['name' => 'Telemarketing', 'icon' => 'fa fa-phone-alt'],
            ['name' => 'Software & Web', 'icon' => 'fa fa-laptop-code'],
            ['name' => 'Engineering', 'icon' => 'fa fa-cogs'],
            ['name' => 'Teaching & Education', 'icon' => 'fa fa-chalkboard-teacher'],
        ];

        foreach ($categories as $category) {
            DB::table('job_categories')->updateOrInsert(
                ['name' => $category['name']],
                ['icon' => $category['icon']]
            );
        }
    }
}
