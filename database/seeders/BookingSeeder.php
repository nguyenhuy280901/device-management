<?php

namespace Database\Seeders;

use App\Enumerations\BookingStatus;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BookingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $bookings = [
            [
                'employee_id' => 1,
                'equipment_id' => 1,
                'status' => BookingStatus::PENDINGMANAGER
            ],
            [
                'employee_id' => 1,
                'equipment_id' => 3,
                'status' => BookingStatus::APPROVED
            ],
        ];

        DB::table('bookings')->insert($bookings);
    }
}
