<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\File;

class FileUploadController extends Controller
{
    public function index()
    {
        $files = File::all();
        return view('file_upload', ['files' => $files]);
    }

    public function upload(Request $request)
    {
      
        // Validate the uploaded file
        $request->validate([
            'file' => 'required|file|max:10240', // Max file size is 10MB (adjust as needed)
        ]);

        // Store the uploaded file
        $file = $request->file('file');
        $fileName = time() . '_' . $file->getClientOriginalName();
        $filePath = $file->storeAs('uploads', $fileName);

        // Save file information to the database (if needed)
        $fileModel = new File();
        $fileModel->name = $fileName;
        $fileModel->path = $filePath;
        $fileModel->save();

        return redirect()->back()->with('success', 'File uploaded successfully.');
    }

    public function editImage($id)
    {
        // Retrieve the image record from the database
        $fileModel = File::find($id);

        if (!$fileModel) {
            return redirect()->back()->with('error', 'Image not found.');
        }

        return view('edit_file', compact('fileModel'));
    }

    public function updateImage(Request $request, $id)
    {
        // Retrieve the image record from the database
        $fileModel = File::find($id);

        if (!$fileModel) {
            return redirect()->back()->with('error', 'Image not found.');
        }

        // Validate the uploaded file
        $request->validate([
            'image_name' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:10240', // Adjust allowed file types and max size as needed
        ]);

        $fileModel->name = $request->input('image_name');

        if ($request->hasFile('image')) {
            // Store the uploaded image
            $image = $request->file('image');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $imagePath = $image->storeAs('uploads', $imageName);

            // Update the image path in the database
            $fileModel->path = $imagePath;
        }

        $fileModel->save();

        return redirect('/file')->with('success', 'Image updated successfully.');
    }

    public function deleteImage($id)
    {
        // Retrieve the image record from the database
        $fileModel = File::find($id);

        if (!$fileModel) {
            return redirect()->back()->with('error', 'Image not found.');
        }

        // Delete the image file from storage (if it exists)
        // if (Storage::exists($fileModel->image_path)) {
        //     Storage::delete($fileModel->image_path);
        // }

        // Delete the image record from the database
        $fileModel->delete();

        return redirect('/file')->with('success', 'Image deleted successfully.');
    }
}
