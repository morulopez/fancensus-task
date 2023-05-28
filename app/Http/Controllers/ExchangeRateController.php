<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

use App\Models\ExchangeRate;

class ExchangeRateController extends Controller
{
    public function index(Request $request){
        
        if($request->input('search')) $exchangeRates = ExchangeRate::search($request->input('search'))->get();
        
        else $exchangeRates = ExchangeRate::all();
        
        return view('exchange-rates',["exchangeRates"=>$exchangeRates]);
    }
}
