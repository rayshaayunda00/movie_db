<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Movie;  // Pastikan ini diimpor
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Memanggil CategorySeeder
        //$this->call(CategorySeeder::class);

        // Membuat 50 data Movie menggunakan factory
       //Movie::factory(50)->create();
       user::factory(3)->create();

        // Jika Anda ingin menambahkan user secara manual
        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
