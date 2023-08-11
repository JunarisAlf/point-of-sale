<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SellController extends Controller{
    public function entrySell(){
        $user = Auth::user();
        return view('admin.pages.trx.sell-entry', compact('user'));
    }
    public function sellList(){
        $user = Auth::user();
        return view('admin.pages.trx.sell-list', compact('user'));
    }
    public function entrySellOnline(){
        $user = Auth::user();
        return view('admin.pages.trx.sell-entry-online', compact('user'));
    }
    public function piutangList(){
        $user = Auth::user();
        return view('admin.pages.trx.piutang-list', compact('user'));
    }
}
