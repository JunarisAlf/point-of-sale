<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CashController extends Controller{
    public function inOut(){
        $user = Auth::user();
        return view('admin.pages.cash.in-out', compact('user'));
    }
    public function assets(){
        $user = Auth::user();
        return view('admin.pages.cash.assets', compact('user'));
    }
}
