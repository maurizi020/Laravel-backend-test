<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DivisasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Inserta las divisas en la tabla divisas
        DB::table('divisas')->insert([
            ['id' => 'EUR'],
            ['id' => 'USD'],
            ['id' => 'BS'],
        ]);
    }
}
