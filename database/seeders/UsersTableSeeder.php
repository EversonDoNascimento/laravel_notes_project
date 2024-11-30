<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // create users
        DB::table('users')->insert([
            [
                'username' => 'user1@gmail.com',
                'password' => \bcrypt('1234'), // password
                'created_at' => \now(),
               
            ],
             [
                'username' => 'user2@gmail.com',
                'password' => \bcrypt('1234'), // password
                'created_at' => \now(),
                
            ],
             [
                'username' => 'user3@gmail.com',
                'password' => \bcrypt('1234'), // password
                'created_at' => \now(),
                
            ],
        ]);
    }
}
