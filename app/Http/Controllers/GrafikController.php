<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GrafikController extends Controller{
    public function sell(){
        $user = Auth::user();
        return view('admin.pages.grafik.sell', compact('user'));
    }
    public function sellOnline(){
        $user = Auth::user();
        return view('admin.pages.grafik.sell-online', compact('user'));
    }
    public function buy(){
        $user = Auth::user();
        return view('admin.pages.grafik.buy', compact('user'));
    }
    public function category(){
        $user = Auth::user();
        return view('admin.pages.grafik.category', compact('user'));
    }
    public function mostSell(){
        $user = Auth::user();
        return view('admin.pages.grafik.most-sell', compact('user'));
    }
}
