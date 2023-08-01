<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BuyController extends Controller{
    public function entryBuy(){
        $user = Auth::user();
        return view('admin.pages.trx.buy-entri', compact('user'));
    }
    public function buyList(){
        $user = Auth::user();
        return view('admin.pages.trx.buy-list', compact('user'));
    }
    public function debtList(){
        $user = Auth::user();
        return view('admin.pages.trx.debt-list', compact('user'));
    }
}
