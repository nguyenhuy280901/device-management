<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = [
            ['name' => 'Laptop', 'description' => ''],
            ['name' => 'PC', 'description' => ''],
            ['name' => 'Headphone', 'description' => ''],
            ['name' => 'Monitor', 'description' => ''],
        ];

        DB::table('categories')->insert($categories);
    }
}
