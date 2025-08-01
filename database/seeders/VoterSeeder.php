<?php

namespace Database\Seeders;

use App\Models\Token;
use App\Models\Voter;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class VoterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $voters = [
            [
                'voter_name' => 'Sophia Chen',
                'voter_email' => 'sophia.chen@example.com',
                'Major' => 'CS',
                'Years' => 'Second year',
                'roll_name' => 'CS2023',
                'voter_password' => Hash::make('Password@123'),
                'token_id' => 1,
                'profile_image' => 'https://randomuser.me/api/portraits/women/1.jpg'
            ],
            [
                'voter_name' => 'James Wilson',
                'voter_email' => 'james.wilson@example.com',
                'Major' => 'CT',
                'Years' => 'fresher',
                'roll_name' => 'CT1001',
                'voter_password' => Hash::make('SecurePass!456'),
                'token_id' => 2,
                'profile_image' => 'https://randomuser.me/api/portraits/men/1.jpg'
            ],
            [
                'voter_name' => 'Olivia Martinez',
                'voter_email' => 'olivia.m@example.com',
                'Major' => 'AI',
                'Years' => 'third year',
                'roll_name' => 'AI3015',
                'voter_password' => Hash::make('AI_Student_789'),
                'token_id' => 3,
                'profile_image' => 'https://randomuser.me/api/portraits/women/2.jpg'
            ],
            [
                'voter_name' => 'Ethan Johnson',
                'voter_email' => 'ethan.j@example.com',
                'Major' => 'SE',
                'Years' => 'fourth year',
                'roll_name' => 'SE4012',
                'voter_password' => Hash::make('SoftwareEng#2023'),
                'token_id' => 1,
                'profile_image' => 'https://randomuser.me/api/portraits/men/2.jpg'
            ],
            [
                'voter_name' => 'Ava Thompson',
                'voter_email' => 'ava.thompson@example.com',
                'Major' => 'CS',
                'Years' => 'Second year',
                'roll_name' => 'CS2024',
                'voter_password' => Hash::make('AvaPass123$'),
                'token_id' => 2,
                'profile_image' => 'https://randomuser.me/api/portraits/women/3.jpg'
            ],
            [
                'voter_name' => 'Noah Garcia',
                'voter_email' => 'noah.g@example.com',
                'Major' => 'CT',
                'Years' => 'fresher',
                'roll_name' => 'CT1002',
                'voter_password' => Hash::make('NoahCT!456'),
                'token_id' => 3,
                'profile_image' => 'https://randomuser.me/api/portraits/men/3.jpg'
            ],
            [
                'voter_name' => 'Isabella Lee',
                'voter_email' => 'isabella.lee@example.com',
                'Major' => 'AI',
                'Years' => 'third year',
                'roll_name' => 'AI3016',
                'voter_password' => Hash::make('BellaAI@789'),
                'token_id' => 1,
                'profile_image' => 'https://randomuser.me/api/portraits/women/4.jpg'
            ],
            [
                'voter_name' => 'Liam Davis',
                'voter_email' => 'liam.d@example.com',
                'Major' => 'SE',
                'Years' => 'fourth year',
                'roll_name' => 'SE4013',
                'voter_password' => Hash::make('LiamSE#2023'),
                'token_id' => 2,
                'profile_image' => 'https://randomuser.me/api/portraits/men/4.jpg'
            ],
            [
                'voter_name' => 'Mia Rodriguez',
                'voter_email' => 'mia.r@example.com',
                'Major' => 'CS',
                'Years' => 'Second year',
                'roll_name' => 'CS2025',
                'voter_password' => Hash::make('MiaCS123$'),
                'token_id' => 3,
                'profile_image' => 'https://randomuser.me/api/portraits/women/5.jpg'
            ],
            [
                'voter_name' => 'Benjamin Brown',
                'voter_email' => 'ben.brown@example.com',
                'Major' => 'CT',
                'Years' => 'fresher',
                'roll_name' => 'CT1003',
                'voter_password' => Hash::make('BenCT!456'),
                'token_id' => 1,
                'profile_image' => 'https://randomuser.me/api/portraits/men/5.jpg'
            ]
        ];
        Voter::insert($voters);
    }
}
