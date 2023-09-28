<?php
// app/Imports/ExcelImport.php

namespace App\Imports;

use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use App\Models\Product;

class ExcelImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        return new Product([
            'name' => $row['name'],
            'description' => $row['description'],
            'price' => $row['price'],
            // Add mappings for other columns
        ]);
    }
}
