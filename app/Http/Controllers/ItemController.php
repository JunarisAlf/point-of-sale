<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ItemController extends Controller{
    public function index(){
        $user = Auth::user();
        return view('admin.pages.master.item', compact('user'));
    }
    public function stock(){
        $user = Auth::user();
        return view('admin.pages.gudang.stock', compact('user'));
    }
}
