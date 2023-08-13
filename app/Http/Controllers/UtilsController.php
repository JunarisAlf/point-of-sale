<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UtilsController extends Controller{
    public function generalInfo(){
        $user = Auth::user();
        return view('admin.pages.setting.general-info', compact('user'));
    }
    public function otherInfo(){
        $user = Auth::user();
        return view('admin.pages.setting.other-info', compact('user'));
    }
}
