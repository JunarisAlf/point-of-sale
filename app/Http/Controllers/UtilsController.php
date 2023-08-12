<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UtilsController extends Controller{
    public function generalInfo(){
        $user = Auth::user();
        return view('admin.pages.master.general-info', compact('user'));
    }
}
