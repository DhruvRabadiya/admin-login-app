<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function category(){
        $user = Auth::user();
        return view('category' , compact('user'));
    }
}
