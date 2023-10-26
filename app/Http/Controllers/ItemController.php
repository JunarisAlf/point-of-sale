<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ItemController extends Controller{
    public function index(){
        $user = Auth::user();
        return view('admin.pages.master.item', compact('user'));
    }
    public function multiPrice(){
        $user = Auth::user();
        return view('admin.pages.master.multi-price', compact('user'));
    }
    public function stock(){
        $user = Auth::user();
        return view('admin.pages.gudang.stock', compact('user'));
    }
    public function expired(){
        $user = Auth::user();
        return view('admin.pages.gudang.expired', compact('user'));
    }
    public function stockOpname(){
        $user = Auth::user();
        return view('admin.pages.gudang.stock-opname', compact('user'));
    }
    public function verifStockOpname(){
        $user = Auth::user();
        return view('admin.pages.gudang.verif-stock-opname', compact('user'));
    }
    public function manageItem(){
        $user = Auth::user();
        return view('admin.pages.gudang.manage-item', compact('user'));
    }
    public function transfer(){
        $user = Auth::user();
        return view('admin.pages.gudang.transfer', compact('user'));
    }
    public function retur(){
        $user = Auth::user();
        return view('admin.pages.gudang.retur', compact('user'));
    }
    public function returList(){
        $user = Auth::user();
        return view('admin.pages.gudang.retur-list', compact('user'));
    }

}
