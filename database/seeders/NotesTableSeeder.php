<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class NotesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('notes')->insert([
            [
                'user_id' => 1,
                'title' => 'Small Cotton Chicken',
                'text' => 'CSS',
                'created_at' => now()
            ],
            [
                'user_id' => 1,
                'title' => 'title 2',
                'text' => 'text 2',
                'created_at' => now()
            ],
            [
                'user_id' => 1,
                'title' => 'title 3',
                'text' => 'text 3',
                'created_at' => now()
            ],
              [
                'user_id' => 2,
                'title' => 'Testando CSS',
                'text' => 'CSS',
                'created_at' => now()
            ],
            [
                'user_id' => 2,
                'title' => 'Mais um título user 2',
                'text' => 'text 2',
                'created_at' => now()
            ],
            [
                'user_id' => 2,
                'title' => 'Mais uma nota',
                'text' => 'text 3',
                'created_at' => now()
            ],
        ]);
    }
}
