<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use  App\Product;

class ProductController extends Controller
{
    public function getAll()
    {
        $products = Product::with('provider')->with('category')->get();
        return response()->json($products);
    }
    
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'product_category_id' => 'required',
            'product_provider_id' => 'required',
            'year' => 'required',
            'capacity' => 'required',
            'price' => 'required',
            'currency' => 'required',
            'type' => 'required',
        ]);
        
        $product = Product::create($request->all());
        return response()->json($product);
    }
    
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'product_category_id' => 'required',
            'product_provider_id' => 'required',
            'year' => 'required',
            'capacity' => 'required',
            'price' => 'required',
            'currency' => 'required',
            'type' => 'required',
        ]);
        
        $product = Product::find($id);
        $product->update($request->all());
        return response()->json($product);
    }
    
    public function destroy(Request $request, $id)
    {
        Product::destroy($id);
        return response()->json(['error' => false]);
    }
}
