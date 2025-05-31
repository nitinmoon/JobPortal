<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DesignationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $designations = [
            // Technology & Development
            'Software Engineer',
            'Frontend Developer',
            'Backend Developer',
            'Full Stack Developer',
            'Mobile App Developer',
            'DevOps Engineer',
            'QA Engineer',
            'Technical Lead',
            'UI/UX Designer',
            'System Administrator',
            'Network Engineer',
            'Database Administrator',
            'Cloud Engineer',
            'AI/ML Engineer',
            'Cybersecurity Analyst',

            // Project & Product
            'Project Manager',
            'Product Manager',
            'Scrum Master',
            'Agile Coach',
            'Business Analyst',

            // Marketing & Sales
            'Marketing Manager',
            'Digital Marketing Executive',
            'Content Marketer',
            'SEO Specialist',
            'Social Media Manager',
            'Sales Executive',
            'Business Development Manager',
            'Telemarketer',

            // HR & Admin
            'HR Manager',
            'Talent Acquisition Specialist',
            'Recruiter',
            'HR Executive',
            'Office Administrator',

            // Finance
            'Accountant',
            'Financial Analyst',
            'Payroll Specialist',
            'Finance Manager',

            // Creative
            'Graphic Designer',
            'Visual Designer',
            'Creative Director',
            'Animator',
            'Video Editor',

            // Customer Support
            'Customer Support Executive',
            'Technical Support Engineer',
            'Call Center Agent',
            'Client Relationship Manager',

            // Education & Training
            'Teacher',
            'Lecturer',
            'Trainer',
            'Instructional Designer',
            'Academic Coordinator',

            // Others / General
            'Operations Manager',
            'Logistics Coordinator',
            'Procurement Officer',
            'Data Entry Operator',
            'Data Analyst',
            'Field Executive',
        ];

        foreach ($designations as $name) {
            DB::table('designations')->updateOrInsert(
                ['name' => $name],
                ['created_at' => now(), 'updated_at' => now()]
            );
        }
    }
}
