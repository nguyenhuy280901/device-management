<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $departments = [
            [
                'name' => 'IT',
                'description' => 'Information technology department'
            ],
            [
                'name' => 'HR',
                'description' => 'Human Resource'
            ],
            [
                'name' => 'Manager',
                'description' => 'Board of manager'
            ],
            [
                'name' => 'Finance',
                'description' => 'Finance and accounting'
            ],
            [
                'name' => 'Sale & Marketing',
                'description' => 'Sale & Marketing'
            ],
            [
                'name' => 'Device Management',
                'description' => 'Device Management'
            ],
            [
                'name' => 'Orther',
                'description' => ''
            ],
        ];
        DB::table('departments')->insert($departments);
    }
}
