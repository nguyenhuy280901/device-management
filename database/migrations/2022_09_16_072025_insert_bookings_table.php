<?php

use App\Enumerations\BookingStatus;
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
        $bookings = [
            [
                'employee_id' => 1,
                'equipment_id' => 1,
                'status' => BookingStatus::PENDING
            ],
            [
                'employee_id' => 1,
                'equipment_id' => 2,
                'status' => BookingStatus::APPROVED
            ],
        ];

        DB::table('bookings')->insert($bookings);
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
