<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CustomerController extends Controller{
    public function index(){
        $user = Auth::user();
        return view('admin.pages.master.supplier', compact('user'));
    }
}
