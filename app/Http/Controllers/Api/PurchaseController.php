<?php

namespace App\Http\Controllers\Api;

use App\Models\Purchase;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PurchaseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $purchases = Purchase::all();
        return response()->json([
            'ok' => true,
            'purchases' => $purchases
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $validatedData = $request->validate([
            'user_id' => 'required|exists:users,id',
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
            'total_tax' => 'required|numeric|min:0',
            'total' => 'required|numeric|min:0'
        ]);
        $purchase = Purchase::create($validatedData);

        return response()->json([
            'ok' => true,
            'purchase' => $purchase
        ], 201);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'user_id' => 'required|exists:users,id',
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
            'total_tax' => 'required|numeric|min:0',
            'total' => 'required|numeric|min:0'
        ]);

        $purchase = Purchase::find($id);

        if (!$purchase) {
            return response()->json(['message' => 'Purchase not exist.', 'ok' => false,], 404);
        }

        $purchase->update($validatedData);

        return response()->json([
            'ok' => true,
            'message' => 'Update Purchase',
            'purchase' => $purchase
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $purchase = Purchase::find($id);

        if (!$purchase) {
            return response()->json([ 'ok' => false,'message' => 'Purchase not find'], 404);
        }
        $purchase->delete();

        return response()->json([ 'ok' => true, 'message' => 'Purchase delete'], 200);
    }
}