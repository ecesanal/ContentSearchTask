<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'name' => 'Admin User',
                'email' => 'test1@example.com',
                'password' => Hash::make('test123'),
                'is_admin' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Regular User',
                'email' => 'user1@example.com',
                'password' => Hash::make('user123'),
                'is_admin' => 0,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        DB::table('languages')->insert([
            ['name' => 'Türkçe'=> 'tr', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'English'=> 'en', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Français' => 'fr', 'created_at' => now(), 'updated_at' => now()],
        ]);

        DB::table('contents')->insert([
            [
                'title' => 'Laravel arama örneği',
                'content' => 'Bu, Türkçe içerik için bir örnek metindir. FULLTEXT ve LIKE karşılaştırması yapılabilir.',
                'language_id' => 1,
                'user_id' => 1,
                'created_at' => now(), 'updated_at' => now(),
            ],
            [
                'title' => 'Introduction to Laravel search',
                'content' => 'This is an English example content. You can test language-first search.',
                'language_id' => 2, 
                'user_id' => 1,
                'created_at' => now(), 'updated_at' => now(),
            ],
            [
                'title' => 'Recherche de contenu Laravel',
                'content' => 'Ceci est un contenu d’exemple en français pour tester la recherche par langue.',
                'language_id' => 3, 
                'user_id' => 2,
                'created_at' => now(), 'updated_at' => now(),
            ],
        ]);
    }
}
