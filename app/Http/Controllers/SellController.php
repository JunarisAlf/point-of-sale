<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class SellController extends Controller{
    public function entrySell(){
        $user = Auth::user();
        return view('admin.pages.trx.sell-entry-rev', compact('user'));
    }
    public function entrySellOld(){
        $user = Auth::user();
        return view('admin.pages.trx.sell-entry', compact('user'));
    }
    public function sellList(){
        $user = Auth::user();
        if(!Gate::any(['isMaster', 'isAdmin', 'isFinance'])){
            abort(403);
        }
        return view('admin.pages.trx.sell-list', compact('user'));
    }
    public function entrySellOnline(){
        $user = Auth::user();
        return view('admin.pages.trx.sell-entry-online', compact('user'));
    }
    public function sellOnlineList(){
        $user = Auth::user();
        if(!Gate::any(['isMaster',  'isFinance'])){
            abort(403);
        }
        return view('admin.pages.trx.sell-online-list', compact('user'));
    }
    public function piutangList(){
        $user = Auth::user();
        if(!Gate::any(['isMaster',  'isFinance', 'isAdmin'])){
            abort(403);
        }
        return view('admin.pages.trx.piutang-list', compact('user'));
    }
}
