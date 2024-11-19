<?php

namespace Database\Seeders;


// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();



        // Category::factory(5)->create();
        // Product::factory(5)->create();

        $this->call(UserSeeder::class);
        $this->call(CatogerySeeder::class);
        $this->call(ProductSeeder::class);

    }
}
