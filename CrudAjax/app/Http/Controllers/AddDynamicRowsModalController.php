<?php

namespace App\Http\Controllers;

use App\Models\AddDynamicRowsModal;
use Illuminate\Http\Request;

class AddDynamicRowsModalController extends Controller
{
   
    public function index()
    {
        $data = AddDynamicRowsModal::all();
        return view('AddDynamicRowsModal',compact('data'));
    }


    public function store(Request $request)
    {
        // Validate the request
        $request->validate([
            'name.*' => 'required|max:255', // Use wildcard * to indicate an array of 'name' fields
        ]);
    
        // Get an array of all 'name' inputs from the form
        $names = $request->input('name');
    
        // Loop through the names and store them in the database
        foreach ($names as $name) {
            AddDynamicRowsModal::create(['name' => $name]);
        }
    
        return redirect()->back()->with('success', 'Data has been stored successfully.');
    }

    public function update(Request $request, $id)
    {
        $item = AddDynamicRowsModal::findOrFail($id); // Find the item by ID
        $item->update($request->all()); // Update the item with the form data
    
        return redirect()->back()->with('success', 'Item has been updated successfully.');
    }

    public function delete($id)
    {
        $item = AddDynamicRowsModal::findOrFail($id); 
        $item->delete(); 
    
        return redirect()->back()->with('delete_msg', 'Item has been deleted successfully.');
    }
}
