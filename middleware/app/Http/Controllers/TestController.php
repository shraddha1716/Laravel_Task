<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

class TestController extends Controller
{
    public function testing(){
        echo "done";
    }
    public function checking(){
        echo "fail";
    }
  
}
