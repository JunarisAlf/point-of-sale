<?php

namespace App\Http\Controllers;

use App\Models\CustomerTrx;
use Illuminate\Http\Request;

class PrintController extends Controller{
    public function receipt(Request $req){
        $trx_id = $req->id;
        $trx = CustomerTrx::findOrFail($trx_id);

        return view('print.receipt', compact('trx'));
    }
}
