<?php

// app/Http/Controllers/ProductController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\ExcelImport;
use App\Models\Product;

class ProductController extends Controller
{
    public function upload(Request $request)
    {
        $file = $request->file('excel_file');

        Excel::import(new ExcelImport, $file);

        return redirect()->back()->with('success', 'Data imported successfully');
    }
}
