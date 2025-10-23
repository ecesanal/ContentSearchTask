<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Language;
use App\Models\Content;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::firstOrCreate(
            ['email' => 'test1@example.com'],
            ['name' => 'Test User', 'password' => bcrypt('test123')]
        );

        $languages = ['Türkçe', 'English', 'Français'];
        foreach ($languages as $lang) {
            Language::firstOrCreate(['name' => $lang]);
        }

        foreach (Language::all() as $language) {
            Content::factory()->count(3)->create([
                'language_id' => $language->id
            ]);
        }
    }
}
