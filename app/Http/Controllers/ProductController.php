<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product; // Make sure to import the Product model

class ProductController extends Controller
{
    // Retrieve all products
    public function index()
    {
        return response()->json(Product::all(), 200);
    }

    // Create a new product (POST)
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'description' => 'nullable|string',
            'price' => 'required|numeric',
            'quantity' => 'required|integer'
        ]);

        $product = Product::create($request->all());

        return response()->json([
            'message' => 'Product created successfully!',
            'product' => $product
        ], 201);
    }

    // Retrieve a single product by ID (GET)
    public function show($id)
    {
        $product = Product::find($id);

        if (!$product) {
            return response()->json(['message' => 'Product not found'], 404);
        }

        return response()->json($product, 200);
    }

    // Update a product (PUT)
    public function update(Request $request, $id)
    {
        $product = Product::find($id);

        if (!$product) {
            return response()->json(['message' => 'Product not found'], 404);
        }

        $request->validate([
            'name' => 'string',
            'description' => 'nullable|string',
            'price' => 'numeric',
            'quantity' => 'integer'
        ]);

        $product->update($request->all());

        return response()->json([
            'message' => 'Product updated successfully!',
            'product' => $product
        ], 200);
    }

    // Delete a product (DELETE)
    public function destroy($id)
    {
        $product = Product::find($id);

        if (!$product) {
            return response()->json(['message' => 'Product not found'], 404);
        }

        $product->delete();

        return response()->json(['message' => 'Product deleted successfully!'], 200);
    }
}
