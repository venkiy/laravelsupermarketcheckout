<?php

use App\Models\Product;
namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $products = [
            [
                'id'             => 1,
                'sku'           => 'A',
                'name'           => 'product A',
                'slug'          => 'product-a',
                'description'    => 'product a',
                'quantity'       => 5,
                'price'           => 50,
                'status'          => 1,                              
            ], 
            [
                'id'             => 2,
                'sku'           => 'B',
                'name'           => 'product B',
                'slug'          => 'product-b',
                'description'    => 'product b',
                'quantity'       => 10,
                'price'           => 30,
                'status'          => 1,                              
            ],
            [
                'id'             => 3,
                'sku'           => 'C',
                'name'           => 'product C',
                'slug'          => 'product-c',
                'description'    => 'product c',
                'quantity'       => 10,
                'price'           => 20,
                'status'          => 1,                              
            ], 
            [
                'id'             => 4,
                'sku'           => 'D',
                'name'           => 'product D',
                'slug'          => 'product-d',
                'description'    => 'product d',
                'quantity'       => 20,
                'price'           => 15,
                'status'          => 1,                              
            ], 
            [
                'id'             => 5,
                'sku'           => 'E',
                'name'           => 'product E',
                'slug'          => 'product-e',
                'description'    => 'product e',
                'quantity'       => 8,
                'price'           => 5,
                'status'          => 1,                              
            ],  
                    
            
        ];

        \App\Models\Product::insert($products);
    }
}
