<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;
use App\Models\Product;
use Carbon\Carbon;

class PurchaseTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products = Product::all();

        if ($products->isEmpty()) {
            return;
        }

        foreach (range(1, 10) as $index) {
            $product = $products->random();            
            $quantity = rand(1, 5);
            $taxRate = (float) $product->tax;
            $totalWithoutTax = (float) $product->price * $quantity;
            $totalTax = $totalWithoutTax * $taxRate;
            $total = $totalWithoutTax + $totalTax;
            $createdAt = Carbon::now()->subDays(rand(0, 30));        
            $purchases[] = [
                'user_id' => 2,
                'product_id' => $product->id,
                'quantity' => $quantity,
                'total_tax' => round($totalTax, 2),
                'total' => round($total, 2),
                'created_at' => $createdAt,
            ];
        }
        DB::table('purchases')->insert($purchases);
    }
}
