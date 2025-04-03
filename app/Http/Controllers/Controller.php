<?php

namespace App\Http\Controllers;

abstract class Controller
{
    /**
     * Constructor
     */
    public function index()
    {
        return Product::all();
    }

    /**
     * Example method
     */
    public function store(Request $request)
    {
        $validated = $request_>validate([
            'name' => 'required|string',
            'description' => 'nullable|string',
            'price' => 'required|numeric',
            'quantity' => 'required|integer',
        ]);

        $priduct = Product::create($validated);
        return response()->json($product, 201);

    }
    public function show($id)
      {
          $product = Product::findOrFail($id);
          return response()->json($product);
      }
      public function update(Request $request, $id)
      {

          $validated = $request->validate([
              'name' => 'required|string',
              'description' => 'nullable|string',
              'price' => 'required|numeric',
              'quantity' => 'required|integer',
          ]);
          $product = Product::findOrFail($id);
          $product->update($validated);
          return response()->json($product);
      }
      public function destroy($id)
      {
          $product = Product::findOrFail($id);
          $product->delete();
          return response()->json(null, 204);
      }
}
