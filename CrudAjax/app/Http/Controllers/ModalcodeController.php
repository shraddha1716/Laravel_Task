<?php

namespace App\Http\Controllers;

use App\Models\Modalcode;
use Illuminate\Http\Request;

class ModalcodeController extends Controller
{
   
    public function index()
    {
        $data = Modalcode::all();
        return view('AddModal',compact('data'));
    }

   
    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:255',
        ]);
        Modalcode::create($validatedData);
    
        return redirect()->back()->with('success', 'Data has been stored successfully.');
    }

    public function show(Modalcode $modalcode)
    {
        //
    }

    public function edit(Modalcode $modalcode)
    {
        //
    }

   
    public function update(Request $request, $id)
    {
        $item = Modalcode::findOrFail($id); // Find the item by ID
        $item->update($request->all()); // Update the item with the form data
    
        return redirect()->back()->with('success', 'Item has been updated successfully.');
    }

    
    public function delete($id)
    {
        $item = Modalcode::findOrFail($id); 
        $item->delete(); 
    
        return redirect()->back()->with('delete_msg', 'Item has been deleted successfully.');
    }
}
