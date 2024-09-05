<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Purchase;
use App\Models\Product;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    //
    public function ReportByDate(Request $request) {

        $request->validate([
            'start_date' => 'required|date|before_or_equal:end_date',
            'end_date' => 'required|date|after_or_equal:start_date',
        ]);
        $start_date = $request->start_date;
        $end_date = $request->end_date;

        $filteredPurchases = Purchase::whereBetween('created_at', [$start_date, $end_date])
            ->with('product')
            ->get();

        $report = [];
        $totalTax = [];
        $earnings = [];
        foreach ($filteredPurchases as $purchase) {
            if (!array_key_exists($purchase->product->id, $report)) {
                $report[$purchase->product->id] = [
                    'name' => $purchase->product->name,
                    'divisa' => $purchase->product->divisa_id,
                    'price' => (float) $purchase->product->price,
                    'totalTaxProduct' => 0.0,
                    'totalProfit' => 0.0,
                    'productsSold' => 0
                ];
            }

            $report[$purchase->product->id]['totalTaxProduct'] += (float) $purchase->total_tax;
            $totalWithoutTax = (float) $purchase->total - (float) $purchase->total_tax;
            $report[$purchase->product->id]['totalProfit'] += round($totalWithoutTax, 2);

            if (!array_key_exists($purchase->product->divisa_id, $totalTax)) {
                $totalTax[$purchase->product->divisa_id] = 0.0;
                $earnings[$purchase->product->divisa_id] = 0.0;
            }

            $totalTax[$purchase->product->divisa_id] += $report[$purchase->product->id]['totalTaxProduct'];
            $earnings[$purchase->product->divisa_id] += $report[$purchase->product->id]['totalProfit'];
        }

        return response()->json([
            'ok' => true,
            'reportByProduct' => $report,
            'totalTaxByDivisa' => $totalTax,
            'earningsByDivisa' => $earnings
        ],200);

    }
}
