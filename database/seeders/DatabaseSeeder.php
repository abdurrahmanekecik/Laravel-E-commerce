<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

         \App\Models\User::factory()->create([
             'name' => 'Abdurrahman Ekecik',
             'email' => 'info@abdurrahmanekecik.com',
             'password' => bcrypt('123456'),
             'is_admin' => '1',
             'status' => '1',
        ]);
    }
}
