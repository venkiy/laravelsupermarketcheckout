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
                'password'       => '$2y$10$I80I3j5IhIPAkRZpytK3GeGUofOZBOxPIfapwPagZI1i/ailcquGC',
                'remember_token' => null,                
            ]         
            
        ];

        \App\Models\User::insert($users);
    }
}
