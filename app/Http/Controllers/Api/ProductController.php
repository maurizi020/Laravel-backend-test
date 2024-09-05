<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($divisa)
    {
        $product = Product::where('divisa_id', $divisa)->get();

        return response()->json([
            'ok' => true,
            'product' => $product
        ], 200);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'tax' => 'required|numeric',
            'divisa_id' => 'required|exists:divisas,id'
        ]);

        $product = new Product();
        $product->name = $validatedData['name'];
        $product->price = $validatedData['price'];
        $product->tax = $validatedData['tax'];
        $product->divisa_id = $validatedData['divisa_id'];
        $product->description = $request->input('description');
        $product->save();

        if (!$product) {
            $data = [
                'ok' => false,
                'message' => 'product not save.',
                'status' => 500
            ];
            return response()->json($data, 500);
        }

        return response()->json([
            'ok' => true,
            'msg' => 'Product has been created.'
        ],201);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'tax' => 'required|numeric',
            'divisa_id' => 'required|exists:divisas,id',
        ]);

        $product = Product::find($id);

        if (!$product) {
            return response()->json(['message' => 'product not find.', 'ok' => false,], 404);
        }

        $product->name = $validatedData['name'];
        $product->price = $validatedData['price'];
        $product->tax = $validatedData['tax'];
        $product->divisa_id = $validatedData['divisa_id'];
        $product->description = $request->input('description', '');
        $product->save();

        return response()->json([
            'ok' => true,
            'product' => $product
        ], 200);
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $product = Product::find($id);
        if (!$product) {
            return response()->json(['message' => 'product not find.', 'ok' => false,], 404);
        }
        $product->delete();
        return response()->json(['message' => 'product delete.', 'ok' => true,], 200);
    }
}
