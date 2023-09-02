<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class CustomerController extends Controller{
    public function index(){
        $user = Auth::user();
        if(!Gate::any(['isMaster',  'isFinance', 'isAdmin'])){
            abort(403);
        }
        return view('admin.pages.master.customer', compact('user'));
    }
}
