<?php

use App\Enumerations\ApproveLevel;
use App\Enumerations\EquipmentStatus;
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
                'status' => EquipmentStatus::ALLOCATED,
                'approve_level' => ApproveLevel::MANAGER,
                'category_id' => 1
            ],
        ];

        DB::table('equipments')->insert($equipments);
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
