<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use Binance\API; 
use Config;

class VolumeController extends Controller
{
    public function index()
    {
    	$api = new API(Config::get('constants.API_KEY'), Config::get('constants.SECRET'));
    	$prices = $api->prices();
    	return view('home', compact('prices'));
    }

    public function priceAll()
    {
    	$api = new API(Config::get('constants.API_KEY'), Config::get('constants.SECRET'));
    	$prices = $api->prices();
    	return response()->json(['prices' => $prices]);
    }

    public function getAllVolumeSymbol($symbol)
    {
    	$api = new API(Config::get('constants.API_KEY'), Config::get('constants.SECRET'));
    	$prevDay = $api->prevDay($symbol);
        return view('volume',compact(['symbol', 'prevDay']));
    }

    public function getVolumeSymbol(Request $request)
    {
    	$api = new API(Config::get('constants.API_KEY'), Config::get('constants.SECRET'));
        $prevDay = $api->prevDay($request->symbol);
    	return response()->json(['volume' => $prevDay]);
    }
}
