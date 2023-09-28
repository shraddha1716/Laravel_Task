<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
   
    public function index()
    {
        $all_data = Product::paginate(10); // Paginate with 10 items per page
        return view('index', compact('all_data'));
    }

    public function getItems(Request $request)
    {
        if ($request->ajax()) {
            $all_data = Product::paginate(10); // Paginate with 10 items per page
            return response()->json($all_data);
        }
    }

    public function search(Request $request)
    {
        if ($request->ajax()) {
            $keyword = $request->get('keyword');
            $products = Product::where('product_name', 'like', "%$keyword%")->get();
            return response()->json($products);
        }
    }    
}
