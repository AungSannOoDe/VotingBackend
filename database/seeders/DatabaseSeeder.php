<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Event;
use App\Models\Token;
use App\Models\Voter;
use App\Models\Elector;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'admin',
            'email' => 'test@example.com',
            "password"=>"asdffdsa"
        ]);
         Token::factory()->count(100)->create();
         Event::factory()->count(100)->create();
    }
}
