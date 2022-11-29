<?php

use App\Models\User;
namespace Database\Seeders;

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [
            [
                'id'             => 1,
                'name'           => 'venkatesh',
                'email'          => 'venki@gmail.com',
                'password'       => '$2y$10$7ug6Yb6ROP4F/BRHn4G6uey00WoAG7yaiw85h0H8PUhTc3o6OKrIG',
                'remember_token' => null,                
            ]         
            
        ];

        \App\Models\User::insert($users);
    }
}
