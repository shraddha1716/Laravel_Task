<?php

namespace App\Http\Controllers;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function fetch_product()
    {
        $product = Product::all();
        return response()->json($product);
    }

    public function add_product(Request $request)
    {
        $product = new Product();
        $product->name= $request->input('name');
        $product->price= $request->input('price');
        $product->quantity= $request->input('quantity');
        $product->save();
        return response()->json(['message'=>'data added successfully','product'=>$product]);
    }

    public function edit_product($id)
    {
        $product = Product::find($id);
        return response()->json($product);
    }

    public function update_product(Request $request, $id)
    {
        $product = Product::find($id);
        $product->name= $request->input('name');
        $product->price= $request->input('price');
        $product->quantity= $request->input('quantity');
        $product->save();
        return response()->json(['message' => 'data updated successfully','product'=>$product]);
    }

    public function delete_product($id)
    {
        $product = Product::find($id);
        $product->delete();
        return response()->json(['message' => 'data deleted successfully','product'=>$product]);
    }
}
