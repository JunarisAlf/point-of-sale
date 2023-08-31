<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GrafikController extends Controller{

    public function sell(){
        $user = Auth::user();
        return view('admin.pages.grafik.sell', compact('user'));
    }
}
