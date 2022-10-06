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
                'fullname' => 'Staff 1',
                'image' => 'employee-1.jpg',
                'email' => 'staff-1@tma.com',
                'password' => '$2y$10$0Ty7B/Nq9riZRIedfk4zmujvsGQw44NcIyVosFMOvX.Xrd/xSNjmS',
                'role_id' => 2,
                'department_id' => 1
            ],
            [
                'fullname' => 'Manager 1',
                'image' => 'employee-2.jpg',
                'email' => 'manager@tma.com',
                'password' => '$2y$10$0Ty7B/Nq9riZRIedfk4zmujvsGQw44NcIyVosFMOvX.Xrd/xSNjmS',
                'role_id' => 3,
                'department_id' => 1
            ],
            [
                'fullname' => 'Director',
                'image' => 'employee-3.jpg',
                'email' => 'director@tma.com',
                'password' => '$2y$10$0Ty7B/Nq9riZRIedfk4zmujvsGQw44NcIyVosFMOvX.Xrd/xSNjmS',
                'role_id' => 4,
                'department_id' => 3
            ],
            [
                'fullname' => 'Staff 2',
                'image' => 'employee-4.jpg',
                'email' => 'staff-2@tma.com',
                'password' => '$2y$10$0Ty7B/Nq9riZRIedfk4zmujvsGQw44NcIyVosFMOvX.Xrd/xSNjmS',
                'role_id' => 2,
                'department_id' => 2
            ],
            [
                'fullname' => 'Staff 3',
                'image' => 'employee-5.jpg',
                'email' => 'staff-3@tma.com',
                'password' => '$2y$10$0Ty7B/Nq9riZRIedfk4zmujvsGQw44NcIyVosFMOvX.Xrd/xSNjmS',
                'role_id' => 2,
                'department_id' => 1
            ],
            [
                'fullname' => 'System Administrator',
                'image' => 'employee-6.jpg',
                'email' => 'admin@tma.com',
                'password' => '$2y$10$0Ty7B/Nq9riZRIedfk4zmujvsGQw44NcIyVosFMOvX.Xrd/xSNjmS',
                'role_id' => 1,
                'department_id' => 4
            ],
        ];
        DB::table('employees')->insert($employees);
    }
}
