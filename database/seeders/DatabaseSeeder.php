<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Divisa;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            DivisasTableSeeder::class,
            UsersTableSeeder::class,
            ProductTableSeeder::class,
            PurchaseTableSeeder::class
        ]);
    }
}
