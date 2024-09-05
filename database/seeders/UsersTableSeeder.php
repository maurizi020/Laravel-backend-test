<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('users')->insert([
            [
                'name' => 'Maurizio Admin',
                'email' => 'maurizio_admin@test.com',
                'password' => '$2y$12$I/4kpOq0Ndmrcp5u0D6qq.9NzIEfvWDz0F1lRblfA6/EKUfp9TR7a', // 123456789Admin
                'role' => 'admin',
                'updated_at' => '2024-09-04T17:41:39.000000Z',
                'created_at' => '2024-09-04T17:41:39.000000Z'
            ],
            [
                'name' => 'Maurizio Client',
                'email' => 'maurizio_client@test.com',
                'password' => '$2y$12$Ih.1XYm1Z4FZbUTMUswW8uu8Yxi1GQfNPtx0rS0Ll9wrFZBjr1zGu', // 123456789Client
                'role' => 'client',
                'updated_at' => '2024-09-04T17:41:36.000000Z',
                'created_at' => '2024-09-04T17:41:36.000000Z'
            ]
        ]);
    }
}
