<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [
            ['id' => 1, "name" => "View all categoties", "slug" => "view-all-categoty"],
            ['id' => 2, "name" => "View categoty detail", "slug" => "view-detail-categoty"],
            ['id' => 3, "name" => "Create categoty", "slug" => "create-categoty"],
            ['id' => 4, "name" => "Update categoty", "slug" => "update-categoty"],
            ['id' => 5, "name" => "Delete categoty", "slug" => "delete-categoty"],

            ['id' => 6, "name" => "View all devices", "slug" => "view-all-device"],
            ['id' => 7, "name" => "View device detail", "slug" => "view-detail-device"],
            ['id' => 8, "name" => "View allocated devices", "slug" => "view-allocated-device"],
            ['id' => 9, "name" => "Create device", "slug" => "create-device"],
            ['id' => 10, "name" => "Update device", "slug" => "update-device"],
            ['id' => 11, "name" => "Delete device", "slug" => "delete-device"],

            ['id' => 12, "name" => "View all departments", "slug" => "view-all-department"],
            ['id' => 13, "name" => "View department detail", "slug" => "view-detail-department"],
            ['id' => 14, "name" => "Create department", "slug" => "create-department"],
            ['id' => 15, "name" => "Update department", "slug" => "update-department"],
            ['id' => 16, "name" => "Delete department", "slug" => "delete-department"],

            ['id' => 17, "name" => "View all employees", "slug" => "view-all-employee"],
            ['id' => 18, "name" => "View employee detail", "slug" => "view-detail-employee"],
            ['id' => 19, "name" => "View employee of department", "slug" => "view-department-employee"],
            ['id' => 20, "name" => "Create employee", "slug" => "create-employee"],
            ['id' => 21, "name" => "Update employee", "slug" => "update-employee"],
            ['id' => 22, "name" => "Delete employee", "slug" => "delete-employee"],

            ['id' => 23, "name" => "Book device", "slug" => "book-device"],
            ['id' => 24, "name" => "Allocate device", "slug" => "allocate-device"],
            ['id' => 25, "name" => "Recover device", "slug" => "recover-device"],
            ['id' => 26, "name" => "Send booking to director", "slug" => "send-booking"],
            ['id' => 27, "name" => "View all bookings", "slug" => "view-all-booking"],
            ['id' => 28, "name" => "View bookings of department", "slug" => "view-department-booking"],
            ['id' => 29, "name" => "Approve booking manager level", "slug" => "approve-booking-manager"],
            ['id' => 30, "name" => "Approve booking director level", "slug" => "approve-booking-director"],

            ['id' => 31, "name" => "View dashboard", "slug" => "view-dashboard"],

            ['id' => 32, "name" => "Authorize", "slug" => "authorize"],
            ['id' => 33, "name" => "Change employee password", "slug" => "change-employee-password"],
        ];

        DB::table('permissions')->insert($permissions);
    }
}
