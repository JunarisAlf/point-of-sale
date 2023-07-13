<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller{
    public function index(){
        $user = Auth::user();
        return view('admin.pages.master.category', compact('user'));
    }
}
