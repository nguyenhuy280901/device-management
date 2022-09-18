<?php

use App\Enumerations\EmployeeRole;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $employees = [
            [
                'fullname' => 'Nguyen Huy',
                'image' => 'employee-1.jpg',
                'email' => 'nguyenhuy@tma.com',
                'password' => '$2y$10$0Ty7B/Nq9riZRIedfk4zmujvsGQw44NcIyVosFMOvX.Xrd/xSNjmS',
                'role' => EmployeeRole::ADMINISTRATOR,
                'department_id' => 1
            ],
            [
                'fullname' => 'Kim Oanh',
                'image' => 'employee-2.jpg',
                'email' => 'kimoanh@tma.com',
                'password' => '$2y$10$0Ty7B/Nq9riZRIedfk4zmujvsGQw44NcIyVosFMOvX.Xrd/xSNjmS',
                'role' => EmployeeRole::DIRECTOR,
                'department_id' => 1
            ],
            [
                'fullname' => 'Nguyen Hai',
                'image' => 'employee-3.jpg',
                'email' => 'nguyenhai@tma.com',
                'password' => '$2y$10$0Ty7B/Nq9riZRIedfk4zmujvsGQw44NcIyVosFMOvX.Xrd/xSNjmS',
                'role' => EmployeeRole::MANAGER,
                'department_id' => 1
            ],
        ];
        DB::table('employees')->insert($employees);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
};
