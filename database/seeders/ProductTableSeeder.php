<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class ProductTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('products')->insert([
            [
                'name' => 'Bota Negra',
                'description' => 'Bota Negra talla 13 Americano',
                'price' => 200,
                'tax' => 0.12,
                'divisa_id' => 'USD'
            ],
            [
                'name' => 'Bota Negra',
                'description' => 'Bota Negra talla 13 Americano',
                'price' => 185,
                'tax' => 0.08,
                'divisa_id' => 'EUR'
            ],
            [
                'name' => 'Torta de Auyama',
                'description' => 'Senda torta de Auyama',
                'price' => 70,
                'tax' => 0.16,
                'divisa_id' => 'BS'
            ],
            [
                'name' => 'Pizza italiana',
                'description' => 'Pizza italiana 100% real no fake.',
                'price' => 15,
                'tax' => 0.10,
                'divisa_id' => 'USD'
            ],
            [
                'name' => 'PlaySation 80',
                'description' => '100% original no Fake',
                'price' => 400,
                'tax' => 0.16,
                'divisa_id' => 'USD'
            ]
        ]);
    }
}
