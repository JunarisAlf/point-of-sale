<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class CashController extends Controller{
    public function inOut(){
        $user = Auth::user();
        if(!Gate::any(['isMaster',  'isFinance', 'isAdmin'])){
            abort(403);
        }
        return view('admin.pages.cash.in-out', compact('user'));
    }
    public function cashIn(){
        $user = Auth::user();
        if(!Gate::any(['isMaster',  'isFinance', 'isAdmin'])){
            abort(403);
        }
        return view('admin.pages.cash.cash-in', compact('user'));
    }
    public function cashOut(){
        $user = Auth::user();
        if(!Gate::any(['isMaster',  'isFinance', 'isAdmin'])){
            abort(403);
        }
        return view('admin.pages.cash.cash-out', compact('user'));
    }
    public function assets(){
        $user = Auth::user();
        if(!Gate::any(['isMaster',  'isFinance'])){
            abort(403);
        }
        return view('admin.pages.cash.assets', compact('user'));
    }
}
