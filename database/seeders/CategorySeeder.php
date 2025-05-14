<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('categories')->insert([
            [
                'category_name' => 'Action',
                'description' => 'Film dengan adegan penuh aksi dan ketegangan',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'category_name' => 'Drama',
                'description' => 'Film dengan konflik emosional dan karakter kuat',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'category_name' => 'Komedi',
                'description' => 'Film yang menghibur dan penuh humor',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'category_name' => 'Horor',
                'description' => 'Film menegangkan yang menakutkan',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'category_name' => 'Romance',
                'description' => 'Film bertema cinta dan hubungan',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
