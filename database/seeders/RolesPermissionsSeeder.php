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
        $adminPermissions = [1, 2, 3, 4, 5, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 20, 21, 22, 29, 30, 31];
        $managerPermissions = [6, 19, 26, 27];
        $directorPermissions = [5, 10, 18, 25, 28];
        $deviceManagerPermissions = [5, 7, 8, 9, 23, 24, 25];
        
        $rolePermissions = [
            [
                "role" => 1,
                "permissions" => $adminPermissions
            ],
            [
                "role" => 3,
                "permissions" => $managerPermissions
            ],
            [
                "role" => 4,
                "permissions" => $directorPermissions
            ],
            [
                "role" => 5,
                "permissions" => $deviceManagerPermissions
            ],
        ];

        $data = array();
        foreach($rolePermissions as $rolePermission)
        {
            foreach($rolePermission["permissions"] as $permission)
            {
                array_push($data, [
                    "role_id" => $rolePermission["role"],
                    "permission_id" => $permission
                ]);
            }
        }

        DB::table('roles_permissions')->insert($data);
    }
}
