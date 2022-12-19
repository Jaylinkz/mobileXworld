<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\rate;

class rateController extends Controller
{
    public function updateRate(Request $req)
    {
        $req->validate([

            'exchange_rate'=>'required',

        ]);


        $rates = rate::take(1);
        if($rates){
            $rates->delete();
            rate::create($req->all());
            return back()->with('success', 'Success, exchange rate has been updated.');
        }elseif($rates == null){
            rate::create($req->all());
            return back()->with('error', 'Sorry, unable to update rate.');
        }
        return 'error';
    }
}
