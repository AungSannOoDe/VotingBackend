<?php

namespace Database\Seeders;

use App\Models\Token;
use Illuminate\Support\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class TokenSeeder extends Seeder
{

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tokens = [
            [
                'token_name' => 'Admin Token',
                'archived_at' => 0, 
                'created_at' => Carbon::parse('2021-11-10T14:45:00Z'),
                'updated_at' => Carbon::parse('2024-03-20T16:00:00Z'),
            ],
            [
                'token_name' => 'User Token',
                'archived_at' => 0,
                'created_at' => Carbon::parse('2021-11-10T14:45:00Z'),
                'updated_at' => Carbon::parse('2024-03-20T16:00:00Z'),
            ],
            [
                'token_name' => 'Legacy Token',
                'archived_at' => 0, 
                'created_at' => Carbon::parse('2021-11-10T14:45:00Z'),
                'updated_at' => Carbon::parse('2024-03-20T16:00:00Z'),
            ],
            [
                'token_name' => 'API Access Token',
                'archived_at' => 0,
                'created_at' => Carbon::parse('2021-11-10T14:45:00Z'),
                'updated_at' => Carbon::parse('2024-03-20T16:00:00Z'),
            ],
            [
                'token_name' => 'Temporary Token',
                'archived_at' => 0, 
                'created_at' => Carbon::parse('2021-11-10T14:45:00Z'),
                'updated_at' => Carbon::parse('2024-03-20T16:00:00Z'),
            ],
            [
                'token_name' => 'User Token',
                'archived_at' => 0,
                'created_at' => Carbon::parse('2021-11-10T14:45:00Z'),
                'updated_at' => Carbon::parse('2024-03-20T16:00:00Z'),
            ],
            [
                'token_name' => 'Usering',
                'archived_at' => 0,
                'created_at' => Carbon::parse('2021-11-10T14:45:00Z'),
                'updated_at' => Carbon::parse('2024-03-20T16:00:00Z'),
            ],
            [
                'token_name' => ' Token',
                'archived_at' => 0,
                'created_at' => Carbon::parse('2021-11-10T14:45:00Z'),
                'updated_at' => Carbon::parse('2024-03-20T16:00:00Z'),
            ],
            [
                'token_name' => 'Hello',
                'archived_at' => 0,
                'created_at' => Carbon::parse('2021-11-10T14:45:00Z'),
                'updated_at' => Carbon::parse('2024-03-20T16:00:00Z'),
            ],
        ];
    Token::insert($tokens);
    }
}
