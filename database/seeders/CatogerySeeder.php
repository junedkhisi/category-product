<?php

namespace Database\Seeders;
use App\Models\Category;
use App\Models\User;
use App\Models\Product;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CatogerySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                "name" => 'Tata',
                "status" => true
            ],
            [
                "name" => 'Ashok Leyland',
                "status" => true
            ],
        ];
        foreach ($data as $key => $value) {
            Category::updateOrCreate(["id"=>$key+1],$value);
        }
    }
}
