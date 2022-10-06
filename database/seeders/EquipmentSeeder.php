<?php

namespace Database\Seeders;

use App\Enumerations\ApproveLevel;
use App\Enumerations\EquipmentStatus;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EquipmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $equipments = [
            [
                'name' => 'Laptop Dell 1',
                'description' => '',
                'image' => 'laptop-dell-1.jpg',
                'status' => EquipmentStatus::AVAILABLE,
                'approve_level' => ApproveLevel::MANAGER,
                'category_id' => 1
            ],
            [
                'name' => 'Monitor ViewSonic 1',
                'description' => '',
                'image' => 'monitor-viewsonic-1.jpg',
                'status' => EquipmentStatus::AVAILABLE,
                'approve_level' => ApproveLevel::MANAGER,
                'category_id' => 4
            ],
            [
                'name' => 'Laptop Asus 1',
                'description' => '',
                'image' => 'laptop-asus-1.jpg',
                'status' => EquipmentStatus::AVAILABLE,
                'approve_level' => ApproveLevel::DIRECTOR,
                'category_id' => 1
            ],
            [
                'name' => 'PC MSI 1',
                'description' => '',
                'image' => 'pc-msi-1.jpg',
                'status' => EquipmentStatus::AVAILABLE,
                'approve_level' => ApproveLevel::MANAGER,
                'category_id' => 2
            ],
            [
                'name' => 'Headphone Sony 1',
                'description' => '',
                'image' => 'headphone-sony-1.jpg',
                'status' => EquipmentStatus::AVAILABLE,
                'approve_level' => ApproveLevel::MANAGER,
                'category_id' => 3
            ],
        ];

        DB::table('equipments')->insert($equipments);
    }
}
