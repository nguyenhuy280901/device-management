<?php

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
                'email' => 'nguyenhuy@tma.com',
                'password' => '$2y$10$0Ty7B/Nq9riZRIedfk4zmujvsGQw44NcIyVosFMOvX.Xrd/xSNjmS',
                'role_id' => 1,
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
