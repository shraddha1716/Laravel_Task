<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Customer;

use Illuminate\Http\Request;

class ItemController extends Controller
{
   
    public function index(Request $request)
    {
        $selectedName = $request->input('name');
    
        $query = Customer::query();
    
        if ($selectedName) {
            $query->where('name', $selectedName);
        }
    
        $users = $query->paginate(10); // You can adjust the pagination as needed
    
        $distinctNames = Customer::pluck('name');
    
        return view('user', compact('users', 'distinctNames'));
    }

    public function create()
    {
        
    }

    public function store(Request $request)
    {
        $productData = $request->all();
        // dd($productData);exit;
        $customer = new Customer();
            $customer->name = $request->input('name');
            $customer->username = $request->input('uname');
            $customer->last_name = $request->input('lname');
            $customer->mobile_no = $request->input('mobno');
            $customer->email = $request->input('email');
            $customer->password = $request->input('password');
            $customer->save();

            $lastInsertedId = $customer->id;
           
        if($lastInsertedId)
        {
            foreach ($productData['product_name'] as $key => $value) {
                $product = new Item();
                $product->cid = $lastInsertedId;
                $product->product_name = $productData['product_name'][$key];
                $product->product_price = $productData['product_price'][$key];
                $product->product_quantity = $productData['product_quantity'][$key];
                $product->product_type = $productData['product_type'][$key];
                $product->discount_amount = $productData['discount_amount'][$key];
                $product->save();
            }
        }    
        
        return redirect()->route('users.index')->with('success', 'Products added successfully.');
    }

    
    public function show(Item $item)
    {
        //
    }

  
    public function edit(Item $item)
    {
        //
    }

   
    public function update(Request $request, Item $item)
    {
        //
    }

    
    public function destroy(Item $item)
    {
        //
    }
}
