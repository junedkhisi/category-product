<?php

namespace Database\Seeders;
use App\Models\Category;
use App\Models\User;
use App\Models\Product;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                "name" => 'Tata 1512 LPT',
                "description" => 'Power : 300 hp ,GVW :55000 , Mileage : 2.25-3.25 ,Engine : 6700 , Fuel Tank :365 ,Payload : 40000',
                "price" => 3900000,
                "image" => 'images/products/1732045713-images (1).jpeg',
                "category_id" => 1,
            ],
            [
                "name" => 'Tata 1515 LPT',
                "description" => 'Power : 300 hp ,GVW :55000 , Mileage : 2.25-3.25 ,Engine : 6700 , Fuel Tank :365 ,Payload : 40000',
                "price" => 4000000,
                "image" => 'images/products/1732045978-download.jpeg',
                "category_id" => 1,
            ],
            [
                "name" => 'Ashok Leyland Ecomet 1615',
                "description" => 'Power : 300 hp ,GVW :55000 , Mileage : 2.25-3.25 ,Engine : 6700 , Fuel Tank :365 ,Payload : 40000',
                "price" => 3000000,
                "image" => 'images/products/download (1).jpeg',
                "category_id" => 2,
            ],
            [
                "name" => 'Tata 1515 LPT',
                "description" => 'Power : 300 hp ,GVW :55000 , Mileage : 2.25-3.25 ,Engine : 6700 , Fuel Tank :365 ,Payload : 40000',
                "price" => 3600000,
                "image" => 'images/products/download (2).jpeg',
                "category_id" => 2,
            ],
        ];
        foreach ($data as $key => $value) {
            Product::updateOrCreate(["id"=>$key+1],$value);
        }

    }
}
