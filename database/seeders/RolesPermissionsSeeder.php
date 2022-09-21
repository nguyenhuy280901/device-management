<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RolesPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $rolesPermissions = [
            [
                "role_id" => 2,
                "permission_id" => 23,
            ],
            [
                "role_id" => 2,
                "permission_id" => 8,
            ],
            [
                "role_id" => 3,
                "permission_id" => 29,
            ],
            [
                "role_id" => 3,
                "permission_id" => 32,
            ],
            [
                "role_id" => 4,
                "permission_id" => 30,
            ],
        ];

        DB::table('roles_permissions')->insert($rolesPermissions);
    }
}
