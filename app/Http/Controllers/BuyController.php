<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BuyController extends Controller{
    public function entryBuy(){
        $user = Auth::user();
        return view('admin.pages.master.cabang', compact('user'));
    }
    public function buyList(){
        $user = Auth::user();
        return view('admin.pages.trx.buy-list', compact('user'));
    }
}
