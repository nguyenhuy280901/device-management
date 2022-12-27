<?php

namespace Database\Seeders;

use App\Enumerations\EmployeeRole;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EmployeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $employees = [
            [
                'fullname' => 'Staff IT 1',
                'image' => 'employee-1.jpg',
                'email' => 'staff-it@gmail.com',
                'password' => '$2y$10$0Ty7B/Nq9riZRIedfk4zmujvsGQw44NcIyVosFMOvX.Xrd/xSNjmS',
                'role_id' => 2,
                'department_id' => 1
            ],
            [
                'fullname' => 'Manager IT',
                'image' => 'employee-2.jpg',
                'email' => 'manager@gmail.com',
                'password' => '$2y$10$0Ty7B/Nq9riZRIedfk4zmujvsGQw44NcIyVosFMOvX.Xrd/xSNjmS',
                'role_id' => 3,
                'department_id' => 1
            ],
            [
                'fullname' => 'Director',
                'image' => 'employee-3.jpg',
                'email' => 'director@gmail.com',
                'password' => '$2y$10$0Ty7B/Nq9riZRIedfk4zmujvsGQw44NcIyVosFMOvX.Xrd/xSNjmS',
                'role_id' => 4,
                'department_id' => 3
            ],
            [
                'fullname' => 'Staff HR',
                'image' => 'employee-4.jpg',
                'email' => 'staff-hr@gmail.com',
                'password' => '$2y$10$0Ty7B/Nq9riZRIedfk4zmujvsGQw44NcIyVosFMOvX.Xrd/xSNjmS',
                'role_id' => 2,
                'department_id' => 2
            ],
            [
                'fullname' => 'Staff 3',
                'image' => 'employee-5.jpg',
                'email' => 'staff-3@gmail.com',
                'password' => '$2y$10$0Ty7B/Nq9riZRIedfk4zmujvsGQw44NcIyVosFMOvX.Xrd/xSNjmS',
                'role_id' => 2,
                'department_id' => 1
            ],
            [
                'fullname' => 'System Administrator',
                'image' => 'employee-6.jpg',
                'email' => 'admin@gmail.com',
                'password' => '$2y$10$0Ty7B/Nq9riZRIedfk4zmujvsGQw44NcIyVosFMOvX.Xrd/xSNjmS',
                'role_id' => 1,
                'department_id' => 4
            ],
            [
                'fullname' => 'Device Manager',
                'image' => 'employee-6.jpg',
                'email' => 'device-manager@gmail.com',
                'password' => '$2y$10$0Ty7B/Nq9riZRIedfk4zmujvsGQw44NcIyVosFMOvX.Xrd/xSNjmS',
                'role_id' => 5,
                'department_id' => 6
            ],
        ];
        DB::table('employees')->insert($employees);
    }
}
