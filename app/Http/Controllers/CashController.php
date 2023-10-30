<?php

namespace App\Http\Controllers;

use App\Models\Deposit;
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
    public function setoran(){
        $user = Auth::user();
        if(!Gate::any(['isMaster',  'isFinance'])){
            abort(403);
        }
        return view('admin.pages.cash.setoran', compact('user'));
    }
    public function setoranDetail($id){
        $user = Auth::user();
        if(!Gate::any(['isMaster',  'isFinance'])){
            abort(403);
        }
        $setoran = Deposit::findOrFail($id);
        $details = json_decode($setoran->data);
        // dd($details);
        return view('admin.pages.cash.setoran-detail', compact('user', 'setoran', 'details'));
    }
    public function assets(){
        $user = Auth::user();
        if(!Gate::any(['isMaster',  'isFinance'])){
            abort(403);
        }
        return view('admin.pages.cash.assets', compact('user'));
    }
}
