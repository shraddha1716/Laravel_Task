<?php

namespace App\Http\Controllers;

use App\Models\File;
use Illuminate\Http\Request;



class FileController extends Controller
{
    public function index()
    {
        $images = File::all();
        return view('files',compact('images'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'image_name' => 'required|array',
            'image_name.*' => 'string',
            'image' => 'required|array',
            'image.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048', // Adjust allowed file types and max size as needed
        ]);

        $images = $request->file('image');
        $imageNames = $request->input('image_name');

        foreach ($images as $key => $image) {
            $imageName = $imageNames[$key];
            $imageData = file_get_contents($image);
            $base64Image = base64_encode($imageData);

            File::create([
                'image_name' => $imageName,
                'image_data' => $base64Image,
            ]);
        }
        return redirect('add_more')->with('success', 'Images uploaded and saved successfully.');
    }
    
  
    public function editImage($id)
    {
        $image = File::find($id);
    
        if (!$image) {
            return redirect()->back()->with('error', 'Image not found.');
        }
    
        return view('edit_file', compact('image'));
    }

    public function updateImage(Request $request, $id)
    { 
        $image = File::find($id);
    
        if (!$image) {
            return redirect()->back()->with('error', 'Image not found.');
        }
    
        $request->validate([
            'image_name' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Adjust allowed file types and max size as needed
        ]);
    
        $image->image_name = $request->input('image_name');
        if ($request->hasFile('image')) {
            
            $newImageData = file_get_contents($request->file('image'));
            $image->image_data = base64_encode($newImageData);
        }
        $image->save();
        return redirect('add_more')->with('success', 'Images updated successfully.');
    }

    
    public function deleteImage($id)
    {
        $image = File::find($id);
    
        if (!$image) {
            return redirect()->back()->with('error', 'Image not found.');
        }
    
        $image->delete();
    
        return redirect('add_more')->with('success', 'Images deleted successfully.');
    }
}
