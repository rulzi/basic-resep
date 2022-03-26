<?php

namespace Database\Seeders;

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
            [
                'name' => 'Main Course',
                'slug' => 'main-course',
                'description' => 'Main Course',
            ],
            [
                'name' => 'Desert',
                'slug' => 'desert',
                'description' => 'Desert',
            ],
        ];
        DB::table('categories')->insert($categories);
    }
}
