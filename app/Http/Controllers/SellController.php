<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SellController extends Controller{
    public function entrySell(){
        $user = Auth::user();
        return view('admin.pages.trx.sell-entry', compact('user'));
    }
}
