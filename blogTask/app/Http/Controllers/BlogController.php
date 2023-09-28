<?php

namespace App\Http\Controllers;
use PDF;
use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BlogController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function create()
    {
        return view('blogs.create');
    }

    public function store(Request $request)
    {
        $rules = [
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ];
        $request->validate($rules);
        $blog = new Blog();
        $blog->title = $request->input('title');
        $blog->description = $request->input('description');
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('blog_images', 'public');
            $blog->image_path = $imagePath;
        }
        $blog->save();
        return redirect('/blogs')->with('success', 'Blog post created successfully');
    }


    public function index()
    {
        $blogs = Blog::all();
        return view('blogs.index', compact('blogs'));
    }

    public function destroy($id)
    {
        $blog = Blog::find($id);
        if (!$blog) {
            return redirect('/blogs')->with('error', 'Blog not found');
        }
        if ($blog->image_path) {
            Storage::disk('public')->delete($blog->image_path);
        }
        $blog->delete();
        return redirect('/blogs')->with('success', 'Blog post deleted successfully');
    }


    public function edit($id)
    {
        $blog = Blog::find($id);
        if (!$blog) {
            return redirect('/blogs')->with('error', 'Blog not found');
        }
        return view('blogs.edit', compact('blog'));
    }

    public function update(Request $request, $id)
    {
        $rules = [
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ];
        $request->validate($rules);
        $blog = Blog::find($id);
        if (!$blog) {
            return redirect('/blogs')->with('error', 'Blog not found');
        }
        $blog->title = $request->input('title');
        $blog->description = $request->input('description');
        if ($request->hasFile('image')) {
            if ($blog->image_path) {
                Storage::disk('public')->delete($blog->image_path);
            }
            $imagePath = $request->file('image')->store('blog_images', 'public');
            $blog->image_path = $imagePath;
        }
        $blog->save();
        return redirect('/blogs')->with('success', 'Blog post updated successfully');
    }

    public function showPdf()
    {
        $blog = Blog::find(2);
        $pdf = PDF::loadView('blogs.pdf', compact('blog'));

        return $pdf->stream('blogs.pdf'); // click on btn pdf show on new tab
        // return $pdf->download('product.pdf');  // download directly when click on btn
    }
}
