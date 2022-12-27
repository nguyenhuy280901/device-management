<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = [
            ["id" => 1, "name" => "Administrator", "slug" => "admin"],
            ["id" => 2, "name" => "Staff", "slug" => "staff"],
            ["id" => 3, "name" => "Manager", "slug" => "manager"],
            ["id" => 4, "name" => "Director", "slug" => "director"],
            ["id" => 5, "name" => "Device Manager", "slug" => "device-manager"],
        ];

        DB::table('roles')->insert($roles);
    }
}
