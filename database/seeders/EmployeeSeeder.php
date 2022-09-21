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
                'fullname' => 'Nguyen Huy',
                'image' => 'employee-1.jpg',
                'email' => 'nguyenhuy@tma.com',
                'password' => '$2y$10$0Ty7B/Nq9riZRIedfk4zmujvsGQw44NcIyVosFMOvX.Xrd/xSNjmS',
                'role_id' => 2,
                'department_id' => 1
            ],
            [
                'fullname' => 'Kim Oanh',
                'image' => 'employee-2.jpg',
                'email' => 'kimoanh@tma.com',
                'password' => '$2y$10$0Ty7B/Nq9riZRIedfk4zmujvsGQw44NcIyVosFMOvX.Xrd/xSNjmS',
                'role_id' => 3,
                'department_id' => 2
            ],
            [
                'fullname' => 'Nguyen Hai',
                'image' => 'employee-3.jpg',
                'email' => 'nguyenhai@tma.com',
                'password' => '$2y$10$0Ty7B/Nq9riZRIedfk4zmujvsGQw44NcIyVosFMOvX.Xrd/xSNjmS',
                'role_id' => 4,
                'department_id' => 3
            ],
            [
                'fullname' => 'Ha An',
                'image' => 'employee-4.jpg',
                'email' => 'haan@tma.com',
                'password' => '$2y$10$0Ty7B/Nq9riZRIedfk4zmujvsGQw44NcIyVosFMOvX.Xrd/xSNjmS',
                'role_id' => 2,
                'department_id' => 2
            ],
            [
                'fullname' => 'Ngoc Tai',
                'image' => 'employee-5.jpg',
                'email' => 'ngoctai@tma.com',
                'password' => '$2y$10$0Ty7B/Nq9riZRIedfk4zmujvsGQw44NcIyVosFMOvX.Xrd/xSNjmS',
                'role_id' => 2,
                'department_id' => 1
            ],
            [
                'fullname' => 'Quoc Huy',
                'image' => 'employee-6.jpg',
                'email' => 'quochuy@tma.com',
                'password' => '$2y$10$0Ty7B/Nq9riZRIedfk4zmujvsGQw44NcIyVosFMOvX.Xrd/xSNjmS',
                'role_id' => 1,
                'department_id' => 4
            ],
        ];
        DB::table('employees')->insert($employees);
    }
}
