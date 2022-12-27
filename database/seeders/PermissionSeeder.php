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
            ['id' => 1, "name" => "View category", "slug" => "view-category"],
            ['id' => 2, "name" => "Create category", "slug" => "create-category"],
            ['id' => 3, "name" => "Update category", "slug" => "update-category"],
            ['id' => 4, "name" => "Delete category", "slug" => "delete-category"],

            ['id' => 5, "name" => "View all devices", "slug" => "view-all-device"],
            ['id' => 6, "name" => "View department devices", "slug" => "view-department-device"],
            ['id' => 7, "name" => "Create device", "slug" => "create-device"],
            ['id' => 8, "name" => "Update device", "slug" => "update-device"],
            ['id' => 9, "name" => "Delete device", "slug" => "delete-device"],

            ['id' => 10, "name" => "View departments", "slug" => "view-department"],
            ['id' => 11, "name" => "Create department", "slug" => "create-department"],
            ['id' => 12, "name" => "Update department", "slug" => "update-department"],
            ['id' => 13, "name" => "Delete department", "slug" => "delete-department"],

            ['id' => 14, "name" => "View role", "slug" => "view-role"],
            ['id' => 15, "name" => "Create role", "slug" => "create-role"],
            ['id' => 16, "name" => "Update role", "slug" => "update-role"],
            ['id' => 17, "name" => "Delete role", "slug" => "delete-role"],

            ['id' => 18, "name" => "View all employees", "slug" => "view-all-employee"],
            ['id' => 19, "name" => "View employee of department", "slug" => "view-department-employee"],
            ['id' => 20, "name" => "Create employee", "slug" => "create-employee"],
            ['id' => 21, "name" => "Update employee", "slug" => "update-employee"],
            ['id' => 22, "name" => "Delete employee", "slug" => "delete-employee"],

            ['id' => 23, "name" => "Allocate device", "slug" => "allocate-device"],
            ['id' => 24, "name" => "Recover device", "slug" => "recover-device"],
            
            ['id' => 25, "name" => "View all bookings", "slug" => "view-all-booking"],
            ['id' => 26, "name" => "View bookings of department", "slug" => "view-department-booking"],

            ['id' => 27, "name" => "Approve booking manager level", "slug" => "approve-booking-manager"],
            ['id' => 28, "name" => "Approve booking director level", "slug" => "approve-booking-director"],

            ['id' => 29, "name" => "Authorize", "slug" => "authorize"],
            ['id' => 30, "name" => "Backup database", "slug" => "backup"],
            ['id' => 31, "name" => "Restore database", "slug" => "restore"],
        ];

        DB::table('permissions')->insert($permissions);
    }
}
