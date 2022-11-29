<?php

use App\Models\ProductDiscount;
namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ProductDiscountSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $product_discounts = [
            [
                'id'             => 1,
                'product_id'           => 1,
                'qty'           => 3,
                'special_price'          => 130,
                'combo_product_id'    => NULL,                
                'status'          => 1,                              
            ], 
            [
                'id'             => 2,
                'product_id'           => 2,
                'qty'           => 2,
                'special_price'          => 45,
                'combo_product_id'    => NULL,                
                'status'          => 1,                              
            ], 
            [
                'id'             => 3,
                'product_id'           => 3,
                'qty'           => 2,
                'special_price'          => 38,
                'combo_product_id'    => NULL,                
                'status'          => 1,                              
            ], 
            [
                'id'             => 4,
                'product_id'           => 3,
                'qty'           => 3,
                'special_price'          => 50,
                'combo_product_id'    => NULL,                
                'status'          => 1,                              
            ],  
            [
                'id'             => 5,
                'product_id'           => 4,
                'qty'           => 1,
                'special_price'          => 5,
                'combo_product_id'    => 1,                
                'status'          => 1,                              
            ],              
                    
            
        ];

        \App\Models\ProductDiscount::insert($product_discounts);
    }
    
}
