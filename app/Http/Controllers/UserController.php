<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller{
 
    public function profile(){
        $user = Auth::user();
        return view('admin.pages.account.profile', compact('user'));
    }

    public function manageUserPage(){
        $user = Auth::user();
        return view('admin.pages.user.manage', compact('user'));
    }
    public function loginLog(){
        $user = Auth::user();
        return view('admin.pages.user.login-log', compact('user'));
    }
}
