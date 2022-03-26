<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class IngredientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $ingredients = [
            [
                'name' => 'Nasi',
                'slug' => 'nasi',
                'description' => 'Nasi',
            ],
            [
                'name' => 'Telur',
                'slug' => 'telur',
                'description' => 'Telur',
            ],
            [
                'name' => 'Minyak',
                'slug' => 'minyak',
                'description' => 'minyak',
            ],
            [
                'name' => 'Bawang',
                'slug' => 'bawang',
                'description' => 'bawang',
            ],
        ];
        DB::table('ingredients')->insert($ingredients);
    }
}
